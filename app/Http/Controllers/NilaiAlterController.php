<?php
namespace App\Http\Controllers;
use App\Models\NilaiAlterModel;
use App\Models\AlternatifModel;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\SettingModel;
use Illuminate\Validation\Rule;
class NilaiAlterController extends Controller
{
    public function index()
    {   $nilaiAlter = NilaiAlterModel::All();
        $settingItem = SettingModel::first();

        return view('pages.nilaialternatif.index', [
            'title' => 'Daftar Nilai Alter',
            'active' => 'nilai_alter',
            'nilaiAlter' => $nilaiAlter,
            'settingItem' => $settingItem,
        ]);}
    public function create()
    {   $alternatif = AlternatifModel::all();
        $settingItem = SettingModel::first();
        return view('pages.nilaialternatif.create', [
            'title' => 'Tambah Nilai Alter',
            'active' => 'nilai_alter',
            'alternatif' => $alternatif,
            'settingItem' => $settingItem, ]); }
    public function store(Request $request)
    {$validator = Validator::make($request->all(), [
        'nama_alternatif' => 'required|exists:alternatif,nama_alternatif',
        'c01' => 'required|integer',
        'c02' => 'required|integer',
        'c03' => 'required|integer',
        'c04' => 'required|integer',
        'c05' => 'required|integer',
        'c06' => 'required|integer', ], [
        'required' => 'Kolom :attribute harus diisi.',
        'exists' => 'Kolom :attribute tidak valid.',
        'integer' => 'Kolom :attribute harus berupa angka.',]);
    try {
        if ($validator->fails()) {
            throw new ValidationException($validator);}
        $validatedData = $validator->validated();
        NilaiAlterModel::create($validatedData);
        return redirect('/nilaialternatif')->with('success', 'Nilai Alternatif berhasil ditambahkan.');
    } catch (ValidationException $e) {
        if ($request->expectsJson()) {
            return response()->json(['errors' => $e->errors()], 422);}
        return redirect()->back()->withErrors($e->errors())->withInput();
    } catch (\Exception $e) {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Gagal menyimpan data. Silakan coba lagi.'], 500);}
        return redirect()->back()->with('error', 'Gagal menyimpan data. Silakan coba lagi.');}
}
    public function edit($id)
    {   $nilaiAlter = NilaiAlterModel::findOrFail($id);
        $alternatif = AlternatifModel::all();
        $settingItem = SettingModel::first();
        return view('pages.nilaialternatif.edit', [
            'title' => 'Edit Nilai Alter',
            'active' => 'nilai_alter',
            'nilaiAlter' => $nilaiAlter,
            'alternatif' => $alternatif,
            'settingItem' => $settingItem]);}
            public function update(Request $request, $id)
            {
                $nilaiAlter = NilaiAlterModel::find($id);
                if (!$nilaiAlter) {
                    return redirect('/nilaialternatif')->with('error', 'Data nilai Alternatif tidak ditemukan.');
                }
            
                $validator = Validator::make($request->all(), [
                    'nama_alternatif' => 'required|string',
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
            
                try {
                    if ($validator->fails()) {
                        throw new ValidationException($validator);
                    }
            
                    $validatedData = $validator->validated();
            
                    // Update Nilai Alternatif
                    $nilaiAlter->update($validatedData);
            
                    // Update Nama Alternatif
                    $alternatif = AlternatifModel::find($nilaiAlter->alternatif_id);
                    if ($alternatif) {
                        $alternatif->nama_alternatif = $request->nama_alternatif;
                        $alternatif->save();
                    }
            
                    return redirect('/nilaialternatif')->with('success', 'Data nilai alternatif berhasil diperbarui.');
                } catch (ValidationException $e) {
                    if ($request->expectsJson()) {
                        return response()->json(['errors' => $e->errors()], 422);
                    }
                    return redirect()->back()->withErrors($e->errors())->withInput();
                } catch (\Exception $e) {
                    if ($request->expectsJson()) {
                        return response()->json(['error' => 'Gagal menyimpan data. Silakan coba lagi.'], 500);
                    }
                    return redirect()->back()->with('error', 'Gagal menyimpan data. Silakan coba lagi.');
                }
            }
            
    public function destroy(int $id)
    {   $nilaiAlter = NilaiAlterModel::find($id);
        if (!$nilaiAlter) {
            return redirect()->back()->with('error', 'Data nilai Alternatif tidak ditemukan.');}
          $nilaiAlter->delete();
        return redirect()->back()->with('success', 'Data nilai Alternatif berhasil dihapus.');}
}
