@extends('layouts.admin')
@section('title', 'Dashboard Admin')
@push('css')
    <style>
        #mapid { height: 600px; }
        .marker-cluster-wisata {
            background-color: rgba(218, 94, 94, 0.6);
            color: white;
        }
        .marker-cluster-wisata div {
            background-color: rgba(226, 36, 36, 0.6);
        }
        .marker-cluster-ibadah {
            background-color: rgba(241, 211, 87, 0.6);
            color: white;
        }
        .marker-cluster-ibadah div {
            background-color: rgba(240, 194, 12, 0.6);
        }

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
    <link href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css" rel="stylesheet" />
    <link href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css" rel="stylesheet" />
@endpush
@section('content')
<div class="container-fluid">

    @if (session()->has('statusInput'))
      <div class="row">
        <div class="col-sm-12 alert alert-success alert-dismissible fade show" role="alert">
            {{session()->get('statusInput')}}
            <button type="button" class="close" data-dismiss="alert"
                aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
      </div>
    @endif  
    @if (session()->has('error'))
    <div class="row">
      <div class="col-sm-12 alert alert-danger alert-dismissible fade show" role="alert">
          {{session()->get('error')}}
          <button type="button" class="close" data-dismiss="alert"
              aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
    </div>
  @endif
  @if (count($errors)>0)
    <div class="row">
        <div class="col-sm-12 alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
              @foreach ($errors->all() as $item)
                  <li>{{$item}}</li>
              @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert"
                aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
      </div>
    @endif  
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>

    <!-- Content Row -->
    <div class="row">
      <!-- Pending Requests Card Example -->
      <a class="col-xl-3 col-md-6 mb-4 text-decoration-none lift" href="/admin/desa">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Desa</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$jumlah_desa}}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-city fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </a>
      <!-- Earnings (Monthly) Card Example -->
      <a class="col-xl-3 col-md-6 mb-4 text-decoration-none" href="/admin/sekolah">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Sekolah</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$jumlah_sekolah}}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-school fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </a>

      <!-- Earnings (Monthly) Card Example -->
      <a class="col-xl-3 col-md-6 mb-4 text-decoration-none" href="/admin/ibadah">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Tempat Ibadah</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$jumlah_ibadah}}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-place-of-worship fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </a>

      <!-- Earnings (Monthly) Card Example -->
      <a class="col-xl-3 col-md-6 mb-4 text-decoration-none" href="/admin/wisata">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tempat Wisata</div>
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">
                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$jumlah_wisata}}</div>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-umbrella-beach fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>

    <!-- Content Row -->
    <div class="card shadow mb-4">
      <div class="card-header">
          <h6 class="m-0 font-weight-bold text-primary">Peta Potensi Desa</h6>
      </div>
      <div class="card-body">
          <div id="mapid"></div>
      </div>
  </div>

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

  <!-- Modal Ibadah -->
  <div class="modal fade left" id="modalIbadah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
      <div class="modal-dialog modal-notify modal-info modal-side modal-top-left" role="document">
      <!--Content-->
          <div class="modal-content">
              <!--Header-->
              <div class="modal-header">
                  <p class="heading lead" style="color: black;">Tempat Ibadah</p>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true" class="white-text">&times;</span>
                  </button>
              </div>
              <!--Body-->
              <div class="modal-body" id="loadingIbadah">
                <div class="d-flex justify-content-center">
                  <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
                </div>
              </div>
              <!--Body-->
              <!--Body-->
              <div class="modal-body" id="bodyIbadah">
                  <p class="h5 mb-4 text-center" style="color:black; bold"><b id="nama_tempat_ibadah"></b></p>
                  <img id="image-preview-ibadah" alt=""
                      class="img-fluid">
                  <div class="text-left mt-3 ml-1">
                      <p id="agama_tempat_ibadah"></p>
                      <p id="desa_tempat_ibadah"></p>
                      <p id="alamat_tempat_ibadah"></p>
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
  <!-- Modal Ibadah-->

  <!-- Modal Wisata -->
  <div class="modal fade left" id="modalWisata" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
      <div class="modal-dialog modal-notify modal-info modal-side modal-top-left" role="document">
      <!--Content-->
          <div class="modal-content">
              <!--Header-->
              <div class="modal-header">
                  <p class="heading lead" style="color: black;">Tempat Wisata</p>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true" class="white-text">&times;</span>
                  </button>
              </div>
              <!--Body-->
              <!--Body-->
              <div class="modal-body" id="loadingWisata">
                <div class="d-flex justify-content-center">
                  <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
                </div>
              </div>
              <!--Body-->
              <div class="modal-body" id="bodyWisata">
                  <p class="h5 mb-4 text-center" style="color:black; bold"><b id="nama_tempat_wisata"></b></p>
                  <img id="image-preview-wisata" alt=""
                      class="img-fluid">
                  <div class="text-left mt-3 ml-1">
                      <p id="desa_tempat_wisata"></p>
                      <p id="alamat_tempat_wisata"></p>
                      <p id="deskripsi_tempat_wisata"></p>
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
  <!-- Modal Wisata-->

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

@endsection
@push('js')
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
  <script src="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.min.js"></script>
  <script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>
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

      var ibadahIcon = L.icon({
          iconUrl: '/assets/img/icon_ibadah.png',

          iconSize:     [32, 32], 
          iconAnchor:   [16, 32], 
          popupAnchor:  [0, -16] 
      });

      var wisataIcon = L.icon({
          iconUrl: '/assets/img/icon_wisata.png',

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

      function getDetailIbadah(id){
          $("#bodyIbadah").hide();
          $("#loadingIbadah").show();
          $("#modalIbadah").modal('show');
          $.ajax({
              url: "getDetailIbadah/"+id,
              method: 'get',
              success: function(result){
                  console.log(result);
                  $("#nama_tempat_ibadah").text(result.ibadah['nama_tempat_ibadah']);
                  $("#agama_tempat_ibadah").text("Agama : " + result.ibadah['agama']);
                  $("#desa_tempat_ibadah").text("Desa : " + result.ibadah.desa['nama_desa']);
                  $("#alamat_tempat_ibadah").text("Alamat : " + result.ibadah['alamat']);
                  $('#image-preview-ibadah').attr('src', result.ibadah['foto']);
                  $("#loadingIbadah").hide();
                  $("#bodyIbadah").show();     
              }
          });
      }

      function getDetailWisata(id){
          $("#bodyWisata").hide();
          $("#loadingWisata").show();
          $("#modalWisata").modal('show');
          $.ajax({
              url: "getDetailWisata/"+id,
              method: 'get',
              success: function(result){
                  console.log(result);
                  $("#nama_tempat_wisata").text(result.wisata['nama_tempat']);
                  $("#desa_tempat_wisata").text("Desa : " + result.wisata.desa['nama_desa']);
                  $("#alamat_tempat_wisata").text("Alamat : " + result.wisata['alamat']);
                  $("#deskripsi_tempat_wisata").text(result.wisata['deskripsi']);
                  $('#image-preview-wisata').attr('src', result.wisata['foto']);
                  $("#loadingWisata").hide();
                  $("#bodyWisata").show();    
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

        var ibadahMarkers = L.markerClusterGroup({
            maxClusterRadius: 60,
            iconCreateFunction: function(cluster){
                return new L.DivIcon({ 
                    html: '<div><span>' + cluster.getChildCount() + '</span></div>', 
                    className: 'marker-cluster marker-cluster-ibadah', iconSize: new L.Point(40, 40) 
                });
            }
        });
        mymap.addLayer(ibadahMarkers);

        var wisataMarkers = L.markerClusterGroup({
            maxClusterRadius: 60,
            iconCreateFunction: function(cluster){
                return new L.DivIcon({ 
                    html: '<div><span>' + cluster.getChildCount() + '</span></div>', 
                    className: 'marker-cluster marker-cluster-wisata', iconSize: new L.Point(40, 40) 
                });
            }
        });
        mymap.addLayer(wisataMarkers);


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

      var ibadahs = {!! json_encode($ibadahs->toArray()) !!}
      ibadahs.forEach(element => {
        var markerIbadah = L.marker([element.lat, element.lng],{icon: ibadahIcon, id: element.id});
        markerIbadah.on('click', function(e) {
          mymap.setView([e.latlng.lat, e.latlng.lng], 15);
          getDetailIbadah(e.target.options.id);
        });
        ibadahMarkers.addLayer(markerIbadah);
      });

      var wisatas = {!! json_encode($wisatas->toArray()) !!}
      wisatas.forEach(element => {
        var markerWisata = L.marker([element.lat, element.lng],{icon: wisataIcon, id: element.id});
        markerWisata.on('click', function(e) {
          mymap.setView([e.latlng.lat, e.latlng.lng], 15);
          getDetailWisata(e.target.options.id);
        });
        wisataMarkers.addLayer(markerWisata);
      });

      $(document).ready(function(){
          $('#dashboard').addClass('active');
      });
  </script>
@endpush