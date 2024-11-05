<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Bootstrap, Landing page, Template, Business, Service">
    <meta name="author" content="Grayrids">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SONA MEUBLE - REKOMENDASI</title>
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
            background-color: #405D72;
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
            border: 2px solid white;
            color: white;
            padding: 10px 20px;
        }
        .hero-area .btn-border-filled:hover {
            background: white;
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
            background: #f9f9f9;
            padding: 30px;
            border-radius: 8px;
        }
        .add-button-container h4 {
            margin-bottom: 0;
            font-size: 2em;
        }
        .card-body {
            padding: 30px;
            
        }
        
        .mb-3 h4{
            font-size: 1.4em;
        }
        .button-container{
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 10%;
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
                            <h4 style="text-align: center">REKOMENDASI</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="perhitunganForm" action="/rekomendasi/store" method="post">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="id_produk" class="form-label">Pilih Produk</label>
                                <select class="form-control" name="nama_produk" value="{{ old('nama_produk') }}">
                                    <option value="">Pilih Produk</option>
                                    @foreach ($produk as $alt)
                                        <option value="{{ $alt->nama_produk }}">{{ $alt->nama_produk }}</option>
                                    @endforeach
                                </select>
                                @error('nama_produk')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            @foreach(['c01' => 'Usia', 'c02' => 'Sifat Fisik', 'c03' => 'Kekuatan', 'c04' => 'Harga', 'c05' => 'Diameter', 'c06' => 'Daya Tahan'] as $key => $label)
                            <div class="mb-3">
                                <label for="{{ $key }}" class="form-label">{{ $label }}</label>
                                <select class="form-control" name="{{ $key }}" id="{{ $key }}" required>
                                    <option value="">Pilih Bobot</option>
                                    @if($key == 'c01')
                                        <option value="4">>50 Tahun</option>
                                        <option value="3">21-50 Tahun</option>
                                        <option value="2">11-20 Tahun</option>
                                        <option value="1">0-10 Tahun</option>
                                    @elseif($key == 'c02')
                                        <option value="4">Sangat Keras</option>
                                        <option value="3">Keras</option>
                                        <option value="2">Sedang</option>
                                        <option value="1">Lunak</option>
                                    @elseif($key == 'c03')
                                        <option value="4">Sangat Tinggi</option>
                                        <option value="3">Tinggi</option>
                                        <option value="2">Sedang</option>
                                        <option value="1">Rendah</option>
                                    @elseif($key == 'c04')
                                        <option value="1">1.500.000-3.000.000</option>
                                        <option value="2">3.000.000-5.000.000</option>
                                        <option value="3">5.000.000-8.000.000</option>
                                        <option value="4">>8.000.000</option>
                                    @elseif($key == 'c05')
                                        <option value="4">>60 cm</option>
                                        <option value="3">41-60 cm</option>
                                        <option value="2">21-40 cm</option>
                                        <option value="1">0-20 cm</option>
                                    @elseif($key == 'c06')
                                        <option value="4">Tahan hama dan cuaca</option>
                                        <option value="3">Tahan cuaca</option>
                                        <option value="2">Tahan hama</option>
                                        <option value="1">Mudah rapuh</option>
                                    @endif
                                </select>
                                @error($key)
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @endforeach
                            <div class="button-container mt-4">
                                <button type="submit" class="btn btn-success" id="hitungButton">REKOMENDASI</button>
                            </div>
                        </form>
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
