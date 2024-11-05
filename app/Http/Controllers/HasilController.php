<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HasilModel; // Jangan lupa untuk mengimpor model HasilModel
use Carbon\Carbon;

class HasilController extends Controller
{
    public function saveResult(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string',
            'rekom_alter' => 'required|string',
        ]);

        $hasil = new HasilModel(); // Gunakan HasilModel untuk menyimpan data
        $hasil->nama_produk = $request->input('nama_produk');
        $hasil->rekom_alter = $request->input('rekom_alter');
        $hasil->waktu_penyimpanan = Carbon::now();
        $hasil->save();

        return redirect()->route('laporan.index')->with('success', 'Hasil perhitungan berhasil disimpan.');
    }
}
