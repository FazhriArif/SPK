@extends('layouts.main')

@section('content')
    @include('component.sweetAlert')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-2">
                <span class="text-muted fw-light">Dashboard /</span> Tambah Nilai Alternatif
            </h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Tambah Nilai Alternatif</h4>
                        </div>
                        <div class="card-body">
                            <form action="/nilaialternatif/store" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="alternatif_id" class="form-label">Nama Alternatif</label>
                                    <select class="form-control" name="nama_alternatif" value="{{ old('nama_alternatif') }}">
                                        <option value="">Pilih Nama Alternatif</option>
                                        @foreach ($alternatif as $alt)
                                            <option value="{{ $alt->nama_alternatif }}">{{ $alt->nama_alternatif }}</option>
                                        @endforeach
                                    </select>
                                    @error('nama_alternatif')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Input fields for c01 to c06 -->
                                <div class="mb-3">
                                    <label for="c01" class="form-label">C01 - Usia</label>
                                    <select class="form-control" name="c01" id="c01" required>
                                        <option value="">Pilih Usia Kayu</option>
                                        <option value="4">4 - >50 Tahun</option>
                                        <option value="3">3 - 21-50 Tahun</option>
                                        <option value="2">2 - 11-20 Tahun</option>
                                        <option value="1">1 - 0-10 Tahun</option>
                                    </select>
                                    @error('c01')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="c02" class="form-label">C02 - Sifat Fisik</label>
                                    <select class="form-control" name="c02" id="c02" required>
                                        <option value="">Pilih Sifat Fisik</option>
                                        <option value="4">4 - Sangat Keras</option>
                                        <option value="3">3 - Keras</option>
                                        <option value="2">2 - Sedang</option>
                                        <option value="1">1 - Lunak</option>
                                    </select>
                                    @error('c02')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="c03" class="form-label">C03 - Kekuatan</label>
                                    <select class="form-control" name="c03" id="c03" required>
                                        <option value="">Pilih Kekuatan</option>
                                        <option value="4">4 - Sangat Tinggi</option>
                                        <option value="3">3 - Tinggi</option>
                                        <option value="2">2 - Sedang</option>
                                        <option value="1">1 - Rendah</option>
                                    </select>
                                    @error('c03')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="c04" class="form-label">C04 - Harga</label>
                                    <select class="form-control" name="c04" id="c04" required>
                                        <option value="">Pilih Harga</option>
                                        <option value="1">1 - 1.500.000 - 3.000.000</option>
                                        <option value="2">2 - 3.000.000 - 5.000.000</option>
                                        <option value="3">3 - 5.000.000 - 8.000.000</option>
                                        <option value="4">4 - >8.000.000</option>
                                    </select>
                                    @error('c04')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="c05" class="form-label">C05 - Diameter</label>
                                    <select class="form-control" name="c05" id="c05" required>
                                        <option value="">Pilih Diameter</option>
                                        <option value="4">4 - >60 cm</option>
                                        <option value="3">3 - 41-60 cm</option>
                                        <option value="2">2 - 21-40 cm</option>
                                        <option value="1">1 - 0-20 cm</option>
                                    </select>
                                    @error('c05')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="c06" class="form-label">C06 - Daya Tahan</label>
                                    <select class="form-control" name="c06" id="c06" required>
                                        <option value="">Pilih Daya Tahan</option>
                                        <option value="4">4 - Tahan hama dan cuaca</option>
                                        <option value="3">3 - Tahan cuaca</option>
                                        <option value="2">2 - Tahan hama</option>
                                        <option value="1">1 - Mudah rapuh</option>
                                    </select>
                                    @error('c06')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <a href="/nilaialternatif" class="btn btn-warning me-2">Kembali</a>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
