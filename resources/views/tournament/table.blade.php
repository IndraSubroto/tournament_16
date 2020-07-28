@extends('layouts.layout')
@extends('layouts.navbar')
@extends('layouts.sidebar')
@extends('modal.modal')

@section('title','Tournament 16 | My Tournament')

@section('link')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ url('/') }}/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- Toastr --> 
  <link rel="stylesheet" href="{{ url('/') }}/admin/plugins/toastr/toastr.min.css">
@endsection

@section('content')
<div class="content-wrapper">
  
  <section class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>List Tournaments</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item active">List Tournaments</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Table Tournaments</h3>
            </div>
            <div class="card-body table-responsive">
              <table id="tableTournaments" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Title</th>
                  <th>Price Pool</th>
                  <th>Day Event</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($tournaments as $tournament)
                  <tr id="row{{$tournament->id}}">
                    <td style="width: 40px;">{{$loop->iteration}}</td>
                    <td>{{$tournament->title}}</td>
                    <td style="width: 130px;">@money($tournament->pricePool) <br><div class="callout callout-danger p-0 pl-1 mt-2 mb-0">Fee : @money($tournament->fee)</div></td>
                    <td style="width: 140px;">Regis: @date($tournament->dateRegisLimit) <br> Start : @date($tournament->dateInitial)<br>Final : @date($tournament->dateFinal)</td>
                    <td style="width: 90px;">
                      <a href="{{ url('/tournament/detail',[$tournament->id]) }}" class="btn btn-success btn-sm m-1"><i class="fas fa-eye"></i> Detail</a>
                      <a href="{{ url('tournament/edit',[$tournament->id]) }}" class="btn btn-info btn-sm m-1"><i class="fas fa-pencil-alt"></i> Edit</a>
                      <button type="submit" id="delete-tournament" class="btn btn-danger btn-sm m-1" data-id="{{$tournament->id}}"><i class="fas fa-trash"></i> Delete</button>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Price Pool</th>
                    <th>Day Event</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection

@section('script')
<!-- Toastr -->
<script src="{{ url('/') }}/admin/plugins/toastr/toastr.min.js"></script>
<!-- DataTables -->
<script src="{{ url('/') }}/admin/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{ url('/') }}/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- page script -->
<script>
  $('#tableTournaments').DataTable({
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": true,
  });

  $(document).on('click', '#delete-tournament', function(){     
    var id = $(this).data('id');
    var $button = $(this);
    var table = $('#tableTournaments').DataTable();
    $.ajax({  
      url:'/tournament/'+id,  
      type:'GET',
      dataType:'json',
      success:function()  
      {
        toastr.success('Delete has Successfull');
        table.row( $button.parents('tr') ).remove().draw();
      }  
    });  
  });
</script>
@endsection
