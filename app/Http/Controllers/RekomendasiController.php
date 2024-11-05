<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NilaiAlterModel;
use App\Models\ProdukModel;
use App\Models\NilaiProduk;
use App\Models\SettingModel;
use Validator;

class RekomendasiController extends Controller
{
    public function index()
    {
        $produk = ProdukModel::all();
        $settingItem = SettingModel::first();

        return view('pages.rekomendasi.index', [
            'title' => 'rekomendasi',
            'active' => 'rekomendasi',
            'produk' => $produk,
            'settingItem' => $settingItem,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required',
            'c01' => 'required|integer',
            'c02' => 'required|integer',
            'c03' => 'required|integer',
            'c04' => 'required|integer',
            'c05' => 'required|integer',
            'c06' => 'required|integer',
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'integer' => 'Kolom :attribute harus berupa angka.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Simpan data valid ke dalam session
        session()->put('nama_produk_wp', $request->nama_produk);
        session()->put('bobot_wp', [
            'c01' => $request->c01,
            'c02' => $request->c02,
            'c03' => $request->c03,
            'c04' => $request->c04,
            'c05' => $request->c05,
            'c06' => $request->c06,
        ]);
    
        return redirect()->route('rekomendasi.hasil');
    }
    
    private function calculateNormalizedMatrix($alternatifs)
    {
        $kriteria = ['c01', 'c02', 'c03', 'c04', 'c05', 'c06'];
        $matrixR = [];
        $totalSquares = [];

        foreach ($kriteria as $k) {
            $totalSquares[$k] = sqrt($alternatifs->sum(function($item) use ($k) {
                return pow($item->$k, 2);
            }));
        }

        foreach ($alternatifs as $alt) {
            $row = ['nama_alternatif' => $alt->nama_alternatif];
            foreach ($kriteria as $k) {
                $row[$k] = $alt->$k / $totalSquares[$k];
            }
            $matrixR[] = $row;
        }

        return $matrixR;
    }

    private function calculateWeightedMatrix($matrixR, $bobot)
    {
        $kriteria = ['c01', 'c02', 'c03', 'c04', 'c05', 'c06'];
        $matrixY = [];

        foreach ($matrixR as $row) {
            $weightedRow = ['nama_alternatif' => $row['nama_alternatif']];
            foreach ($kriteria as $k) {
                $weightedRow[$k] = $row[$k] * $bobot[$k];
            }
            $matrixY[] = $weightedRow;
        }

        return $matrixY;
    }

    private function calculateIdealSolutions($matrixY)
    {
        $kriteria = ['c01', 'c02', 'c03', 'c04', 'c05', 'c06'];
        $Aplus = [];
        $Aminus = [];

        foreach ($kriteria as $k) {
            if ($k == 'c04') { // Atribut cost
                $Aplus[$k] = min(array_column($matrixY, $k));
                $Aminus[$k] = max(array_column($matrixY, $k));
            } else { // Atribut benefit
                $Aplus[$k] = max(array_column($matrixY, $k));
                $Aminus[$k] = min(array_column($matrixY, $k));
            }
        }

        return [$Aplus, $Aminus];
    }

    private function calculatePreferenceValues($matrixY, $Aplus, $Aminus)
    {
        $kriteria = ['c01', 'c02', 'c03', 'c04', 'c05', 'c06'];
        $Dplus = [];
        $Dminus = [];
        $preferensi = [];

        foreach ($matrixY as $row) {
            $dPlusSum = 0;
            $dMinusSum = 0;
            foreach ($kriteria as $k) {
                $dPlusSum += pow($row[$k] - $Aplus[$k], 2);
                $dMinusSum += pow($row[$k] - $Aminus[$k], 2);
            }
            $Dplus[$row['nama_alternatif']] = sqrt($dPlusSum);
            $Dminus[$row['nama_alternatif']] = sqrt($dMinusSum);
            $preferensi[$row['nama_alternatif']] = $Dminus[$row['nama_alternatif']] / ($Dplus[$row['nama_alternatif']] + $Dminus[$row['nama_alternatif']]);
        }

        return [$Dplus, $Dminus, $preferensi];
    }

    private function calculateRanking($preferensi)
    {
        arsort($preferensi);
        $ranking = [];
        $rank = 1;
        foreach ($preferensi as $key => $value) {
            $ranking[] = [
                'nama_alternatif' => $key,
                'preferensi' => $value,
                'ranking' => $rank++
            ];
        }
        return $ranking;
    }

    public function showHasil()
    {
        $nama_produk = session('nama_produk_wp', 'default_product_name');
        $bobot = session('bobot_wp', []);

        // Ambil semua alternatif dari NilaiAlterModel
        $nilaiAlternatifs = NilaiAlterModel::all();

        $matrixR = $this->calculateNormalizedMatrix($nilaiAlternatifs);
        $matrixY = $this->calculateWeightedMatrix($matrixR, $bobot);
        list($Aplus, $Aminus) = $this->calculateIdealSolutions($matrixY);
        list($Dplus, $Dminus, $preferensi) = $this->calculatePreferenceValues($matrixY, $Aplus, $Aminus);
        $ranking = $this->calculateRanking($preferensi);
        $rankingAlternatif = array_slice($ranking, 0, 3);
        $explanation = $this->generateExplanation($ranking, $bobot);

        return view('pages.rekomendasi.hasil', [
            'nama_produk' => $nama_produk,
            'bobot' => $bobot,
            'nilaiAlter' => $nilaiAlternatifs,
            'matrixR' => $matrixR,
            'matrixY' => $matrixY,
            'Aplus' => $Aplus,
            'Aminus'=> $Aminus,
            'Dplus' => $Dplus,
            'Dminus' => $Dminus,
            'preferensi' => $preferensi,
            'ranking' => $ranking,
            'rankingAlternatif' => $rankingAlternatif,
            'explanation' => $explanation
        ]);
    }

    private function generateExplanation($ranking, $bobot)
    {
        $descriptions = [
            'c01' => [
                4 => '>50 Tahun',
                3 => '21-50 Tahun',
                2 => '11- 20 Tahun',
                1 => '0-10 Tahun'
            ],
            'c02' => [
                4 => 'Sangat Keras',
                3 => 'Keras',
                2 => 'Sedang',
                1 => 'Lunak'
            ],
            'c03' => [
                4 => 'Sangat Tinggi',
                3 => 'Tinggi',
                2 => 'Sedang',
                1 => 'Rendah'
            ],
            'c04' => [
                1 => '1.500.000-3.000.000',
                2 => '3.000.000-5.000.000',
                3 => '5.000.000-8.000.000',
                4 => '>8.000.000'
            ],
            'c05' => [
                4 => '>60 cm',
                3 => '41-60 cm',
                2 => '21-40 cm',
                1 => '0-20 cm'
            ],
            'c06' => [
                4 => 'Tahan hama dan cuaca',
                3 => 'Tahan cuaca',
                2 => 'Tahan hama',
                1 => 'Mudah rapuh'
            ],
        ];
    
        $kriteria = [
            'c01' => 'Usia',
            'c02' => 'Sifat Fisik',
            'c03' => 'Kekuatan',
            'c04' => 'Harga',
            'c05' => 'Diameter',
            'c06' => 'Daya Tahan',
        ];
    
        $topAlternative = $ranking[0];
        $namaProduk = session('nama_produk_wp', 'produk_anda');
        $explanation = "Anda memilih produk {$namaProduk} dengan kriteria sebagai berikut:<br>";
    
        foreach ($kriteria as $key => $label) {
            $value = $bobot[$key];
            $description = $descriptions[$key][$value];
            $explanation .= "<br>{$label}: {$description}";
        }
    
        $explanation .= "<br><br>Berdasarkan data tersebut, rekomendasi jenis kayu untuk {$namaProduk} Anda adalah Kayu {$topAlternative['nama_alternatif']}.";
    
        return $explanation;
    }
    



}
