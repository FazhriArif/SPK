@extends('layouts.main')
@include('component.sweetAlert')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-2">
                <span class="text-muted fw-light">Dashboard /</span> Laporan
            </h4>
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Data Hasil Perhitungan</h4>
                    <a href="#" class="btn btn-primary" onclick="printReport()">
                        <i class="bx bx-printer me-1"></i> Cetak Laporan
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive" >
                        <table class="table table-striped table-bordered">
                            <thead class="table-primary" style="text-align: center">
                                <tr>
                                    <th>NO</th>
                                    <th>Nama Produk</th>
                                    <th>Rekomendasi Alternatif</th>
                                    <th>Tanggal Penyimpanan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($hasilPerhitungan as $hasil)
                                    <tr style="text-align: center">
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $hasil->nama_produk }}</td>
                                        <td>
                                            <ol>
                                                @foreach(explode(',', $hasil->rekom_alter) as $index => $alter)
                                                    <li>{{ trim($alter) }}</li>
                                                @endforeach
                                            </ol>
                                        </td>
                                        <td>{{ $hasil->waktu_penyimpanan->format('Y-m-d H:i:s') }}</td>
                                        <td>
                                            <form id="deleteForm{{ $hasil->id }}" action="{{ route('laporan.delete', $hasil->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a href="#" class="btn btn-danger mt-2" onclick="confirmDelete({{ $hasil->id }})">
                                                    <i class="bx bx-trash me-1"></i> Delete
                                                </a>
                                            </form>
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

    <div id="printSection" style="display: none;">
        <div class="company-profile">
            <img src="{{ asset('landingasset/img/SM.png') }}" alt="Sona Meubel Logo">
            <div>
                <h2>Sona Meubel</h2>
                <p>Alamat: Jl. Syekh Datul Kahfi No.192 Plered, Cirebon.</p>
                <p>Telepon: 087803204713</p>
                <p>Email: sonameubel@gmail.com</p>
                <hr>
            </div>
        </div>
        <h2>Hasil Perhitungan Produk</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-primary">
                    <tr>
                        <th>NO</th>
                        <th>Nama Produk</th>
                        <th>Rekomendasi Alternatif</th>
                        <th>Tanggal Penyimpanan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($hasilPerhitungan as $hasil)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $hasil->nama_produk }}</td>
                            <td>
                                <ol>
                                    @foreach(explode(',', $hasil->rekom_alter) as $index => $alter)
                                        <li>{{ trim($alter) }}</li>
                                    @endforeach
                                </ol>
                            </td>
                            <td>{{ $hasil->waktu_penyimpanan->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
@endsection

<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #printSection, #printSection * {
            visibility: visible;
        }
        #printSection {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            padding: 20px; /* Tambahkan padding untuk memberi ruang di sekitar konten */
            box-sizing: border-box; /* Pastikan padding tidak mempengaruhi lebar elemen */
        }
        .company-profile {
            text-align: left; /* Mengubah teks profil perusahaan menjadi rata kiri */
            margin-bottom: 20px;
            page-break-inside: avoid; /* Hindari pemisahan halaman di dalam profil perusahaan */
        }
        .company-profile img {
            max-width: 100px;
            height: auto;
            float: left;
            margin-right: 10px;
        }
        .company-profile div {
            display: inline-block;
            vertical-align: top; /* Memastikan teks profil perusahaan tetap sejajar dengan logo */
        }
        .card-header, .card-body {
            page-break-inside: avoid;
        }
        .card-body .table-responsive table tr td:last-child {
            display: none;
        }
        /* Override scrollbar visibility */
        body {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }

        body::-webkit-scrollbar {
            display: none;  /* Chrome, Safari, Opera*/
        }
    }
</style>


<script>
// function confirmDelete(id) {
//     if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
//         document.getElementById('deleteForm' + id).submit();
//     }
// }

function printReport() {
    var printSection = document.getElementById('printSection');
    var originalContent = document.body.innerHTML;

    printSection.style.display = 'block';
    window.print();
    printSection.style.display = 'none';
}
</script>
