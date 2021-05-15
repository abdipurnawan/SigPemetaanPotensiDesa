@extends('layouts.admin')
@section('title', 'Detail Desa')
@push('css')
    <style>
        #mapid { height: 600px; }
        .btn-float {
            position: fixed;
            bottom: -4px;
            right: 10px;
            margin-bottom: 40px;
            margin-right: 20px;
        }
        .btn-cricle {
            border-radius: 50%;
            color: #fff;
            display: inline-block;
            text-align: center;
            padding: 0.375rem;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.css" />
@endpush
@section('content')
    <h1 class="h3 mb-2 text-gray-800">Desa {{$desa->nama_desa}}</h1>
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
                    <h6 class="m-0 font-weight-bold text-primary">Peta Desa {{$desa->nama_desa}}</h6>
                </div>
                <div class="card-body">
                    <div id="mapid"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Data Desa</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin-desa-store') }}" id="form-desa" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama Desa</label>
                            <input type="text" class="form-control" name="nama_desa" value="{{$desa->nama_desa}}" readonly>
                        </div>
                        {{-- <div class="form-group">
                            <label for="">Koordinat Desa</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <input type="text" readonly class="form-control" id="marker-desa" placeholder="Koordinat Desa">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <a href="javascript:void(0)" id="set-koordinat"><i class="fas fa-map-marker-alt"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class="form-group">
                            <label for="">Zoom</label>
                            <input type="number" readonly class="form-control" name="zoom" value="" min="1" id="zoom">
                        </div> --}}
                        <div class="form-group">
                            <label for="">Warna Batas</label>
                            <input type="color" class="form-control" name="warna_batas" id="color-picker" value="{{$desa->warna_batas}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Batas Desa</label>
                            <textarea name="batas_desa" id="batas-desa" cols="30" rows="4" readonly class="form-control">{{$desa->batas_desa}}</textarea>
                        </div>
                        <span><button type="button" class="btn btn-secondary float-right mr-2"><i class="fas fa-window-plus"></i>Kembali</button></span>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="btn-float">
        <button class="btn rounded-pill btn-primary btn-lg"><i class="fas fa-plus"></i> Tambah</button>
    </div> --}}
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

        //READ KOORDINAT DESA
        var batas = {!! json_encode($desa) !!}
        var koor = jQuery.parseJSON(batas['batas_desa']);
        var pathCoords = makePolygon(koor);
        var pathLine = L.polygon(pathCoords, {
            color: batas['warna_batas'],
            fillColor: batas['warna_batas'],
            fillOpacity: 0.4,
        }).addTo(mymap);

        $(document).ready(function(){
            $('#desa').addClass('active');
        });
    </script>
@endpush