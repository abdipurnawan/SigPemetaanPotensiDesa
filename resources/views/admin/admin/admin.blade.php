@extends('layouts.admin')
@section('title', 'Admin')
@push('css')
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <style>
        /* The switch - the box around the slider */
        .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
        }

        /* Hide default HTML checkbox */
        .switch input {
        opacity: 0;
        width: 0;
        height: 0;
        }

        /* The slider */
        .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
        }

        .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
        }

        input:checked + .slider {
        background-color: #2196F3;
        }

        input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
        border-radius: 34px;
        }

        .slider.round:before {
        border-radius: 50%;
        }
    </style>
@endpush
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Daftar Admin</h1>
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
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Admin</h6>
        </div>
        <div class="card-body">
            <span><a href="#" data-toggle="modal" data-target="#addAdmin" class="btn btn-primary mb-4"><i class="fas fa-plus"></i> Tambah Admin</a></span>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="35">No</th>
                            <th>Nama Admin</th>
                            <th>Username</th>
                            <th width="100">Role</th>
                            <th width="50">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th width="35">No</th>
                            <th>Nama Admin</th>
                            <th>Username</th>
                            <th width="100">Role</th>
                            <th width="50">Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($admin as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->username}}</td>
                                <td>
                                    <label class="switch">
                                        <input id="signup-token_{{$item->id}}" name="_token" type="hidden" value="{{csrf_token()}}">
                                       @if($item->role == 1)
                                         <input type="checkbox" id="status_{{$item->id}}" onclick="statusBtn({{$item->id}})" checked>
                                       @else
                                         <input type="checkbox" id="status_{{$item->id}}" onclick="statusBtn({{$item->id}})">
                                       @endif
                                         <span class="slider round"></span>
                                       </label>
                                </td>
                                <td><a class="btn btn-danger btn-sm text-center" onclick="deleteAdmin({{$item->id}})" href="#"><i class="fas fa-trash"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add News Category Modal-->
    <div class="modal fade" id="addAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategory">Tambah Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Masukkan Data Admin</p>
                <form method="post" action="/admin/admins/store" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                    <label for="kategori_ina">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama">
                    </div>
                    <div class="form-group">
                    <label for="kategori_eng">Username</label>
                    <input type="text" class="form-control" id="username" name="username">
                    </div>
                    <div class="form-group">
                        <label for="kategori_eng">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="kategori_eng">Ulangi Password</label>
                        <input type="password" class="form-control" id="repeat_password" name="repeat_password">
                    </div>
                    <div class="form-group form-group mt-3">
                        <label for="kategori">Role</label>
                        <select class="form-control" data-live-search="true" id="role" rows="3" name="role" required>
                          <option value="">Pilih Role</option>
                          <option value="1">Super Admin</option>
                          <option value="0">Admin</option>
                        </select>  
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>              
            </div>

            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>
    <script>
        $(document).ready(function(){
            
        });

        //Soft Delete Admin
        function deleteAdmin(id){
        swal({
            title: 'Anda yakin ingin menghapus admin ini?',
            icon: 'warning',
            buttons: ["Tidak", "Ya"],
        }).then(function(value) {
            if (value) {
            jQuery.ajax({  
            url: 'admins/'+id+'/delete',
            type: "GET",
                success: function(result){
                location.reload();
                }
            });
            }
        });
        }

        function statusBtn(id) {
        var checkBox = document.getElementById("status_"+id);
        // If the checkbox is checked, display the output text
        if (checkBox.checked == true){
        swal({
            title: 'Anda yakin ingin menjadikan admin sebagai super admin?',
            icon: 'warning',
            buttons: ["Tidak", "Ya"],
        }).then(function(value) {
            if (value) {
                jQuery.ajax({  
                url: "/admin/admins/role/"+id+"/1",
                type: "GET",
                success: function(result){
                }
            });
            }else{
            document.getElementById("status_"+id).checked = false;
            }
        });
        } else {
        swal({
            title: 'Anda yakin ingin menjadikan superadmin sebagai admin?',
            icon: 'warning',
            buttons: ["Tidak", "Ya"],
        }).then(function(value) {
            if (value) {
                jQuery.ajax({
                url: "/admin/admins/role/"+id+"/0",
                type: "GET",
                success: function(result){
                }
            });
            }else{  
            document.getElementById("status_"+id).checked = true;
            }
        });
        }
    }
    </script>
@endpush