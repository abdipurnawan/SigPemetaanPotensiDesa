@extends('layouts.admin')
@section('title', 'Tambah Tempat Wisata')
@push('css')
    <style>
        #mapid { height: 600px; }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.css" />
@endpush
@section('content')
    <h1 class="h3 mb-2 text-gray-800">Tambah Tempat Wisata</h1>
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
                    <h6 class="m-0 font-weight-bold text-primary">Data Tempat Wisata</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin-wisata-store') }}" id="form-desa" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama Tempat Wisata</label>
                            <input type="text" class="form-control" name="nama_tempat_wisata" placeholder="Masukkan nama tempat wisata">
                        </div>
                        <div class="form-group form-group mt-3">
                            <label for="kategori">Desa</label>
                            <select class="form-control" data-live-search="true" id="desa" rows="3" name="desa" required>
                              <option value="">Pilih Desa</option>
                                @foreach ($desa as $desa)
                                    <option value="{{$desa->id}}">{{$desa->nama_desa}}</option>
                                @endforeach
                            </select>  
                        </div>
                        <div class="form-group">
                            <label for="">Lokasi Tempat Wisata</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <input type="text" readonly class="form-control" id="marker-sekolah" placeholder="Masukkan Lokasi Tempat Wisata">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <a href="javascript:void(0)" id="set-koordinat"><i class="fas fa-map-marker-alt"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Latitude</label>
                            <input type="text" class="form-control" name="lat" id="lat" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Longitude</label>
                            <input type="text" class="form-control" name="lng" id="lng" readonly>
                        </div> 
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <input type="text" class="form-control" name="alamat" placeholder="Masukkan alamat tempat wisata">
                        </div>       
                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <textarea type="text" class="form-control" name="deskripsi" rows="5" placeholder="Masukkan deskripsi tempat wisata"></textarea>
                        </div>                   
                        <span><button type="submit" class="btn btn-primary float-right"><i class="fas fa-window-plus"></i>Tambah Tempat Wisata</button></span>
                        <a style="margin-right:7px" href="/admin/wisata"><button type="button" class="btn btn-secondary float-right mr-2"><i class="fas fa-window-plus"></i>Kembali</button></a>
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

        mymap.pm.addControls({  
            position: 'topleft',
            drawCircle: false,
            drawMarker: true,
            drawCircleMarker:false,
            drawRectangle: false,
            drawPolyline: false,
            drawPolygon: false,
            dragMode:false,
            editMode: false,
            cutPolygon: false,
        });

        $('#set-koordinat').on('click', function(){
            mymap.pm.enableDraw('Marker', {
                snappable: true,
                snapDistance: 20,
            });
            
        });

        mymap.on('pm:remove', e=> {
            var id = e.layer.options.id;
            $('#lat').val("");
            $('#lng').val("");
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
            
        });
    </script>
@endpush