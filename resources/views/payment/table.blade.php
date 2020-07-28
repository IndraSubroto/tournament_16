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
            <h1>List Payments</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">List Payments</li>
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
              <h3 class="card-title">Data Table Payments</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>
                  <th>Rendering engine</th>
                  <th>Browser</th>
                  <th>Platform(s)</th>
                  <th>Engine version</th>
                  <th>CSS grade</th>
                </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Trident</td>
                    <td><center> <span class="badge badge-danger">Unpaid</span></center>
                    </td>
                    <td>Win 95+</td>
                    <td> 4</td>
                    <td>
                      <a href="" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
                      <a href="" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
                      <a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td>Trident</td>
                    <td><center> <span class="badge badge-primary">Process</span></center>
                    </td>
                    <td>Win 95+</td>
                    <td> 4</td>
                    <td>
                      <a href="" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
                      <a href="" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
                      <a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td>Trident</td>
                    <td><center> <span class="badge badge-success px-3">Paid</span></center>
                    </td>
                    <td>Win 95+</td>
                    <td> 4</td>
                    <td>
                      <a href="" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
                      <a href="" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
                      <a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                    </td>
                  </tr>
                </tbody>
                <tfoot>
                <tr>
                  <th>Rendering engine</th>
                  <th>Browser</th>
                  <th>Platform(s)</th>
                  <th>Engine version</th>
                  <th>CSS grade</th>
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