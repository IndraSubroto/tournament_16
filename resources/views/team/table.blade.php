@extends('layouts.layout')
@extends('layouts.navbar')
@extends('layouts.sidebar')
{{-- @extends('modal.modal') --}}

@section('link')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ url('/') }}/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- Toastr --> 
  <link rel="stylesheet" href="{{ url('/') }}/admin/plugins/toastr/toastr.min.css">
@endsection

@section('title','Tournament 16 | My Register')

@section('content')
<div class="content-wrapper">

  <section class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>List Teams</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item active">List Teams</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-7 col-12">  
          <div id="infoTeam" class="card">
            <div class="card-header">
              <h3 class="card-title m-1">Data Table Teams</h3>
            </div>
            <div class="card-body">
              <table id="teamTable" class="table table-bordered table-striped table-responsive">
                <thead>
                  <tr>
                    <th style="width: 20px;">No</th>
                    <th>Tournament Title</th>
                    <th>Team Name</th>
                    <th style="width: 50px;">Paid</th>
                    <th style="max-width: 220px;">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($teams as $team)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$team->tournament->title}}</td>
                    <td>{{$team->name}}</td>
                    <td class="text-center">
                      @if ($team->payment == null)
                        <button id="paymentSubmit{{$team->id}}" class="paymentButton badge badge-warning" data-team="{{$team->id}}" >Pay Now</button>
                      @else
                        @if ($team->payment->status == 'pending')
                          <button class="badge badge-info" onclick="snap.pay('{{ $team->payment->snap_token }}')">Complete <br> Payment</button>
                        @elseif ($team->payment->status == 'success')
                          <span class="badge badge-success px-3">Paid</span>
                        @elseif ($team->payment->status == 'deny')
                          <span class="badge badge-danger px-3">Deny</span>
                        @elseif ($team->payment->status == 'expired')
                          <span class="badge badge-secondary">Expire</span>
                        @elseif ($team->payment->status == 'failed')
                          <span class="badge badge-dark px-2">Cancel</span>
                        @endif
                      @endif
                    </td>
                    <td name="action">
                      <a href="{{ url('/tournament/detail',[$team->tournament->id]) }}" class="btn btn-success btn-sm m-1"><i class="fas fa-eye"></i> Detail</a>
                      <button type="button" id="detailAthlete{{$team->id}}" class="detailAthlete btn bg-lime btn-sm mt-1" data-id-team="{{$team->id}}" data-id-user="{{$team->user->id}}" data-id-tournament="{{$team->tournament->id}}" data-team="{{$team->name}}" data-tournament="{{$team->tournament->title}}" data-count="{{$team->athlete->count()}}" data-athlete="{{$team->tournament->athlete}}" data-toggle="tooltip" title="Athlete"><i class="fas fa-users"></i> Athlete</button>
                      <button type="button"  class="btn btn-primary btn-sm mt-1 disabled"><i class="fas fa-fighter-jet"></i> Complain</button>
                      <button type="button"  class="btn btn-primary btn-sm mt-1 disabled"><i class="fas fa-user-shield"></i> </button>
                      <button type="button"  class="delete-team btn btn-danger btn-sm mt-1" data-id="{{$team->id}}"><i class="fas fa-trash"></i> Delete</button>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Tournament Title</th>
                    <th>Team Name</th>
                    <th>Paid</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
  
        <div class="col-md-5 col-12">
          <div id="infoAthlete" class="card">
            <div class="card-header">
              <h3 class="card-title m-1">Data Table  Athletes</h3>
              <div class="float-right">
                @can('isMember', Model::class)
                <button id="add-athlete" class="btn disabled btn-danger btn-sm"><i class="fas fa-user-plus"></i></button>
                @endcan
              </div>
            </div>
            <div class="card-body">
              <div id="infoAthlete" class="row">
                <div class="col-md-5">
                  <div class="card card-primary">
                    <div class="card-header p-3">
                      <h6 class="card-title tournament">Tournament</h6>
                    </div>
                    <div class="card-body infoTour">
                      <div>Chose Team</div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card card-primary">
                    <div class="card-header p-3">
                      <h6 class="card-title team">Team</h6>
                    </div>
                    <div class="card-body infoTeam">
                      <div>Chose Team</div>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="card card-primary">
                    <div class="card-header p-3">
                      <h6 class="card-title">Athlete</h6>
                    </div>
                    <div class="card-body infoAthl">
                      <div>Chose Team</div>
                    </div>
                  </div>
                </div>
              </div>
              <table id="athleteTable" class="table table-bordered table-striped table-responsive">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
{{-- Modal Add Athlete--}}
<div class="modal fade" id="modal-athlete" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" id="close" class="btn btn-danger btn-lg" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add_name" name="add_name" class="form-athlete">
          @csrf
          <table id="dynamic_field">
            <tr>
              <td><label>Action</label></td>
              <td><label>First Name</label></td>
              <td><label>Last Name</label></td>
            </tr>
            <tr id="dynamic_field">
              <td>
                <button type="button" name="add" class="add-field btn btn-success">Add More</button>
              </td>
              <td id="dynamic_field">
                <input id="count" hidden/>
                <input type="text" name="team_id" id="team" value="" class="form-control name_list"  hidden/>
                <input type="text" name="user_id" id="user" value="" class="form-control name_list"  hidden/>
                <input type="text" name="tournament_id" id="tournament" value="" class="form-control name_list"  hidden/>
                <input id="first" type="text" name="first[]" class="form-control" placeholder="Enter your Name"  required autofocus>
              </td>
              <td id="dynamic_field">
                <input type="text" name="last[]" class="form-control" required placeholder="Enter your Name">
              </td>
            </tr>
          </table>
        </form>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" id="close" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="athlete">Save changes</button>
      </div>
    </div>
  </div>
</div>
{{-- Modal Add Athlete--}}
@endsection

@section('script')
<!-- Toastr -->
<script src="{{ url('/') }}/admin/plugins/toastr/toastr.min.js"></script>
{{-- <script src="{{ url('/') }}/admin/plugins/sweetalert2/sweetalert2.min.js"></script> --}}
<!-- DataTables -->
<script src="{{ url('/') }}/admin/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{ url('/') }}/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- page script -->

<script src="{{ !config('services.midtrans.isProduction') ? 'https://app.sandbox.midtrans.com/snap/snap.js' : 'https://app.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
<script src="{{ url('/')}}/js/team.js"></script>
<script>
  $(document).on('click','.paymentButton',function(){
    var id = $(this).data('team');
    $.ajax({
      url:'/getDataPayment/'+id,
      method:'GET',
      dataType:'JSON',
      success:function(data) {
        var user = data.user_id,
        team = data.team_id,
        tournament = data.tournament_id,
        user_name = data.user_name,
        user_email = data.user_email,
        amount = data.amount,
        payment_type = data.payment_type;
        $.post("{{ route('payment.store') }}",
        {
          _method: 'POST',
          _token: '{{ csrf_token() }}',
          user_id: user,
          team_id: team,
          tournament_id: tournament,
          user_name: user_name,
          user_email: user_email,
          amount: amount,
          payment_type: payment_type,
        },
        function (data, status) {
          snap.pay(data.snap_token, {
            // Optional
            onSuccess: function (result) {
            location.reload();
            },
            // Optional
            onPending: function (result) {
            location.reload();
            },
            // Optional
            onError: function (result) {
            location.reload();
            }
          });
        }); return false;
      }
    });
  });
</script>
@endsection
