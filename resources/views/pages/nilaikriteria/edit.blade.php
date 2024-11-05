@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4">Edit Nilai Kriteria</h4>

            @include('component.sweetAlert')
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <form action="/nilaikriteria/update/{{ $nilaiKriteria->id }}" enctype="multipart/form-data" method="post">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label class="form-label" for="kode_kriteria">Kode Kriteria</label>
                                <select class="form-control" name="kode_kriteria">
                                    <option value="">Pilih Kode Kriteria</option>
                                    @foreach ($kriteria as $kriteriaItem)
                                        <option value="{{ $kriteriaItem->kode_kriteria }}" {{ $nilaiKriteria->kode_kriteria == $kriteriaItem->kode_kriteria ? 'selected' : '' }}>
                                            {{ $kriteriaItem->kode_kriteria }} - {{ $kriteriaItem->nama_kriteria }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kode_kriteria')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="keterangan">SubKriteria</label>
                                <input type="text" class="form-control" name="keterangan" value="{{ $nilaiKriteria->keterangan }}" />
                                @error('keterangan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="nilai">Nilai</label>
                                <input type="text" class="form-control" name="nilai" value="{{ $nilaiKriteria->nilai }}" />
                                @error('nilai')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <a href="/nilaikriteria" class="btn btn-warning me-2">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
