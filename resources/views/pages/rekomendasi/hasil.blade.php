<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Bootstrap, Landing page, Template, Business, Service">
    <meta name="author" content="Grayrids">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SONA MEUBLE - HASIL REKOMENDASI</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Favicon Icon -->
    <link rel="shortcut icon" href="{{ asset('landingasset/img/MEB.png') }}" type="image/png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('landingasset/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landingasset/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('landingasset/css/LineIcons.css') }}">
    <link rel="stylesheet" href="{{ asset('landingasset/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('landingasset/css/owl.theme.css') }}">
    <link rel="stylesheet" href="{{ asset('landingasset/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('landingasset/css/nivo-lightbox.css') }}">
    <link rel="stylesheet" href="{{ asset('landingasset/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('landingasset/css/responsive.css') }}">
    <style>
        .navbar {
            background-color: #343a40;
            border-bottom: 2px solid #4CAF50;
        }
        .navbar-nav .nav-link {
            color: #fff !important;
            margin-right: 20px;
            font-size: 16px;
        }
        .navbar-nav .nav-link:hover {
            color: #4CAF50 !important;
        }
        .hero-area {
            padding: 100px 0;
            background: #4CAF50;
            color: white;
            text-align: center;
        }
        .hero-area .head-title {
            font-size: 2.5em;
            font-weight: bold;
        }
        .hero-area p {
            font-size: 1.2em;
        }
        .hero-area .btn-border-filled {
            border: 2px solid #405D72;
            color: #405D72;
            padding: 10px 20px;
        }
        .hero-area .btn-border-filled:hover {
            background: #405D72;
            color: #5e34f8;
        }
        .content-wrapper {
            padding-right: 150px;
            padding-top: 100px;
            padding-left: 150px;
            padding-bottom: 100px;
            background-color: #405D72;
        }
        .content-wrapper .container-xxl {
            background: #405D72;
            padding: 30px;
            border-radius: 8px;
        }
        .add-button-container h4 {
            margin-bottom: 0;
            font-size: 1.5em;
            margin-left: 12px;
        }
        .card-body {
            padding: 30px;
        }
        .table-container {
            margin: 0 auto;
            margin-top: 20px;
        }
        .table-container .table {
            margin: 0 auto;
            width: 100%;
            max-width: 100%;
            table-layout: auto;
            word-wrap: break-word;
            white-space: normal;
        }
        .table-container .table td {
            text-align: center;
        }
        @media (max-width: 768px) {
            .table-container .table-responsive {
                overflow-x: auto;
            }
            .table-container .table td {
                word-wrap: break-word;
                white-space: normal;
            }
        }
    </style>
</head>

<body>
<!-- Header Section Start -->
<header id="home">
    <nav class="navbar navbar-expand-md fixed-top scrolling-navbar">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <i class="lni-menu"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto w-100 justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="/">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="/rekomendasi">REKOMENDASI</a>
                    </li>  
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="/pages/panduan">PANDUAN</a>
                    </li>                            
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="/pages/tentang">TENTANG</a>
                    </li>       
                    <li class="nav-item">
                        <a class="btn btn-singin" href="/auth/login">LOGIN</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>  
</header>
<!-- Header Section End -->

<!-- Content Section Start -->
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="add-button-container">
                            <h4>Hasil Rekomendasi Jenis Kayu Untuk {{ $nama_produk }} Anda</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-container">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-primary">
                                        <tr style="text-align: center">
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Alternatif</th>
                                            <th scope="col">Preferensi</th>
                                            <th scope="col">Ranking</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ranking as $rank)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $rank['nama_alternatif'] }}</td>
                                            <td>{{ $rank['preferensi'] }}</td>
                                            <td>{{ $rank['ranking'] }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="table-container">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead class="table-primary" style="text-align: center">
                                        <tr>
                                            <th>Kesimpulan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <tr>
                                            <td>{!! $explanation !!}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery first, then Tether, then Bootstrap JS. -->
<script src="{{ asset('landingasset/js/jquery-min.js')}}"></script>
<script src="{{ asset('landingasset/js/popper.min.js')}}"></script>
<script src="{{ asset('landingasset/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('landingasset/js/owl.carousel.js')}}"></script>      
<script src="{{ asset('landingasset/js/jquery.nav.js')}}"></script>    
<script src="{{ asset('landingasset/js/scrolling-nav.js')}}"></script>    
<script src="{{ asset('landingasset/js/jquery.easing.min.js')}}"></script>     
<script src="{{ asset('landingasset/js/nivo-lightbox.js')}}"></script>     
<script src="{{ asset('landingasset/js/jquery.magnific-popup.min.js')}}"></script>     
<script src="{{ asset('landingasset/js/form-validator.min.js')}}"></script>
<script src="{{ asset('landingasset/js/contact-form-script.js')}}"></script>   
<script src="{{ asset('landingasset/js/main.js')}}"></script>
</body>
</html>
