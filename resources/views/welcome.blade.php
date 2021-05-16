<!doctype html>
<html lang="en">

<head>

    <!--====== Required meta tags ======-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--====== Title ======-->
    <title>SIG Potensi Desa | Home</title>

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{ asset('landing/assets/images/favicon.png') }}" type="image/png">

    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="{{ asset('landing/assets/css/bootstrap.min.css') }}">

    <!--====== Line Icons css ======-->
    <link rel="stylesheet" href="{{ asset('landing/assets/css/LineIcons.css') }}">

    <!--====== Magnific Popup css ======-->
    <link rel="stylesheet" href="{{ asset('landing/assets/css/magnific-popup.css') }}">

    <!--====== Default css ======-->
    <link rel="stylesheet" href="{{ asset('landing/aassets/css/default.css') }}">

    <!--====== Style css ======-->
    <link rel="stylesheet" href="{{ asset('landing/assets/css/style.css') }}">

    <style>
        #mapid { height: 100vh; }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.css" />


</head>

<body>

    {{-- <!--====== PRELOADER PART START ======-->

    <div class="preloader">
        <div class="loader_34">
            <div class="ytp-spinner">
                <div class="ytp-spinner-container">
                    <div class="ytp-spinner-rotator">
                        <div class="ytp-spinner-left">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                        <div class="ytp-spinner-right">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--====== PRELOADER ENDS START ======--> --}}

    <!--====== HEADER PART START ======-->

    <header id="home" class="header-area" >
        <div class="navigation fixed-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="index.html">
                                <img src="{{asset('assets/img/desasidebar.png')}}" style="height:65px" alt="Logo">
                                <span class="navbar-brand ml-2 font-weight-bold">SIG Potensi Desa</span>
                            </a> <!-- Logo -->
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item"><a class="page-scroll" href="#home">Beranda</a></li>
                                    <li class="nav-item"><a class="page-scroll" href="#about">Desa</a></li>
                                    <li class="nav-item"><a class="page-scroll" href="#service">Sekolah</a></li>
                                    <li class="nav-item"><a class="page-scroll" href="#work">Tempat Ibadah</a></li>
                                    <li class="nav-item"><a class="page-scroll" href="#blog">Tempat Wisata</a></li>
                                    <li class="nav-item"><a class="page-scroll" href="{{ route('Login Form') }}">Sign In</a></li>
                                </ul>
                            </div> <!-- navbar collapse -->
                        </nav> <!-- navbar -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- navigation -->
    </header>
    <!--====== HEADER PART ENDS ======-->

    <div id="mapid"></div>
    <!--====== BACK TOP TOP PART START ======-->

    <a href="#" class="back-to-top"><i class="lni-chevron-up"></i></a>

    <!--====== BACK TOP TOP PART ENDS ======-->







    <!--====== jquery js ======-->
    <script src="{{ asset('landing/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('landing/assets/js/vendor/jquery-1.12.4.min.js') }}"></script>

    <!--====== Bootstrap js ======-->
    <script src="{{ asset('landing/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('landing/assets/js/popper.min.js') }}"></script>

    <!--====== Magnific Popup js ======-->
    <script src="{{ asset('landing/assets/js/jquery.magnific-popup.min.js') }}"></script>

    <!--====== Parallax js ======-->
    <script src="{{ asset('landing/assets/js/parallax.min.js') }}"></script>

    <!--====== Counter Up js ======-->
    <script src="{{ asset('landing/assets/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('landing/assets/js/jquery.counterup.min.js') }}"></script>


    <!--====== Appear js ======-->
    <script src="{{ asset('landing/assets/js/jquery.appear.min.js') }}"></script>

    <!--====== Scrolling js ======-->
    <script src="{{ asset('landing/assets/js/scrolling-nav.js') }}"></script>
    <script src="{{ asset('landing/assets/js/jquery.easing.min.js') }}"></script>


    <!--====== Main js ======-->
    <script src="{{ asset('landing/assets/js/main.js') }}"></script>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
  <script src="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.min.js"></script>
  <script>
      var mymap = L.map('mapid').setView([-8.375319619905975, 115.18006704436591], 10);
      L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoiZmlyZXJleDk3OSIsImEiOiJja2dobG1wanowNTl0MzNwY3Fld2hpZnJoIn0.YRQqomJr_RmnW3q57oNykw'
        }).addTo(mymap);
        </script>
</body>

</html>
