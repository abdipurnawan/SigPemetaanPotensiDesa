@extends('layouts.admin')
@section('title', 'Detail Tempat Ibadah')
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
    <h1 class="h3 mb-2 text-gray-800">Detail Tempat Ibadah</h1>
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
                    <h6 class="m-0 font-weight-bold text-primary">Data Tempat Ibadah</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin-ibadah-store') }}" id="form-desa" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama Tempat Ibadah</label>
                            <input type="text" class="form-control" name="nama_tempat_ibadah" value="{{$ibadah->nama_tempat_ibadah}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Desa</label>
                            <input type="text" class="form-control" name="nama_tempat_ibadah" value="{{$ibadah->desa->nama_desa}}" readonly>
                        </div>
                        <div class="form-group form-group mt-3">
                            <label for="kategori">Agama</label>
                            <select class="form-control" data-live-search="true" id="agama" rows="3" name="agama" required disabled>
                              <option value="">Pilih Agama</option>
                              <option value="Islam" @if($ibadah->agama=='Islam') selected @endif>Islam</option>
                              <option value="Hindu" @if($ibadah->agama=='Hindu') selected @endif>Hindu</option>
                              <option value="Katolik" @if($ibadah->agama=='Katolik') selected @endif>Katolik</option>
                              <option value="Kristen" @if($ibadah->agama=='Kristen') selected @endif>Kristen</option>
                              <option value="Buddha" @if($ibadah->agama=='Buddha') selected @endif>Buddha</option>
                              <option value="Konghuchu" @if($ibadah->agama=='Konghuchu') selected @endif>Konghuchu</option>
                            </select>  
                        </div>
                        <div class="form-group">
                            <label for="">Latitude</label>
                            <input type="text" class="form-control" name="lat" id="lat" value="{{$ibadah->lat}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Longitude</label>
                            <input type="text" class="form-control" name="lng" id="lng" value="{{$ibadah->lng}}" readonly>
                        </div> 
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <input type="text" class="form-control" name="alamat" value="{{$ibadah->alamat}}" readonly>
                        </div>
                        <div class="form-group mt-4 mb-4">
                            <label for="thumbnail">Foto Tempat Ibadah</label>
                            <br>
                            <img src="{{$ibadah->foto}}" style="border: 2px solid #DCDCDC;padding: 5px;height:100%;width:100%;" id="propic">
                        </div>                        
                        <a style="margin-right:7px" href="/admin/ibadah"><button type="button" class="btn btn-secondary float-right mr-2"><i class="fas fa-window-plus"></i>Kembali</button></a>
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
        var ibadahIcon = L.icon({
            iconUrl: '/assets/img/icon_ibadah.png',

            iconSize:     [32, 32], 
            iconAnchor:   [16, 32], 
            popupAnchor:  [0, -16] 
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
        var myDesa = {!! json_encode($ibadah->desa) !!}
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

        //READ Marker Tempat Ibadah
        var ibadah = {!! json_encode($ibadah) !!}
        mymap.setView([ibadah.lat, ibadah.lng], 13);
        var marker = L.marker([ibadah.lat, ibadah.lng],{icon: ibadahIcon}).addTo(mymap)
        .bindPopup(ibadah.nama_tempat_ibadah);
        marker.on('click', function() {
            marker.openPopup();
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
            $('#ibadah').addClass('active');
            $('#potensi').addClass('active');
        });
    </script>
@endpush