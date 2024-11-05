@extends('layouts.main')
@section('content')
    @include('component.sweetAlert')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-2">
                <span class="text-muted fw-light">Dashboard / Produk /</span> Edit Produk
            </h4>
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="/produk/update/{{ $produk->id_produk }}" enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Kode Produk</label>
                                <input type="text" class="form-control" name="kode_produk" value="{{ $produk->kode_produk }}" />
                                @error('kode_produk')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Nama Produk</label>
                                <input type="text" class="form-control" name="nama_produk"
                                    value="{{ $produk->nama_produk }}" />
                            </div>
                            <div class="row mb-3 py-3">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                    <a href="/produk" class="btn btn-warning me-2">Kembali</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
