@extends('layouts.main')
@section('content')
    @include('component.sweetAlert')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-2">
                <span class="text-muted fw-light">Dashboard /</span> Kriteria
            </h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="add-button-container">
                                <h4>Data Kriteria</h4>
                                <a href="/kriteria/create" class="btn btn-primary add-button btn-sm">
                                    <span class="tf-icons bx bx-plus-circle"></span>&nbsp;Tambah Kriteria
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table id="kriteriaTable" class="table table-striped">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Kriteria</th>
                                        <th>Nama Kriteria</th>
                                        <th>Atribut</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <?php $i = 1; ?>
                                    @foreach ($kriteria as $item)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $item->kode_kriteria }}</td>
                                            <td>{{ $item->nama_kriteria }}</td>
                                            <td>{{ ucfirst($item->atribut) }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="/kriteria/edit/{{ $item->id_kriteria }}">
                                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                                        </a>
                                                        <form id="deleteForm{{ $item->id_kriteria }}" action="/kriteria/delete/{{ $item->id_kriteria }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="#" class="dropdown-item" onclick="confirmDelete({{ $item->id_kriteria }})">
                                                                <i class="bx bx-trash me-1"></i>Delete
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
    @endsection

    <script>
        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus kriteria ini?')) {
                document.getElementById('deleteForm' + id).submit();
            }
        }
    </script>
