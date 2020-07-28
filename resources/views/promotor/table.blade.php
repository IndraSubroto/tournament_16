@extends('layouts.layout')
@extends('layouts.navbar')
@extends('layouts.sidebar')

@section('link')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ url('/') }}/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
@endsection

@section('content')
<div class="wrapper">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>List Promotors</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">List Promotors</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Table Promotors</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Name Company</th>
                  <th>Phone</th>
                  <th>Whatsapp</th>
                  <th>Facebook</th>
                  <th>Instagram</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($promotors as $promotor)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$promotor->company}}</td>
                    <td>{{$promotor->phone}}</td>
                    <td>{{$promotor->wa}}</td>
                    <td>{{$promotor->facebook}}</td>
                    <td>{{$promotor->instagram}}</td>
                    <td>{{$promotor->instagram}}</td>
                    <td>
                      {{-- <a href="" class="btn btn-success btn-sm m-1"><i class="fas fa-eye"></i></a> --}}
                      <a href="" class="btn btn-danger btn-sm m-1"><i class="fas fa-trash"></i></a>
                    </td>
                  </tr>    
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>Name Company</th>
                  <th>Phone</th>
                  <th>Whatsapp</th>
                  <th>Facebook</th>
                  <th>Instagram</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
@endsection

@section('script')
<!-- DataTables -->
<script src="{{ url('/') }}/admin/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{ url('/') }}/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
    });
  });
</script>
@endsection