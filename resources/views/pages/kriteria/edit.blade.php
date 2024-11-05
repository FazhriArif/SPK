@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4">Edit Kriteria</h4>

            @include('component.sweetAlert')
            <div class="row">

                <div class="card">

                    <div class="card-body">
                        <form action="/kriteria/update/{{ $kriteria->id_kriteria }}" enctype="multipart/form-data"
                            method="post">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Kode Kriteria</label>
                                <input type="text" class="form-control" name="kode_kriteria" value="{{ $kriteria->kode_kriteria }}" />
                                @error('kode_kriteria')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Nama Kriteria</label>
                                <input type="text" class="form-control" name="nama_kriteria"
                                    value="{{ $kriteria->nama_kriteria }}" />
                                @error('nama_kriteria')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="atribut">Atribut</label>
                                <select class="form-control" name="atribut">
                                    <option value="">Pilih Atribut</option>
                                    <option value="benefit" {{ old('atribut') == 'benefit' ? 'selected' : '' }}>Benefit</option>
                                    <option value="cost" {{ old('atribut') == 'cost' ? 'selected' : '' }}>Cost</option>
                                </select>
                                @error('atribut')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <a href="/kriteria" class="btn btn-warning me-2">Kembali</a>
                            <button type="submit" class="btn btn-primary me-2">Simpan</button>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
