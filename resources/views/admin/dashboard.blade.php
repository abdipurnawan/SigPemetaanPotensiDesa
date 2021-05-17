@extends('layouts.admin')
@section('title', 'Dashboard Admin')
@push('css')
    <style>
        #mapid { height: 950px; }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.css" />
@endpush
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
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

@endsection
@push('js')
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
                alert(e.target.options.nama);
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


        //Marker Loads
        var sekolahs = {!! json_encode($sekolahs->toArray()) !!}
        sekolahs.forEach(element => {
          console.log(element);
          var marker = L.marker([element.lat, element.lng],{icon: schoolIcon}).addTo(mymap)
          .bindPopup(element.nama_sekolah);
          marker.on('click', function() {
              marker.openPopup();
          });
        });

        var ibadahs = {!! json_encode($ibadahs->toArray()) !!}
        ibadahs.forEach(element => {
          console.log(element);
          var markerIbadah = L.marker([element.lat, element.lng],{icon: ibadahIcon}).addTo(mymap)
          .bindPopup(element.nama_tempat_ibadah);
          markerIbadah.on('click', function() {
            markerIbadah.openPopup();
          });
        });

        var wisatas = {!! json_encode($wisatas->toArray()) !!}
        wisatas.forEach(element => {
          console.log(element);
          var markerWisata = L.marker([element.lat, element.lng],{icon: wisataIcon}).addTo(mymap)
          .bindPopup(element.nama_tempat);
          markerWisata.on('click', function() {
            markerWisata.openPopup();
          });
        });

        $(document).ready(function(){
            $('#dashboard').addClass('active');
        });
  </script>
@endpush