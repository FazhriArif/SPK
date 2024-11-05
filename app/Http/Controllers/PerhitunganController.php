<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\NilaiAlterModel;
use App\Models\ProdukModel;
use App\Models\SettingModel;
use Validator;
class PerhitunganController extends Controller
{   public function index()
    {   $produk = ProdukModel::all();
        $settingItem = SettingModel::first();
        return view('pages.perhitungan.index', [
            'title' => 'Perhitungan',
            'active' => 'perhitungan',
            'produk' => $produk,
            'settingItem' => $settingItem, ]);}
    public function store(Request $request)
    {   $validator = Validator::make($request->all(), [
            'nama_produk' => 'required',
            'c01' => 'required|integer',
            'c02' => 'required|integer',
            'c03' => 'required|integer',
            'c04' => 'required|integer',
            'c05' => 'required|integer',
            'c06' => 'required|integer',], [
            'required' => 'Kolom :attribute harus diisi.',
            'integer' => 'Kolom :attribute harus berupa angka.',]);
        if ($validator->fails())      
            return redirect()->back()->withErrors($validator)->withInput();
      
        $validated = $validator->validated();
        session()->forget('produk_wp');
        session()->forget('nama_produk_wp');
        $produk_wp = session('produk_wp', []);
        $produk_wp[] = [
            'nama_produk' => $validated['nama_produk'],
            'c01' => $validated['c01'],
            'c02' => $validated['c02'],
            'c03' => $validated['c03'],
            'c04' => $validated['c04'],
            'c05' => $validated['c05'],
            'c06' => $validated['c06'],];
        session(['produk_wp' => $produk_wp]);
        session(['nama_produk_wp' => $validated['nama_produk']]);
        $bobot = [
            'c01' => $validated['c01'],
            'c02' => $validated['c02'],
            'c03' => $validated['c03'],
            'c04' => $validated['c04'],
            'c05' => $validated['c05'],
            'c06' => $validated['c06'],];
        $totalBobot = array_sum($bobot);
        foreach ($bobot as $key => $value) {
            $bobot[$key] = $value / $totalBobot;}
        session(['bobot_wp' => $bobot]);
        return response()->json(['success' => true]);}
    public function showHasil()
    {   $bobot = session('bobot_wp', []);
        $nilaiProduk = session('produk_wp', []);
        $settingItem = SettingModel::first();
        $nilaiAlter = NilaiAlterModel::all();
        $matrixR = $this->calculateNormalizedMatrix($nilaiAlter);
        $matrixY = $this->calculateWeightedMatrix($matrixR, $bobot);
        list($Aplus, $Aminus) = $this->calculateIdealSolutions($matrixY);
        list($Dplus, $Dminus, $preferensi) = $this->calculatePreferenceValues($matrixY, $Aplus, $Aminus);
        $ranking = $this->calculateRanking($preferensi);
        $nama_produk = session('nama_produk_wp', 'default_product_name');
        $rankingAlternatif = array_slice($ranking, 0, 3);
        return view('pages.perhitungan.hasil', [
            'settingItem' => $settingItem,
            'active' => 'perhitungan',
            'nilaiProduk' => $nilaiProduk,
            'bobot' => $bobot,
            'nilaiAlter' => $nilaiAlter,
            'matrixR' => $matrixR,
            'matrixY' => $matrixY,
            'Aplus' => $Aplus,
            'Aminus'=> $Aminus,
            'Dplus' => $Dplus,
            'Dminus' => $Dminus,
            'preferensi' => $preferensi,
            'ranking' => $ranking,
            'nama_produk' => $nama_produk,
            'rankingAlternatif' => $rankingAlternatif]);}
    private function calculateNormalizedMatrix($alternatifs)
    {   $kriteria = ['c01', 'c02', 'c03', 'c04', 'c05', 'c06'];
        $matrixR = [];
        $totalSquares = [];
        foreach ($kriteria as $k) {
            $totalSquares[$k] = sqrt($alternatifs->sum(function($item) use ($k) {
                return pow($item->$k, 2);}));}
        foreach ($alternatifs as $alt) {
            $row = ['nama_alternatif' => $alt->nama_alternatif];
            foreach ($kriteria as $k) {
                $row[$k] = $alt->$k / $totalSquares[$k]; }
            $matrixR[] = $row; }
        return $matrixR;}
    private function calculateWeightedMatrix($matrixR, $bobot)
    {   $kriteria = ['c01', 'c02', 'c03', 'c04', 'c05', 'c06'];
        $matrixY = [];
        foreach ($matrixR as $row) {
            $weightedRow = ['nama_alternatif' => $row['nama_alternatif']];
            foreach ($kriteria as $k) {
                $weightedRow[$k] = $row[$k] * $bobot[$k];}
            $matrixY[] = $weightedRow;}
        return $matrixY;}
    private function calculateIdealSolutions($matrixY)
    {   $kriteria = ['c01', 'c02', 'c03', 'c04', 'c05', 'c06'];
        $Aplus = [];
        $Aminus = [];
        foreach ($kriteria as $k) {
            if ($k == 'c04') {
                $Aplus[$k] = min(array_column($matrixY, $k));
                $Aminus[$k] = max(array_column($matrixY, $k));
            } else {
                $Aplus[$k] = max(array_column($matrixY, $k));
                $Aminus[$k] = min(array_column($matrixY, $k));}}
        return [$Aplus, $Aminus];}
    private function calculatePreferenceValues($matrixY, $Aplus, $Aminus)
    {   $kriteria = ['c01', 'c02', 'c03', 'c04', 'c05', 'c06'];
        $Dplus = [];
        $Dminus = [];
        $preferensi = [];
        foreach ($matrixY as $row) {
            $dPlusSum = 0;
            $dMinusSum = 0;
            foreach ($kriteria as $k) {
                $dPlusSum += pow($row[$k] - $Aplus[$k], 2);
                $dMinusSum += pow($row[$k] - $Aminus[$k], 2);}
            $Dplus[$row['nama_alternatif']] = sqrt($dPlusSum);
            $Dminus[$row['nama_alternatif']] = sqrt($dMinusSum);
            $preferensi[$row['nama_alternatif']] = $Dminus[$row['nama_alternatif']] / ($Dplus[$row['nama_alternatif']] + $Dminus[$row['nama_alternatif']]);}
        return [$Dplus, $Dminus, $preferensi];}
    private function calculateRanking($preferensi)
    {   arsort($preferensi);
        $ranking = [];
        $rank = 1;
        foreach ($preferensi as $key => $value) {
            $ranking[] = [
                'nama_alternatif' => $key,
                'preferensi' => $value,
                'ranking' => $rank++];}
        return $ranking;}
}
