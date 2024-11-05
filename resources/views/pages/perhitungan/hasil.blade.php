@extends('layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-2">
                <span class="text-muted fw-light">Dashboard /</span> Hasil Perhitungan
            </h4>
            <!-- WP Bobot Produk -->
            <span style="color: black">WP NILAI BOBOT KRITERIA PRODUK</span>
            <div class="table-responsive text-nowrap" style="text-align: center">
                <table id="bobotproduktable" class="table table-striped table-bordered">
                    <thead  class="table-primary"> 
                        <tr>
                            <th>Nama Produk</th>
                            <th>C01</th>
                            <th>C02</th>
                            <th>C03</th>
                            <th>C04</th>
                            <th>C05</th>
                            <th>C06</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($nilaiProduk as $nilai)
                        <tr>
                            <td>{{ $nilai['nama_produk'] }}</td>
                            <td>{{ $nilai['c01'] }}</td>
                            <td>{{ $nilai['c02'] }}</td>
                            <td>{{ $nilai['c03'] }}</td>
                            <td>{{ $nilai['c04'] }}</td>
                            <td>{{ $nilai['c05'] }}</td>
                            <td>{{ $nilai['c06'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- WP Bobot Ternormalisasi -->
            <span style="color: black">WP NILAI NORMALISASI TERBOBOT</span>
            <div class="table-responsive text-nowrap text-black" style="text-align: center">
                <table id="normalbobottable" class="table table-striped table-bordered">
                    <thead class="table-primary"> 
                        <tr>
                            <th>Nama Produk</th>
                            <th>C01</th>
                            <th>C02</th>
                            <th>C03</th>
                            <th>C04</th>
                            <th>C05</th>
                            <th>C06</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($nilaiProduk as $nilai)
                        <tr>
                            <td>{{ $nilai['nama_produk'] }}</td>
                            <td>{{ number_format($bobot['c01'], 4) }}</td>
                            <td>{{ number_format($bobot['c02'], 4) }}</td>
                            <td>{{ number_format($bobot['c03'], 4) }}</td>
                            <td>{{ number_format($bobot['c04'], 4) }}</td>
                            <td>{{ number_format($bobot['c05'], 4) }}</td>
                            <td>{{ number_format($bobot['c06'], 4) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

             <!-- TOPSIS Hasil Analisa -->
            <span style="color: black"> TOPSIS MATRIKS KEPUTUSAN</span>
            <div class="table-responsive text-nowrap text-black"  style="text-align: center">
                <table id="matrikskeputusantable" class="table table-striped table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th>Alternatif</th>
                            <th>C01</th>
                            <th>C02</th>
                            <th>C03</th>
                            <th>C04</th>
                            <th>C05</th>
                            <th>C06</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($nilaiAlter as $alt)
                        <tr>
                            <td>{{ $alt->nama_alternatif }}</td>
                            <td>{{ $alt->c01 }}</td>
                            <td>{{ $alt->c02 }}</td>
                            <td>{{ $alt->c03 }}</td>
                            <td>{{ $alt->c04 }}</td>
                            <td>{{ $alt->c05 }}</td>
                            <td>{{ $alt->c06 }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
           <!-- TOPSIS Matriks Ternormalisasi (R) -->
           <span style="color: black"> TOPSIS MATRIKS KEPUTUSAN TERNOMALISASI (R)</span> 
           <div class="table-responsive text-nowrap text-black"  style="text-align: center">
            <table id="matriksRtable" class="table table-striped table-bordered">
                <thead class="table-primary">
                       <tr>
                           <th>Alternatif</th>
                           <th>C01</th>
                           <th>C02</th>
                           <th>C03</th>
                           <th>C04</th>
                           <th>C05</th>
                           <th>C06</th>
                       </tr>
                   </thead>
                   <tbody class="table-border-bottom-0">
                    @foreach ($matrixR as $r)
                        <tr>
                            <td>{{ $r['nama_alternatif'] }}</td>
                            <td>{{ number_format($r['c01'], 4) }}</td>
                            <td>{{ number_format($r['c02'], 4) }}</td>
                            <td>{{ number_format($r['c03'], 4) }}</td>
                            <td>{{ number_format($r['c04'], 4) }}</td>
                            <td>{{ number_format($r['c05'], 4) }}</td>
                            <td>{{ number_format($r['c06'], 4) }}</td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
            </div>
            <!-- TOPSIS Matriks Terbobot (Y) -->
            <span style="color: black">TOPSIS MATRIKS KEPUTUSAN TERBOBOT (Y)</span>
            <div class="table-responsive text-nowrap text-black" style="text-align: center">
                <table id="nilaiAlterTable" class="table table-striped table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th>Alternatif</th>
                            <th>C01</th>
                            <th>C02</th>
                            <th>C03</th>
                            <th>C04</th>
                            <th>C05</th>
                            <th>C06</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($matrixY as $row)
                    <tr>
                        <td>{{ $row['nama_alternatif'] }}</td>
                        <td>{{ number_format($row['c01'], 4) }}</td>
                        <td>{{ number_format($row['c02'], 4) }}</td>
                        <td>{{ number_format($row['c03'], 4) }}</td>
                        <td>{{ number_format($row['c04'], 4) }}</td>
                        <td>{{ number_format($row['c05'], 4) }}</td>
                        <td>{{ number_format($row['c06'], 4) }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Solusi Ideal -->
            <span style="color: black">TOPSIS SOLUSI IDEAL</span>
            <div class="table-responsive text-nowrap text-black" style="text-align: center">
                <table id="nilaiAlterTable" class="table table-striped table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th></th>
                            <th>C01</th>
                            <th>C02</th>
                            <th>C03</th>
                            <th>C04</th>
                            <th>C05</th>
                            <th>C06</th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th>A+</th>
                            <td>{{ number_format($Aplus['c01'], 4) }}</td>
                            <td>{{ number_format($Aplus['c02'], 4) }}</td>
                            <td>{{ number_format($Aplus['c03'], 4) }}</td>
                            <td>{{ number_format($Aplus['c04'], 4) }}</td>
                            <td>{{ number_format($Aplus['c05'], 4) }}</td>
                            <td>{{ number_format($Aplus['c06'], 4) }}</td>
                        </tr>
                        <tr>
                            <th>A-</th>
                            <td>{{ number_format($Aminus['c01'], 4) }}</td>
                            <td>{{ number_format($Aminus['c02'], 4) }}</td>
                            <td>{{ number_format($Aminus['c03'], 4) }}</td>
                            <td>{{ number_format($Aminus['c04'], 4) }}</td>
                            <td>{{ number_format($Aminus['c05'], 4) }}</td>
                            <td>{{ number_format($Aminus['c06'], 4) }}</td>
                        </tr>
                    </thead>
                </table>
            </div>

            <!-- Jarak Solusi Ideal Positif dan Negatif -->
            <span style="color: black">TOPSIS JARAK SOLUSI IDEAL</span>
            <div class="table-responsive text-nowrap text-black" style="text-align: center">
                <table id="nilaiAlterTable" class="table table-striped table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th>ALTERNATIF</th>
                            <th>D+</th>
                            <th>D-</th>
                            <th>PREFERENSI</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($matrixY as $row)
                        <tr>
                            <td>{{ $row['nama_alternatif'] }}</td>
                            <td>{{ number_format($Dplus[$row['nama_alternatif']], 4) }}</td>
                            <td>{{ number_format($Dminus[$row['nama_alternatif']], 4) }}</td>
                            <td>{{ number_format($preferensi[$row['nama_alternatif']], 4) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- TOPSIS PERANKINGAN -->
            <span style="color: black">TOPSIS PERANKINGAN</span>
            <div class="table-responsive text-nowrap text-black" style="text-align: center">
                <table id="nilaiAlterTable" class="table table-striped table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th>ALTERNATIF</th>
                            <th>PREFERENSI</th>
                            <th>RANKING</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($ranking as $row)
                        <tr>
                            <td>{{ $row['nama_alternatif'] }}</td>
                            <td>{{ number_format($row['preferensi'], 4) }}</td>
                            <td>{{ $row['ranking'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- KESIMPULAN -->
            <!-- KESIMPULAN -->
        <span style="color: black">KESIMPULAN</span>
        <div class="kesimpulan-section" style="text-align: center;">
            <div class="table-responsive text-nowrap text-black">
                <table id="nilaiAlterTable" class="table table-striped table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th>Kesimpulan</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td>Berdasarkan hasil perhitungan, alternatif yang direkomendasikan untuk produk Anda adalah:
                                @if(count($ranking) >= 3)
                                    {{ $ranking[0]['nama_alternatif'] }} (Rank 1),
                                    {{ $ranking[1]['nama_alternatif'] }} (Rank 2),
                                    {{ $ranking[2]['nama_alternatif'] }} (Rank 3).
                                @else
                                    @foreach ($ranking as $key => $row)
                                        {{ $row['nama_alternatif'] }} (Rank {{ $key + 1 }}),
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <br>
            <!-- Tombol Simpan Hasil -->
            <form action="{{ route('laporan.index.store') }}" method="POST">
                @csrf
                <input type="hidden" name="nama_produk" value="{{ $nama_produk }}">
                <input type="hidden" name="rekom_alter" value="{{ $rankingAlternatif[0]['nama_alternatif'] }}, {{ $rankingAlternatif[1]['nama_alternatif'] }}, {{ $rankingAlternatif[2]['nama_alternatif'] }}">
                <button type="submit" class="btn btn-success">Simpan Hasil</button>
            </form>
            <br>
        
        <style>
        .kesimpulan-section {
            margin: 0 auto;
            padding: 20px;
            max-width: 100%;
        }
        
        .kesimpulan-section .table {
            margin: 0 auto;
            width: 100%;
            max-width: 100%;
            table-layout: auto;
            word-wrap: break-word;
            white-space: normal;
        }
        
        .kesimpulan-section .table td {
            text-align: center;
        }
        
        .kesimpulan-section .save-result-form {
            text-align: right; /* Posisikan tombol di sebelah kanan */
            margin-top: 20px; /* Tambahkan margin atas untuk jarak dari tabel */
        }
        .text-black {
            color: black;
        }
        @media (max-width: 768px) {
            .kesimpulan-section .table-responsive {
                overflow-x: auto;
            }
        
            .kesimpulan-section .table td {
                word-wrap: break-word;
                white-space: normal;
            }
        }
        </style>
        
        <script>
            // Jika tombol simpan berhasil diklik, arahkan ke halaman laporan/index
            document.querySelector('.save-result-form').addEventListener('submit', function(event) {
                // event.preventDefault(); // Tidak perlu mencegah pengiriman form default
                // window.location.href = "{{ route('laporan.index') }}"; // Biarkan server-side redirect yang menangani pengalihan
            });
        </script>
        @endsection