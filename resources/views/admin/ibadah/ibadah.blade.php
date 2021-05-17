@extends('layouts.admin')
@section('title', 'Tempat Ibadah')
@push('css')
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Daftar Tempat Ibadah</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">Data Tempat Ibadah</h6>
        </div>
        <div class="card-body">
            <span><a href="{{ route('admin-ibadah-create') }}" class="btn btn-primary mb-4"><i class="fas fa-plus"></i> Tambah Tempat Ibadah</a></span>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="35">No</th>
                            <th>Nama Tempat</th>
                            <th>Agama</th>
                            <th>Lokasi Desa</th>
                            <th>Alamat</th>
                            <th width="150">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th width="35">No</th>
                            <th>Nama Tempat</th>
                            <th>Agama</th>
                            <th>Lokasi Desa</th>
                            <th>Alamat</th>
                            <th width="150">Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($ibadah as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_tempat_ibadah }}</td>
                                <td>{{ $item->agama}}</td>
                                <td>{{ $item->desa->nama_desa }}</td>
                                <td>{{ $item->alamat}}</td>
                                <td><a style="margin-right:7px" href="/admin/ibadah/{{$item->id}}/show"><button type="button" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></button></a><a style="margin-right:7px" class="btn btn-info btn-sm" href="/admin/ibadah/{{$item->id}}/edit" ><i class="fas fa-pencil-alt" ></i></a><a class="btn btn-danger btn-sm" onclick="deleteIbadah({{$item->id}})" href="#"><i class="fas fa-trash"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
            $('#ibadah').addClass('active');
            $('#potensi').addClass('active');
        });

        //Soft Delete Desa
        function deleteIbadah(id){
        swal({
            title: 'Anda yakin ingin menghapus tempat ibadah ini?',
            icon: 'warning',
            buttons: ["Tidak", "Ya"],
        }).then(function(value) {
            if (value) {
            jQuery.ajax({  
            url: 'ibadah/'+id+'/delete',
            type: "GET",
                success: function(result){
                location.reload();
                }
            });
            }
        });
        }
    </script>
@endpush