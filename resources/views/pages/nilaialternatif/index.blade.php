@extends('layouts.main')

@section('content')
    @include('component.sweetAlert')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-2">
                <span class="text-muted fw-light">Dashboard /</span> Nilai Alternatif
            </h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="add-button-container">
                                <h4>Data Nilai Alternatif</h4>
                                <a href="/nilaialternatif/create" class="btn btn-primary add-button btn-sm">
                                    <span class="tf-icons bx bx-plus-circle"></span>&nbsp;Tambah Nilai Alternatif
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table id="nilaiAlterTable" class="table table-striped">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Kayu</th>
                                        <th>C01</th>
                                        <th>C02</th>
                                        <th>C03</th>
                                        <th>C04</th>
                                        <th>C05</th>
                                        <th>C06</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <?php $i = 1; ?>
                                    @foreach ($nilaiAlter as $item)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>
                                                @if($item->alternatif)
                                                    {{ $item->alternatif->kode_alternatif }} - {{ $item->alternatif->nama_alternatif }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ $item->c01 }}</td>
                                            <td>{{ $item->c02 }}</td>
                                            <td>{{ $item->c03 }}</td>
                                            <td>{{ $item->c04 }}</td>
                                            <td>{{ $item->c05 }}</td>
                                            <td>{{ $item->c06 }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="/nilaialternatif/edit/{{ $item->id_nilai_alter }}">
                                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                                        </a>
                                                        <form id="deleteForm{{ $item->id_nilai_alter }}" action="/nilaialternatif/delete/{{ $item->id_nilai_alter }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="#" class="dropdown-item" onclick="confirmDelete({{ $item->id_nilai_alter }})">
                                                                <i class="bx bx-trash me-1"></i> Delete
                                                            </a>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
