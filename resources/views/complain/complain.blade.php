@extends('layouts.layout')
@extends('layouts.navbar')
@extends('layouts.sidebar')

@section('content')
<div class="content-wrapper">
  
    <section class="content-header">
      <div class="container-fluid">
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
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Complain BOX</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Company</label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label>Company</label>
                    <textarea class="form-control" name="" id="" cols="30" rows="5"></textarea>
                </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection