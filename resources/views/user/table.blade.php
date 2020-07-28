@extends('layouts.layout')
@extends('layouts.navbar')
@extends('layouts.sidebar')

@section('link')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('/') }}/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>List Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item active">List Users</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Table Users</h3>
                    </div>
                    <div class="card-body">
                        <table id="tableUsers" class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr id="{{$user->role->name}}">
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->password}}</td>
                                    <td>
                                        <input type="checkbox" checked data-role="{{$user->role_id}}" data-id="{{$user->role->id}}" id="mycek" name="my-checkbox" data-bootstrap-switch data-off-color="primary" data-on-color="success" 
                                        onclick="clickF()"
                                        >
                                    </td>
                                    <td>
                                        <button href="" class="btn btn-danger btn-sm m-1"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Role</th>
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
@endsection

@section('script')
<!-- DataTables -->
<script src="{{ url('/') }}/admin/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{ url('/') }}/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- Bootstrap Switch -->
<script src="{{ url('/') }}/admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- page script -->
<script>
    $(function () {
        $('#tableUsers').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
        });
    });
    // $('input[data-bootstrap-switch]').each(function(){
        var role = $(this).data('role');
        if(role == '1'){
            $('input[data-role="1"]').remove();
        }
        if(role == '2'){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        }
        if(role == '3'){
            $(this).bootstrapSwitch('state', $(this).prop(''));
        }
    // });
function clickF(){
    var checkbox = document.getElementById('mycek');
    $(this).bootstrapSwitch('state', $(this).removeProp());
    if(checkbox.checked == true){
        var id = $('input#mycek').data('id'),
        URLRole = '/userRole/';
        $.ajax({
            _token: '{{ csrf_token() }}',
            url:URLRole+id,
            type:'PUT',
            dataType:'json',
            success:function(data)
            {
                if(data.role == '2'){
                    $(this).bootstrapSwitch('state', $(this).prop('checked'));
                }else if(data.role == '3'){
                    $(this).bootstrapSwitch('state', $(this).prop(''));
                }
            }
        })
    };
}

</script>
@endsection