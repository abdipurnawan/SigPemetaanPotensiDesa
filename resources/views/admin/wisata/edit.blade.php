@extends('layouts.admin')
@section('title', 'Edit Tempat Wisata')
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
    <h1 class="h3 mb-2 text-gray-800">Edit Tempat Wisata</h1>
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
                    <form action="{{ route('admin-wisata-update', $wisata->id) }}" id="form-desa" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        <div class="form-group">
                            <label for="">Nama Tempat Wisata</label>
                            <input type="text" class="form-control @error('nama_tempat_wisata') is-invalid @enderror" name="nama_tempat_wisata" placeholder="Masukkan nama tempat wisata" value="{{$wisata->nama_tempat}}" required>
                            @error('nama_tempat_wisata')
                                <div class="invalid-feedback text-start">
                                    {{ $message }}
                                </div>
                            @else
                                <div class="invalid-feedback">
                                    Nama tempat wisata wajib diisi
                                </div>
                            @enderror
                        </div>
                        <div class="form-group form-group mt-3">
                            <label for="kategori">Desa</label>
                            <select class="form-control @error('desaa') is-invalid @enderror" data-live-search="true" id="desaa" rows="3" name="desa" required>
                              <option value="">Pilih desa</option>
                                @foreach ($desas as $desa)
                                    <option value="{{$desa->id}}" @if($desa->id == $wisata->id_desa) selected @endif>{{$desa->nama_desa}}</option>
                                @endforeach
                            </select>
                            @error('desaa')
                                <div class="invalid-feedback text-start">
                                    {{ $message }}
                                </div>
                            @else
                                <div class="invalid-feedback">
                                    Desa wajib dipilih
                                </div>
                            @enderror  
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
                            <input type="text" class="form-control" name="lat" id="lat" readonly value="{{$wisata->lat}}">
                        </div>
                        <div class="form-group">
                            <label for="">Longitude</label>
                            <input type="text" class="form-control" name="lng" id="lng" readonly value="{{$wisata->lng}}">
                        </div> 
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" placeholder="Masukkan alamat tempat wisata" value="{{$wisata->alamat}}" required>
                            @error('alamat')
                                <div class="invalid-feedback text-start">
                                    {{ $message }}
                                </div>
                            @else
                                <div class="invalid-feedback">
                                    Alamat tempat wisata wajib diisi
                                </div>
                            @enderror
                        </div>       
                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <textarea type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="5" placeholder="Masukkan deskripsi tempat wisata" required>{{$wisata->deskripsi}}</textarea>
                            @error('deskrispi')
                                <div class="invalid-feedback text-start">
                                    {{ $message }}
                                </div>
                            @else
                                <div class="invalid-feedback">
                                    Deskripsi tempat wisata wajib diisi
                                </div>
                            @enderror
                        </div>  
                        <div class="form-group mt-4 mb-4">
                            <label for="thumbnail">Foto Tempat Wisata</label>
                            <br>
                            <input type="text" class="form-control" name="foto" id="foto" placeholder="url" hidden>
                            <img src="{{$wisata->foto}}" style="border: 2px solid #DCDCDC;padding: 5px;height:100%;width:100%;" id="propic">
                            @error('foto')
                                <div class="invalid-feedback text-start">
                                    {{ $message }}
                                </div>
                            @else
                                <div class="invalid-feedback">
                                    Foto tempat wisata wajib diisi
                                </div>
                            @enderror
                            <div class="custom-file">
                                <button type="button" class="btn btn-primary mt-1" data-target="#crop-image" data-toggle="modal"><i class="fa fa-images"></i> Pilih Foto</button>
                            </div>
                        </div>                 
                        <span><button type="submit" class="btn btn-primary float-right"><i class="fas fa-window-plus"></i>Update Tempat Wisata</button></span>
                        <a style="margin-right:7px" href="/admin/wisata"><button type="button" class="btn btn-secondary float-right mr-2"><i class="fas fa-window-plus"></i>Kembali</button></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- CROPPER --}}
    <div class="modal fade" id="crop-image" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pilih Foto Tempat Wisata</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" style="margin: 20px">
                    <img  src="{{$wisata->foto}}" id="image-preview"  width="100%" height="100%" alt="">
                    <div class="custom-file" style="margin-top: 20px">
                        <input type="file" class="custom-file-input" id="profile-image" name="thumbnail" accept="images/*" required>
                        <label for="thumbnail_label" id="thumbnail_labell" class="custom-file-label">Pilih Foto</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="modal-close" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                <button type="button" id="update-foto-profile" class="btn btn-primary" data-dismiss="modal">Pilih</button>
            </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <script src="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.min.js"></script>
    <script>
        //GLOBAL VAR
        var status = 0;
        let pathLine;

        //icon init
        var wisataIcon = L.icon({
            iconUrl: '/assets/img/icon_wisata.png',

            iconSize:     [32, 32], 
            iconAnchor:   [16, 32], 
            popupAnchor:  [0, -16] 
        });

        //MAP INIT
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

        //ADD CONTROLL
        mymap.pm.addControls({  
            position: 'topleft',
            drawCircle: false,
            drawMarker: false,
            drawCircleMarker:false,
            drawRectangle: false,
            drawPolyline: false,
            drawPolygon: false,
            dragMode:false,
            editMode: false,
            cutPolygon: false,
            removalMode: false,
            rotateMode: false,
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
    
        //TRIGGERED KETIKA DESA BERUBAH
        $('#desaa').on('change', function(){
            readDesa();
            readMarker();

            if($('#desaa').val()==''){
                mymap.pm.addControls({
                    editMode: false,
                    drawMarker: false,
                    removalMode: false,
                });
            }else if($('#desaa').val()!=''){
                mymap.pm.addControls({
                    editMode: true,
                    drawMarker: true,
                    removalMode: false,
                });
            }
        });

        function readDesa(){
            //READ KOORDINAT DESA
            var myDesa = {!! json_encode($desas->toArray()) !!}
                console.log(myDesa);
                myDesa.forEach(element => {
                    if($('#desaa').val() == element['id']){
                        for(; Object.keys(mymap._layers).length > 1;) {
                            console.log(mymap._layers)
                            mymap.removeLayer(mymap._layers[Object.keys(mymap._layers)[1]]);
                        }
                        var koor = jQuery.parseJSON(element['batas_desa']);
                        var id = jQuery.parseJSON(element['id']);
                        var pathCoords = makePolygon(koor);
                        pathLine = L.polygon(pathCoords, {
                            id: element['id'],
                            color: element['warna_batas'],
                            fillColor: element['warna_batas'],
                            fillOpacity: 0.4,
                            nama: element['nama_desa'],
                        }).addTo(mymap);
                    }

            });            
        }

        function readMarker(){
            //READ Marker Wisata
            var wisata = {!! json_encode($wisata) !!}
            var marker = L.marker([wisata.lat, wisata.lng],{icon: wisataIcon}).addTo(mymap)
            .bindPopup(wisata.nama_tempat);
            marker.on('click', function() {
                marker.openPopup();
            });
            mymap.pm.addControls({
                editMode: false,
                drawMarker: false,
                removalMode: true,
            });

            marker.on('pm:update', ({layer}) => {
                console.log(layer._latlng);
                $('#lat').val(layer._latlng.lat);
                $('#lng').val(layer._latlng.lng);
            });

            marker.on('pm:remove', ({layer}) => {
                $('#lat').val('');
                $('#lng').val('');
                mymap.pm.addControls({
                    editMode: false,
                    drawMarker: true,
                    removalMode: false,
                });
            });

            marker.pm.enable({  
                allowSelfIntersection: false,  
            });  
        }

        readDesa();
        readMarker();

        //SET MARKER BUTTON
        $('#set-koordinat').on('click', function(){
            if(status == 0 && $('#desaa').val()!=''){
                mymap.pm.enableDraw('Marker', {
                    snappable: true,
                    snapDistance: 20,
                    markerStyle: {
                        draggable: true,
                        icon: wisataIcon,
                    },
                });
            }

        });

        //HANDLER PM CREATE
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

                status = 1;

                mymap.pm.addControls({
                    editMode: true,
                    drawMarker: false,
                    removalMode: true,
                });

                e.marker.on('pm:update', ({layer}) => {
                    console.log(layer._latlng);
                    $('#lat').val(layer._latlng.lat);
                    $('#lng').val(layer._latlng.lng);
                });

                e.marker.on('pm:remove', ({layer}) => {
                    $('#lat').val('');
                    $('#lng').val('');
                    mymap.pm.addControls({
                        editMode: false,
                        drawMarker: true,
                        removalMode: false,
                    });
                    status = 0;
                });
            }
        });

        $(document).ready(function(){
            $('#wisata').addClass('active');
            $('#potensi').addClass('active');
        });

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


        //CROPPER JS
        //CROPPER
        function changeProfile(){
            $('#profile-image').trigger('click');
        }

        var cropper;
        var image = document.getElementById('image-preview');

        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept-Encoding' : 'gzip',
                }
            });
            $('#profile-image').on('change', function(){
                var filedata = this.files[0];
                var imgtype = filedata.type;
                var match = ['image/jpg', 'image/jpeg', 'image/png'];
                if (!(filedata.type==match[0]||filedata.type==match[1]||filedata.type==match[2])) {
                    alert("Format gambar Salah");
                }else{
                    var reader=new FileReader();
                    reader.onload=function(ev){
                        $('#image-preview').attr('src', ev.target.result);
                        cropper.destroy();
                        cropper = null;
                        cropper = new Cropper(image, {
                            aspectRatio: 16 / 9,
                            viewMode: 1,
                            preview: '.preview'
                        });
                    }
                    reader.readAsDataURL(this.files[0]);
                    var postData=new FormData();
                    postData.append('file', this.files[0]);
                }
            });
            $('#crop-image').on('shown.bs.modal', function(){
                cropper = new Cropper(image, {
                    aspectRatio: 16 / 9,
                    viewMode: 3,
                    preview: '.preview'
                });
            }).on('hidden.bs.modal', function(){
                cropper.destroy();
                cropper = null;
            });

            $('#update-foto-profile').on('click', function(){
                canvas = cropper.getCroppedCanvas({
                    width: 1080,
                    height: 1920,
                });
                canvas.toBlob(function(blob){
                    url = URL.createObjectURL(blob);
                    var reader = new FileReader();
                    reader.readAsDataURL(blob);
                    
                    reader.onloadend = function() {
                        $('#propic').attr('src', reader.result);
                        var base64data = reader.result;
                        $('#foto').val(reader.result);
                        
                    }
                });
            });
        });
    </script>
@endpush