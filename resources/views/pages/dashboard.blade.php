@extends('layouts.main')
@section('content')
    @include('component.sweetAlert')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                    <div class="card">
                        <div class="d-flex align-items-end row">
                            <div class="col-sm-7">
                                <div class="card-body">
                                    <h5 class="card-title text-primary" style="font-size: 2em">Sistem Pendukung Keputusan Pemilihan Jenis Kayu</h5>
                                    <h5 class="mb-5 text-primary">
                                       SONA MEUBEL
                                    </h5>
                                </div>
                            </div>
                            <div class="col-sm-5 text-center text-sm-left">
                                <div class="card-body pb-0 px-0 px-md-4">
                                    <img src="{{ asset('template/assets/img/illustrations/wood.png') }} "
                                        height="160" alt="View Badge User"
                                        data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                        data-app-light-img="illustrations/man-with-laptop-light.png" />
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                <!-- Cards for data counts -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <a href="/produk" class="text-decoration-none">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title text-primary">
                                <i class="fas fa-box"></i> Produk
                            </h5>
                            <h3 class="text-primary">{{ $productCount }}</h3>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <a href="/alternatif" class="text-decoration-none">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title text-primary">
                                <i class="fas fa-tree"></i> Alternatif
                            </h5>
                            <h3 class="text-primary">{{ $alternativeCount }}</h3>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <a href="/kriteria" class="text-decoration-none">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title text-primary">
                                <i class="fas fa-list"></i> Kriteria
                            </h5>
                            <h3 class="text-primary">{{ $criteriaCount }}</h3>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <a href="/laporan" class="text-decoration-none">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title text-primary">
                                <i class="fas fa-file-alt"></i> Laporan
                            </h5>
                            <h3 class="text-primary">{{ $reportCount }}</h3>
                        </div>
                    </div>
                    </a>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
