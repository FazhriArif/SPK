<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\NilaiKriteriaModel;
use App\Models\SettingModel;
use App\Models\KriteriaModel; 
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class NilaiKriteriaController extends Controller
{
    public function index()
    {   $nilaiKriteria=NilaiKriteriaModel::all();
        $settingItem = SettingModel::first();
            return view('pages.nilaikriteria.index', [
            'title' => 'Nilai Kriteria',
            'active' => 'nilaiKriteria',
            'nilaiKriteria' => $nilaiKriteria,
            'settingItem' => $settingItem,]);}

    public function create()
    {   $settingItem = SettingModel::first();
        $kriteria = KriteriaModel::all(); 
            return view('pages.nilaikriteria.create', [
            'title' => 'Tambah Nilai Kriteria',
            'active' => 'nilaikriteria',
            'kriteria' => $kriteria,
            'settingItem' => $settingItem,]);}
        public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_kriteria' => 'required|exists:kriteria,kode_kriteria',
            'keterangan' => 'nullable|max:255',
            'nilai' => 'required|integer',
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'exists' => 'Kolom :attribute tidak valid.',
            'max' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
            'integer' => 'Kolom :attribute harus berupa angka.',
        ]);
        try {
            if ($validator->fails()) {
                throw new ValidationException($validator);}
            $validatedData = $validator->validated();
            NilaiKriteriaModel::create($validatedData);
            return redirect('/nilaikriteria')->with('success', 'Data nilai kriteria berhasil ditambahkan.');
        } catch (ValidationException $e) {
            if ($request->expectsJson()) {
                return response()->json(['errors' => $e->errors()], 422); }
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Gagal menyimpan data. Silakan coba lagi.'], 500); }
            return redirect()->back()->with('error', 'Gagal menyimpan data. Silakan coba lagi.');}
    }
    public function edit($id)
    {   $settingItem = SettingModel::first();
        $nilaiKriteria = NilaiKriteriaModel::findOrFail($id);
        $kriteria = KriteriaModel::all(); 
        return view('pages.nilaikriteria.edit', [
            'title' => 'Edit Nilai Kriteria',
            'active' => 'nilaikriteria',
            'nilaiKriteria' => $nilaiKriteria,
            'kriteria' => $kriteria,
            'settingItem' => $settingItem,]); }
    public function update(Request $request, $id)
    {   $nilaiKriteria = NilaiKriteriaModel::find($id);
        if (!$nilaiKriteria) {
            return redirect('/nilaikriteria')->with('error', 'Data nilai kriteria tidak ditemukan.'); }
        $validator = Validator::make($request->all(), [
            'kode_kriteria' => 'required|exists:kriteria,kode_kriteria',
            'keterangan' => 'nullable|max:255',
            'nilai' => 'required|integer',], [
            'required' => 'Kolom :attribute harus diisi.',
            'exists' => 'Kolom :attribute tidak valid.',
            'max' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
            'integer' => 'Kolom :attribute harus berupa angka.',]);
        try {
            if ($validator->fails()) {
                throw new ValidationException($validator);}
            $validatedData = $validator->validated();
            $nilaiKriteria->update($validatedData);
            return redirect('/nilaikriteria')->with('success', 'Data nilai kriteria berhasil diperbarui.');
        } catch (ValidationException $e) {
            if ($request->expectsJson()) {
                return response()->json(['errors' => $e->errors()], 422);
            }
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Gagal menyimpan data. Silakan coba lagi.'], 500);}
            return redirect()->back()->with('error', 'Gagal menyimpan data. Silakan coba lagi.');}}
    public function destroy(int $id)
    {   $nilaiKriteria = NilaiKriteriaModel::find($id);
        if (!$nilaiKriteria) {
            return redirect()->back()->with('error', 'Data nilai kriteria tidak ditemukan.');        }
        $nilaiKriteria->delete();
        return redirect()->back()->with('success', 'Data nilai kriteria berhasil dihapus.');}
}
