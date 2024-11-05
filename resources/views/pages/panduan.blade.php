<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Bootstrap, Landing page, Template, Business, Service">
    <meta name="author" content="Grayrids">
    <title>SONA MEUBLE - Panduan</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css')}}" rel="stylesheet">
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{ asset('landingasset/img/SM.png') }}" type="image/png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('landingasset/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('landingasset/css/animate.css')}}">
    <link rel="stylesheet" href="{{ asset('landingasset/css/LineIcons.css')}}">
    <link rel="stylesheet" href="{{ asset('landingasset/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{ asset('landingasset/css/owl.theme.css')}}">
    <link rel="stylesheet" href="{{ asset('landingasset/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('landingasset/css/nivo-lightbox.css')}}">
    <link rel="stylesheet" href="{{ asset('landingasset/css/main.css')}}">    
    <link rel="stylesheet" href="{{ asset('landingasset/css/responsive.css')}}">
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
            font-size: 1.1em;
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
        .guide-section {
            background-color: #405D72; 
            padding: 150px 0;
        }
        .guide-text {
            margin-top: 45px;
            padding: 2px;
            background: #fff;
            border-radius: 8px;
        }
        .guide-text h2 {
            margin-bottom: 20px;
            padding-left: 30px;
            padding-top: 15px;
        }
        .guide-text p {
            font-size: 1.2em;
            line-height: 1.6;
            color: #343a40;
            padding-left: 35px;
        }
        .guide-text li {
            font-size: 1.1em;
            color: #343a40;
            line-height: 1;
            padding-left: 35px;
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

<!-- Guide Section Start -->
<section id="guide" class="guide-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="guide-text">
                    <h2 class="head-title">Panduan Penggunaan Aplikasi</h2>
                        <p>
                            Aplikasi ini dirancang untuk membantu dalam pemilihan jenis kayu terbaik untuk pembuatan mebel menggunakan metode WP-TOPSIS. Berikut adalah langkah-langkah untuk menggunakan aplikasi ini:
                        </p><br>
                        <ol>
                            <li>Pilih menu <strong>Rekomendasi</strong> untuk memilih produk dan memilih bobot produk terhadap setiap kriteria.</li><br>
                            
                            <li>Setelah semua data dimasukkan, klik tombol <strong>Rekomendasi</strong> untuk mendapatkan rekomendasi jenis kayu terbaik.</li><br>
                            <li>Hasil perhitungan akan ditampilkan. Anda dapat melihat rekomendasi alternatif beserta peringkatnya.</li><br>
                        </ol><br>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Guide Section End -->

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
