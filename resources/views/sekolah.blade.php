<!doctype html>
<html lang="en">

<head>

    <!--====== Required meta tags ======-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--====== Title ======-->
    <title>SIG Potensi Desa | Sekolah</title>

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{asset('assets/img/desasidebar.png')}}" type="image/png">

    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="{{ asset('landing/assets/css/bootstrap.min.css') }}">

    <!--====== Line Icons css ======-->
    <link rel="stylesheet" href="{{ asset('landing/assets/css/LineIcons.css') }}">

    <!--====== Magnific Popup css ======-->
    <link rel="stylesheet" href="{{ asset('landing/assets/css/magnific-popup.css') }}">

    <!--====== Default css ======-->
    <link rel="stylesheet" href="{{ asset('landing/assets/css/default.css') }}">

    <!--====== Style css ======-->
    <link rel="stylesheet" href="{{ asset('landing/assets/css/style.css') }}">

    <!--====== Marker Cluster ======-->
    <link href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css" rel="stylesheet" />
    <link href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        #mapid { height: 100vh; }
        p { margin:0 }
        .marker-cluster-sekolah {
            background-color: rgba(154,205,50 ,1 );
            color: white;
        }
        .marker-cluster-sekolah div {
            background-color: rgba(160,190,15 ,1 );
        }
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
                            <a class="navbar-brand" href="{{ route('home') }}">
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
                                    <li class="nav-item"><a class="page-scroll" href="{{ route('home') }}">Beranda</a></li>
                                    <li class="nav-item"><a class="page-scroll" href="{{ route('desa') }}">Desa</a></li>
                                    <li class="nav-item"><a class="page-scroll" href="{{ route('sekolah') }}">Sekolah</a></li>
                                    <li class="nav-item"><a class="page-scroll" href="{{ route('ibadah') }}">Tempat Ibadah</a></li>
                                    <li class="nav-item"><a class="page-scroll" href="{{ route('wisata') }}">Tempat Wisata</a></li>
                                    <li class="nav-item"><a class="page-scroll" style="color: DeepSkyBlue" href="{{ route('Login Form') }}">Sign In</a></li>
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

    {{-- CROPPER
    <div class="modal fade" id="modalSekolah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sekolah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalContent">
                <div class="form-group ml-3 mr-3">
                    <label for="">Nama Sekolah</label>
                    <input type="text" class="form-control" name="nama_sekolah" id="nama_sekolah" disabled>
                </div>
                <div class="form-group ml-3 mr-3">
                    <label for="">Jenis Sekolah</label>
                    <input type="text" class="form-control" name="nama_sekolah" id="jenis_sekolah" disabled>
                </div>
                <div class="form-group ml-3 mr-3">
                    <label for="">Desa</label>
                    <input type="text" class="form-control" name="nama_sekolah" id="desa_sekolah" disabled>
                </div>
                <div class="form-group ml-3 mr-3">
                    <label for="">Alamat</label>
                    <input type="text" class="form-control" name="nama_sekolah" id="alamat_sekolah" disabled>
                </div>
                <div class="form-group ml-3 mr-3">
                    <label for="">Telepon</label>
                    <input type="text" class="form-control" name="nama_sekolah" id="telepon_sekolah" disabled>
                </div>
                <div class="row" style="margin: 20px">
                    <img  src="{{asset('assets/img/placeholder_wisata.png')}}" id="image-preview"  width="100%" height="100%" alt="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="modal-close" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
            </div>
            </div>
        </div>
    </div> --}}

    <!-- Modal Sekolah -->
  <div class="modal fade left" id="modalSekolah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
      <div class="modal-dialog modal-notify modal-info modal-side modal-top-left" role="document">
      <!--Content-->
          <div class="modal-content">
              <!--Header-->
              <div class="modal-header">
                  <p class="heading lead" style="color: black;">Sekolah</p>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true" class="white-text">&times;</span>
                  </button>
              </div>
              <!--Body-->
              <div class="modal-body" id="loadingSekolah">
                <div class="d-flex justify-content-center">
                  <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
                </div>
              </div>
              <!--Body-->
              <div class="modal-body" id="bodySekolah">
                  <p class="h5 mb-4 text-center" style="color:black; bold"><b id="nama_sekolah"></b></p>
                  <img id="image-preview" alt=""
                      class="img-fluid">
                  <div class="text-left mt-3 ml-1">
                      <p id="jenis_sekolah"></p>
                      <p id="desa_sekolah"></p>
                      <p id="alamat_sekolah"></p>
                      <p id="telepon_sekolah"></p>
                  </div>
              </div>
              <!--Footer-->
              <div class="modal-footer justify-content-center">
                  <a type="button" class="btn btn-outline-info waves-effect" data-dismiss="modal">Tutup</a>
              </div>
          </div>
      <!--/.Content-->
      </div>
  </div>
  <!-- Modal Sekolah-->

  <!-- Modal Desa -->
  <div class="modal fade left" id="modalDesa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
      <div class="modal-dialog modal-notify modal-info modal-side modal-top-left" role="document">
      <!--Content-->
          <div class="modal-content">
              <!--Header-->
              <div class="modal-header">
                  <p class="heading lead" style="color: black;">Informasi Desa</p>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true" class="white-text">&times;</span>
                  </button>
              </div>
              <!--Body-->
              <div class="modal-body" id="loadingDesa">
                <div class="d-flex justify-content-center">
                  <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
                </div>
              </div>
              <!--Body-->
              <!--Body-->
              <div class="modal-body" id="bodyDesa">
                  <p class="h5 mb-4 text-center" style="color:black; bold"><b id="nama_desa"></b></p>
                  <div class="text-left mt-3 ml-1">
                      <p id="jumlah_sekolah"></p>
                      <p id="jumlah_ibadah"></p>
                      <p id="jumlah_wisata"></p>
                  </div>
              </div>
              <!--Footer-->
              <div class="modal-footer justify-content-center">
                  <a type="button" class="btn btn-outline-info waves-effect" data-dismiss="modal">Tutup</a>
              </div>
          </div>
      <!--/.Content-->
      </div>
  </div>
  <!-- Modal Desa-->

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
  <script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>
  <script>
      var mymap = L.map('mapid').setView([-8.375319619905975, 115.18006704436591], 10);
      L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery ?? <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoiZmlyZXJleDk3OSIsImEiOiJja2dobG1wanowNTl0MzNwY3Fld2hpZnJoIn0.YRQqomJr_RmnW3q57oNykw'
        }).addTo(mymap);
                //MENYAMBUNGKAN KOORDINAT DESA
                function makePolygon(data){
            var c = [];
            for(i in data) {
                var x = data[i]['lat'];
                var y = data[i]['lng'];
                c.push([x, y]);
            }
            return c;
        }

        function getDetailDesa(id){
          $("#bodyDesa").hide();
          $("#loadingDesa").show();
          $("#modalDesa").modal('show');
          $.ajax({
              url: "getDetailDesa/"+id,
              method: 'get',
              success: function(result){
                  console.log(result);
                  $("#jumlah_sekolah").text("Jumlah Sekolah : " + result.jumlah_sekolah);
                  $("#jumlah_ibadah").text("Jumlah Tempat Ibadah : " + result.jumlah_ibadah);
                  $("#jumlah_wisata").text("Jumlah Tempat Wisata : " + result.jumlah_wisata);
                  $("#nama_desa").text(result.desa['nama_desa']);
                  $("#loadingDesa").hide();
                  $("#bodyDesa").show();     
              }
          });
        }

        var desas = {!! json_encode($desas->toArray()) !!}
        desas.forEach(element => {
          var koor = jQuery.parseJSON(element['batas_desa']);
            var id = jQuery.parseJSON(element['id']);
            var pathCoords = makePolygon(koor);
            var pathLine = L.polygon(pathCoords, {
                id: element['id'],
                color: element['warna_batas'],
                fillColor: element['warna_batas'],
                fillOpacity: 0.4,
                nama: element['nama_desa'],
            }).addTo(mymap);

            pathLine.on('click', function(e) {
                getDetailDesa(e.target.options.id);
            } );
          
        });

        //icon init
        var schoolIcon = L.icon({
            iconUrl: '/assets/img/icon_sekolah.png',

            iconSize:     [32, 32], 
            iconAnchor:   [16, 32], 
            popupAnchor:  [0, -16] 
        });

        function getDetailSekolah(id){
          $("#bodySekolah").hide();
          $("#loadingSekolah").show();
          $("#modalSekolah").modal('show');
          $.ajax({
              url: "getDetailSekolah/"+id,
              method: 'get',
              success: function(result){
                  $("#nama_sekolah").text(result.sekolah['nama_sekolah']);
                  $("#jenis_sekolah").text("Jenis Sekolah : " + result.sekolah['jenis']);
                  $("#desa_sekolah").text("Desa : " + result.sekolah.desa['nama_desa']);
                  $("#alamat_sekolah").text("Alamat : " + result.sekolah['alamat']);
                  $("#telepon_sekolah").text("Telepon : " + result.sekolah['telepon']);
                  $('#image-preview').attr('src', result.sekolah['foto']);
                  $("#loadingSekolah").hide();
                  $("#bodySekolah").show();   
              }
          });
      }

        //MARKER CLUSTER INIT
        var sekolahMarkers = L.markerClusterGroup({
            maxClusterRadius: 60,
            iconCreateFunction: function(cluster){
                return new L.DivIcon({ 
                    html: '<div><span>' + cluster.getChildCount() + '</span></div>', 
                    className: 'marker-cluster marker-cluster-sekolah', iconSize: new L.Point(40, 40) 
                });
            }
        });
        mymap.addLayer(sekolahMarkers);

        //Marker Loads
        var sekolahs = {!! json_encode($sekolahs->toArray()) !!}
        sekolahs.forEach(element => {
          var marker = L.marker([element.lat, element.lng],{icon: schoolIcon, id: element.id});
          sekolahMarkers.addLayer(marker);
            marker.on('click',function(e){
                mymap.setView([e.latlng.lat, e.latlng.lng], 15);
                getDetailSekolah(e.target.options.id);
            });
        });
    </script>
</body>

</html>
