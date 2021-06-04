@extends('layouts.admin')
@section('title', 'Detail Sekolah')
@push('css')
    <style>
        #mapid { height: 750px; }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.css" />
@endpush
@section('content')
    <h1 class="h3 mb-2 text-gray-800">Detail Sekolah</h1>
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
    <div class="row">
        <div class="col-md-8 col-12">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Map</h6>
                </div>
                <div class="card-body">
                    <div id="mapid"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Data Sekolah</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin-sekolah-store') }}" id="form-desa" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama Sekolah</label>
                            <input type="text" class="form-control" name="nama_sekolah" value="{{$sekolah->nama_sekolah}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Desa</label>
                            <input type="text" class="form-control" name="nama_sekolah" value="{{$sekolah->desa->nama_desa}}" readonly>
                        </div>
                        <div class="form-group form-group mt-3">
                            <label for="kategori">Jenis Sekolah</label>
                            <select class="form-control" data-live-search="true" id="jenis" rows="3" name="jenis" disabled>
                              <option value="">Pilih Jenis Sekolah</option>
                              <option value="PAUD" @if($sekolah->jenis=="PAUD") selected @endif>PAUD</option>
                              <option value="TK" @if($sekolah->jenis=="TK") selected @endif>Taman Kanak-kanak</option>
                              <option value="SD" @if($sekolah->jenis=="SD") selected @endif>Sekolah Dasar</option>
                              <option value="SMP" @if($sekolah->jenis=="SMP") selected @endif>Sekolah Menengah Pertama</option>
                              <option value="SMA" @if($sekolah->jenis=="SMA") selected @endif>Sekolah Menengah Atas</option>
                              <option value="Universitas" @if($sekolah->jenis=="Universitas") selected @endif>Perguruan Tinggi</option>
                            </select>  
                        </div>
                        <div class="form-group">
                            <label for="">Latitude</label>
                            <input type="text" class="form-control" name="lat" id="lat" value="{{$sekolah->lat}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Longitude</label>
                            <input type="text" class="form-control" name="lng" id="lng" value="{{$sekolah->lng}}" readonly>
                        </div> 
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <input type="text" class="form-control" name="alamat" value="{{$sekolah->alamat}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Telepon</label>
                            <input type="text" class="form-control" name="telepon" value="{{$sekolah->telepon}}" readonly>
                        </div>
                        <div class="form-group mt-4 mb-4">
                            <label for="thumbnail">Foto Sekolah</label>
                            <br>
                            <img src="{{$sekolah->foto}}" style="border: 2px solid #DCDCDC;padding: 5px;height:100%;width:100%;" id="propic">
                        </div>                               
                        <a style="margin-right:7px" href="/admin/sekolah"><button type="button" class="btn btn-secondary float-right mr-2"><i class="fas fa-window-plus"></i>Kembali</button></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <script src="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.min.js"></script>
    <script>
        var mymap = L.map('mapid').setView([-8.375319619905975, 115.18006704436591], 9);
        L.Map.include({
            getMarkerById: function (id) {
                var marker = null;
                this.eachLayer(function (layer) {
                    if (layer instanceof L.Marker) {
                        if (layer.options.id === id) {
                            marker = layer;
                        }
                    }
                });
                return marker;
            }
        });

        //icon init
        var schoolIcon = L.icon({
            iconUrl: '/assets/img/icon_sekolah.png',

            iconSize:     [32, 32], 
            iconAnchor:   [16, 32], 
            popupAnchor:  [0, -16] 
        });

        $('#set-koordinat').on('click', function(){
            mymap.pm.enableDraw('Marker', {
                snappable: true,
                snapDistance: 20,
            });
            
        });

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
        
        //READ KOORDINAT DESA
        var myDesa = {!! json_encode($sekolah->desa) !!}
        var koor = jQuery.parseJSON(myDesa.batas_desa);
        var id = jQuery.parseJSON(myDesa.id);
        var pathCoords = makePolygon(koor);
        pathLine = L.polygon(pathCoords, {
            id: myDesa.id,
            color: myDesa.warna_batas,
            fillColor: myDesa.warna_batas,
            fillOpacity: 0.4,
            nama: myDesa.nama_desa,
        }).addTo(mymap);

        //READ Marker Sekolah
        var sekolah = {!! json_encode($sekolah) !!}
        mymap.setView([sekolah.lat, sekolah.lng], 13);
        var marker = L.marker([sekolah.lat, sekolah.lng],{icon: schoolIcon}).addTo(mymap)
        .bindPopup(sekolah.nama_sekolah);
        marker.on('click', function() {
            marker.openPopup();
        });

        mymap.on('pm:remove', e=> {
            var id = e.layer.options.id;
            $('#batas-desa').val("");
        });

        mymap.on('pm:create', e => {
        let shape = e.shape;
        console.log(e);
            if (shape == 'Marker') {
                let lat = e.marker._latlng.lat;
                let lng = e.marker._latlng.lng;
                $('#lat').val(lat);
                $('#lng').val(lng);
                mymap.pm.disableDraw('Marker', {
                    snappable: true,
                    snapDistance: 20,
                });
            }
        });

        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoiZmlyZXJleDk3OSIsImEiOiJja2dobG1wanowNTl0MzNwY3Fld2hpZnJoIn0.YRQqomJr_RmnW3q57oNykw'
        }).addTo(mymap);

        $(document).ready(function(){
            $('#sekolah').addClass('active');
            $('#potensi').addClass('active');
        });
    </script>
@endpush