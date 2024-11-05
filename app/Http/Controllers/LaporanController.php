<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\HasilModel;
use App\Models\SettingModel;
use Carbon\Carbon;
class LaporanController extends Controller
{
    public function index()
    {   $hasilPerhitungan = HasilModel::orderBy('waktu_penyimpanan', 'desc')->get();
        $settingItem = SettingModel::first();
        return view('pages.laporan.index', [
            'title' => 'Laporan',
            'active' => 'Laporan',
            'hasilPerhitungan' => $hasilPerhitungan,
            'settingItem' => $settingItem,]);}
    public function store(Request $request)
    {   $validatedData = $request->validate([
            'nama_produk' => 'required|string',
            'rekom_alter' => 'required|string',]);
        $hasil = new HasilModel();
        $hasil->nama_produk = $validatedData['nama_produk'];
        $hasil->rekom_alter = $validatedData['rekom_alter'];
        $hasil->waktu_penyimpanan = Carbon::now();
        $hasil->save();
        return redirect()->route('laporan.index')->with('success', 'Hasil perhitungan berhasil disimpan.');}
    public function destroy($id)
    {$hasil = HasilModel::find($id);
        if (!$hasil) {
        return redirect()->back()->with('error', 'hasil tidak ditemukan.');}
    $hasil->delete();
    return redirect()->route('laporan.index')->with('success', 'Data hasil perhitungan berhasil dihapus.');}
}