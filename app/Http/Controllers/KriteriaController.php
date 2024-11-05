<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\KriteriaModel;
use App\Models\SettingModel;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class kriteriaController extends Controller
{
    public function index()
    {
        $kriteria = KriteriaModel::all();
        $settingItem = SettingModel::first();
        return view('pages.kriteria.index', [
            'title' => 'Kriteria',
            'active' => 'Kriteria',
            'kriteria' => $kriteria,
            'settingItem' => $settingItem, 
        ]);
    }
    public function create()
    {
        $settingItem = SettingModel::first();
        return view('pages.kriteria.create', [
            'title' => 'Tambah kriteria',
            'active' => 'kriteria',
            'settingItem' => $settingItem,]);}
    public function store(Request $request)
    {$validator = Validator::make($request->all(), [
            'kode_kriteria' => 'required|max:40|unique:kriteria,kode_kriteria',
            'nama_kriteria' => 'required',
            'atribut' => ['required', Rule::in(['benefit', 'cost'])]
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'max' => [
                'string' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
            ],
            'unique' => 'Kode kriteria sudah ada. Harap pilih kode kriteria yang lain.',
            'in' => 'Kolom :attribute harus salah satu dari: :values.', ]);
        try {
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
                $validatedData = $validator->validated();
            KriteriaModel::create($validatedData);
            return redirect('/kriteria')->with('success', 'Data kriteria berhasil ditambahkan.');
        } catch (ValidationException $e) {
            if ($request->expectsJson()) {
                return response()->json(['errors' => $e->errors()], 422);
            }
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Gagal menyimpan data. Silakan coba lagi.'], 500);
            }
            return redirect()->back()->with('error', 'Gagal menyimpan data. Silakan coba lagi.'); }
    }
    public function edit($id)
    {
        $settingItem = SettingModel::first();
        return view('pages.kriteria.edit', [
            'title' => 'Edit kriteria',
            'active' => 'kriteria',
            'kriteria' => KriteriaModel::findOrFail($id),
            'settingItem' => $settingItem, ]);
    }
    public function update(Request $request, $id)
    {
        $kriteria = KriteriaModel::find($id);
        if (!$kriteria) {
            return redirect('/kriteria')->with('error', 'Data kriteria tidak ditemukan.');}
        $validator = Validator::make($request->all(), [
            'kode_kriteria' => 'required|max:40',
            'nama_kriteria' => 'required',
            'atribut' => ['required', Rule::in(['benefit', 'cost'])]
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'max' => [
                'string' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
            ],
            'image' => 'Kolom :attribute harus berupa file gambar.',
            'mimes' => 'Kolom :attribute harus memiliki format: :values.',
            'integer' => 'Kolom :attribute harus berupa angka.',
            'numeric' => 'Kolom :attribute harus berupa angka.',
            'unique' => 'Kode sudah ada. Harap pilih Kode yang lain.',
        ]);
        try {
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
            $validatedData = $validator->validated();
            $kriteria->update($validatedData);
            return redirect('/kriteria')->with('success', 'Data kriteria Berhasil Diperbarui!');
        } catch (ValidationException $e) {
            if ($request->expectsJson()) {
                return response()->json(['errors' => $e->errors()], 422); }
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Gagal menyimpan data. Silakan coba lagi.'], 500);}
            return redirect()->back()->with('error', 'Gagal menyimpan data. Silakan coba lagi.');
        }
    }
    public function destroy(int $id)
    {$kriteria = KriteriaModel::find($id);
        if (!$kriteria) {
            return redirect()->back()->with('error', 'kriteria tidak ditemukan.');}
        $kriteria->delete();
        return redirect()->back()->with('success', 'kriteria berhasil dihapus.');
    }
}