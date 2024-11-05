<?php

namespace App\Http\Controllers;

use App\Models\AlternatifModel;
use App\Models\SettingModel;
use App\Models\NilaiAlterModel;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AlternatifController extends Controller
{
    public function index()
    {
        $alternatif = AlternatifModel::all();
        $settingItem = SettingModel::first();
        
        return view('pages.alternatif.index', [
            'title' => 'alternatif',
            'active' => 'alternatif',
            'alternatif' => $alternatif,
            'settingItem' => $settingItem,
        ]);
    }
    
    public function create()
    {
        $settingItem = SettingModel::first();
        return view('pages.alternatif.create', [
            'title' => 'Tambah alternatif',
            'active' => 'alternatif',
            'settingItem' => $settingItem,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_alternatif' => 'required|max:40|unique:alternatif,kode_alternatif',
            'nama_alternatif' => 'required|max:100'
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'max' => [
                'string' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
            ],
            'unique' => 'Kode alternatif sudah ada. Harap pilih kode alternatif yang lain.',
        ]);
    
        try {
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
    
            $validatedData = $validator->validated();
    
            AlternatifModel::create($validatedData);
    
            return redirect('/alternatif')->with('success', 'Data alternatif Berhasil Ditambahkan.');
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

    public function edit($id)
    {
        $settingItem = SettingModel::first();
        return view('pages.alternatif.edit', [
            'title' => 'Edit alternatif',
            'active' => 'alternatif',
            'alternatif' => AlternatifModel::findOrFail($id),
            'settingItem' => $settingItem,
        ]);
    }

    public function update(Request $request, $id)
    {
        $alternatif = AlternatifModel::find($id);
        if (!$alternatif) {
            return redirect('/alternatif')->with('error', 'Data Alternatif tidak ditemukan.');
        }

        $validator = Validator::make($request->all(), [
            'kode_alternatif' => 'required|string|max:255',
            'nama_alternatif' => 'required|string|max:255',
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'string' => 'Kolom :attribute harus berupa teks.',
            'max' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
        ]);

        try {
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $validatedData = $validator->validated();

            // Update Alternatif
            $alternatif->update($validatedData);

            // Nama alternatif di nilai_alter akan diupdate oleh event listener di AlternatifModel

            return redirect('/alternatif')->with('success', 'Data Alternatif berhasil diperbarui.');
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
    {
        $alternatif = AlternatifModel::find($id);

        if (!$alternatif) {
            return redirect()->back()->with('error', 'Alternatif tidak ditemukan.');
        }

        // Hapus data terkait di tabel nilai_alter
        NilaiAlterModel::where('nama_alternatif', $alternatif->nama_alternatif)->delete();

        $alternatif->delete();

        return redirect()->back()->with('success', 'Alternatif berhasil dihapus.');
    }
}
