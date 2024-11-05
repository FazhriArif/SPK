<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ProdukModel;
use App\Models\SettingModel;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class ProdukController extends Controller
{
    public function index()
    {
        $produk = ProdukModel::all();
        $settingItem = SettingModel::first();
        return view('pages.produk.index', [
            'title' => 'Produk',
            'active' => 'Produk',
            'produk' => $produk,
            'settingItem' => $settingItem, 
        ]);
    }
    public function create()
    {
        $settingItem = SettingModel::first();
        return view('pages.produk.create', [
            'title' => 'Tambah Produk',
            'active' => 'Produk',
            'settingItem' => $settingItem,]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_produk' => 'required|max:40|unique:produk,kode_produk',
            'nama_produk' => 'required',
        ], [
            'kode_produk.required' => 'Kode Produk harus diisi.',
            'kode_produk.max' => 'Kolom Kode Produk tidak boleh lebih dari :max karakter.',
            'kode_produk.unique' => 'Kode Produk sudah ada. Harap pilih Kode Produk yang lain.',
            'nama_produk.required' => 'Nama Produk harus diisi.', ]);
        try {
            if ($validator->fails()) {
                throw new ValidationException($validator);}
            $validatedData = $validator->validated();
            ProdukModel::create($validatedData);
            return redirect('/produk')->with('success', 'Data produk berhasil ditambahkan.');
        } catch (ValidationException $e) {
            if ($request->expectsJson()) {
                return response()->json(['errors' => $e->errors()], 422); }
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Gagal menyimpan data. Silakan coba lagi.'], 500);
            }
            return redirect()->back()->with('error', 'Gagal menyimpan data. Silakan coba lagi.');}
    }
    public function edit($id)
    { $settingItem = SettingModel::first();
        return view('pages.produk.edit', [
            'title' => 'Edit Produk',
            'active' => 'produk',
            'produk' => ProdukModel::findOrFail($id),
            'settingItem' => $settingItem, 
        ]);}
    public function update(Request $request, $id)
    {$produk = ProdukModel::find($id);
        if (!$produk) {
            return redirect('/produk')->with('error', 'Data produk tidak ditemukan.');}
        $validator = Validator::make($request->all(), [
            'kode_produk' => [
                'required',
                Rule::unique('produk', 'kode_produk')->ignore($produk->id_produk, 'id_produk'),
            ],
            'nama_produk' => 'required|max:40',], [
            'required' => 'Kolom :attribute harus diisi.',
            'max' => [
                'string' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
            ],
            'unique' => 'Kode produk sudah ada. Harap pilih kode produk yang lain.',]);
        try {
            if ($validator->fails()) {
                throw new ValidationException($validator);}
            $validatedData = $validator->validated();
            $produk->update($validatedData);
            return redirect('/produk')->with('success', 'Data produk Berhasil Diperbarui!');
        } catch (ValidationException $e) {
            if ($request->expectsJson()) {
                return response()->json(['errors' => $e->errors()], 422);}
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Gagal menyimpan data. Silakan coba lagi.'], 500);}
            return redirect()->back()->with('error', 'Gagal menyimpan data. Silakan coba lagi.');}
    }

    public function destroy(int $id)
    {
        $produk = ProdukModel::find($id);
        if (!$produk) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.'); }
        $produk->delete();
        return redirect()->back()->with('success', 'Produk berhasil dihapus.');
    }

    public function updateStok(Request $request)
    {
        // Validasi request
        $validator = Validator::make($request->all(), [
            'id_produk' => 'required|exists:produk,id_produk',
            'qty' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validasi gagal', 'errors' => $validator->errors()], 422);
        }

        // Ambil data yang diperlukan dari request
        $id_produk = $request->input('id_produk');
        $qty = $request->input('qty');

        try {
            // Lakukan operasi pembaruan stok
            ProdukModel::updateStok($id_produk, $qty);

            return response()->json(['message' => 'Stok produk berhasil diperbarui'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal memperbarui stok produk', 'error' => $e->getMessage()], 500);
        }
    }
}
