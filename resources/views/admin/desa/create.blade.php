@extends('layouts.admin')
@section('title', 'Tambah Desa')
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
    <h1 class="h3 mb-2 text-gray-800">Tambah Desa</h1>
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
                    <h6 class="m-0 font-weight-bold text-primary">Data Desa</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin-desa-store') }}" id="form-desa" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        <div class="form-group">
                            <label for="">Nama Desa</label>
                            <input type="text" class="form-control @error('nama_desa') is-invalid @enderror" name="nama_desa" placeholder="Masukkan nama desa" required>
                            @error('nama_desa')
                                <div class="invalid-feedback text-start">
                                    {{ $message }}
                                </div>
                            @else
                                <div class="invalid-feedback">
                                    Nama desa wajib diisi
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Warna Batas</label>
                            <input type="color" class="form-control @error('warna_batas') is-invalid @enderror" name="warna_batas" id="color-picker" value="#000000" required>
                        </div>
                        <div class="form-group">
                            <label for="">Batas Desa</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <input type="text" readonly class="form-control" id="marker-desa" placeholder="Masukkan Batas Desa">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <a href="javascript:void(0)" id="set-koordinat"><i class="fas fa-map-marker-alt"></i></a>
                                    </div>
                                </div>
                            </div>
                            <textarea name="batas_desa" id="batas-desa" cols="30" rows="4" readonly class="form-control" required></textarea>
                        </div>
                        
                        <span><button type="submit" class="btn btn-primary float-right"><i class="fas fa-window-plus"></i>Tambah Desa</button></span>
                        <a style="margin-right:7px" href="/admin/desa"><button type="button" class="btn btn-secondary float-right mr-2"><i class="fas fa-window-plus"></i>Kembali</button></a>
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
        //GLOBAL VAR INIT
        let status = 0;

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
            drawMarker: false,
            drawCircleMarker:false,
            drawRectangle: false,
            drawPolyline: false,
            dragMode:false,
            cutPolygon: false,
            editMode: false,
            removalMode: false,
        });

        $('#set-koordinat').on('click', function(){
            if(status == 0){
                mymap.pm.enableDraw('Polygon', {
                    snappable: true,
                    snapDistance: 20,
                });
            }

        });

        $('#color-picker').on('change', function(){
            var color = $(this).val();
            mymap.pm.setPathOptions({
                color: color,
                fillColor: color,
                fillOpacity: 0.4,
            });
        });

        var line = [];

        mymap.on('pm:drawstart', ({ workingLayer }) => {
            line = [];
            workingLayer.on('pm:vertexadded', e => {
                var koordinat = {};
                koordinat['lat'] = e.latlng.lat;
                koordinat['lng'] = e.latlng.lng;
                line.push(
                    koordinat
                );
            });
        });

        mymap.on('pm:remove', e=> {
            $('#batas-desa').val("");
            mymap.pm.addControls({  
                position: 'topleft',
                drawPolygon: true,
                editMode: false,
                removalMode: false,
            });

            status = 0;
        });

        mymap.on('pm:create', e => {
            console.log(e);
            $('#batas-desa').val(JSON.stringify(line));
            e.layer.on('pm:update', e => {
                var id = e.layer.options.id;
                    var koordinats = e.layer._latlngs;
                    let koordinat = {};
                    line = [];
                    koordinats.forEach(function(latlng){
                        for(let m = 0; m<latlng.length; m++){
                            console.log(latlng[m]);
                            line.push(
                                latlng[m]
                            )
                        }
                    });
                $('#batas-desa').val(JSON.stringify(line));
            });
            mymap.pm.addControls({  
                position: 'topleft',
                drawPolygon: false,
                editMode: true,
                removalMode: true,
            });

            status = 1;
        });

        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoiZmlyZXJleDk3OSIsImEiOiJja2dobG1wanowNTl0MzNwY3Fld2hpZnJoIn0.YRQqomJr_RmnW3q57oNykw'
        }).addTo(mymap);

        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
        'use strict'
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')
        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()

        $(document).ready(function(){
            $('#desa').addClass('active');
            let color = $('#color-picker').val();
            mymap.pm.setPathOptions({
                color: color,
                fillColor: color,
                fillOpacity: 0.4,
            });
        });
    </script>
@endpush