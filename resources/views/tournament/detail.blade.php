@extends('layouts.layout')
@extends('layouts.navbar')
@extends('layouts.sidebar')
@extends('modal.modal')

@section('title','Tournament 16 | {{$tournament->title}}')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{$tournament->title}}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">{{$tournament->title}}</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container">
      <div class="card card-solid">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-5">
              <h3 class="d-inline-block d-sm-none">{{$tournament->title}}</h3>
              <div class="col-12">
                <img src="{{ url('/') }}/admin/dist/img/prod-1.jpg" class="product-image" alt="Product Image">
              </div>
            </div>
            <div class="col-12 col-sm-7">
              <h3 class="my-3">{{$tournament->title}}</h3>
              <span class="float-right mb-3"><small>Published : @created_at($tournament->created_at)</small></span>
              
              <hr>
              <div class="btn-group btn-group-toggle col-lg-12" data-toggle="buttons">
                <label class="btn btn-default text-center mr-2">
                  Price Pool <hr>
                  <h5 class="text-bold">Rp. @money($tournament->pricePool)</h5>
                </label>
                <label class="btn btn-default text-center mr-2">
                  Date Event <hr>
                  <h5 class="text-bold">@date($tournament->dateInitial) <br> - <br> @date($tournament->dateFinal)</h5>
                </label>
                <label class="btn btn-default text-center mr-2" style="width: 100px">
                  Slot <hr>
                  <h5> {{$tournament->team->count()}} / {{$tournament->slot}} </h5>
                  <div>
                    @php
                    $persen = ($tournament->team->count()/$tournament->slot) * 100;
                    $left = $tournament->slot - $tournament->team->count();
                    @endphp
                    <div id="progress" class="progress-bar bg-lime" role="progressbar" aria-volumenow="{{$tournament->team->count()}}" aria-volumemin="0" aria-volumemax="{{$tournament->slot}}"></div>Left : {{$left}}
                    <?php 
                    echo '<script language="javascript">
                      document.getElementById("progress").innerHTML="<div style=\"width:'.$persen.'%;background-color:#28a745;\"> </div>";
                      </script>';
                      ?>    
                  </div>
                </label>
                <label class="btn btn-default text-center mr-2">
                  Athletes <hr>
                  <h5 class="text-bold">{{$tournament->athlete}}</h5>
                </label>
              </div>
  
              <div class="row">
                <div class="col-md-7">
                  <div class="bg-primary py-2 px-3 mt-4">
                    <h3 class="mb-0">
                      <i class="fas fa-money-bill-wave fa-lg"></i> 
                      Rp. @money($tournament->fee)
                    </h3>
                  </div>
                </div>
                @can('isMember', Model::class)
                <div class="col-md-5">
                  <div class="mt-4">
                    @if($check == 0)
                      <div class="btn btn-warning btn-lg" data-toggle="modal" data-target="#modal-register-team">
                        <i class="fas fa-money-check fa-lg mr-2"></i> 
                        Register Now
                      </div>
                    @else
                      <div class="bg-success btn-lg">
                        <i class="fas fa-hands-helping fa-lg mr-2"></i> 
                        Thank You 
                      </div>
                    @endif
                  </div>
                </div>
                @endcan
              </div>
  
              <div class="mt-4 product-share">
                <a href="#" class="text-gray">
                  <i class="fab fa-facebook-square fa-2x"></i>
                </a>
                <a href="#" class="text-gray">
                  <i class="fab fa-twitter-square fa-2x"></i>
                </a>
                <a href="#" class="text-gray">
                  <i class="fas fa-envelope-square fa-2x"></i>
                </a>
                <a href="#" class="text-gray">
                  <i class="fas fa-rss-square fa-2x"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="row mt-4">
            <nav class="w-100">
              <div class="nav nav-tabs" id="product-tab" role="tablist">
                <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
                <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">Comments</a>
                <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">Rating</a>
              </div>
            </nav>
            <div class="tab-content p-3" id="nav-tabContent">
              <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> {!!$tournament->description!!} </div>
              <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"> Limit Registration : {{$tournament->dateRegisLimit}} <br> Date Event : {{$tournament->dateInitial}} to {{$tournament->dateFinal}} <br> Contact info : {{$tournament->user->promotor->company}}
                <div>
                  <i class="fab fa-facebook-square fa-2x"></i> {!!$tournament->user->promotor->facebook!!} {{$tournament->user->promotor->facebook}}<br>
                  <a href="{{$tournament->user->promotor->wa}}" class="text-gray"><i class="fab fa-whatsapp-square fa-2x"></i> {{$tournament->user->promotor->wa}} </a><br>
                  <a href="{{$tournament->user->promotor->instagram}}" class="text-gray"><i class="fab fa-instagram fa-2x"></i> {{$tournament->user->promotor->instagram}} </a>
                </div>
              </div>
              <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab"> Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper. Donec varius massa at semper posuere. Integer finibus orci vitae vehicula placerat. </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Default box -->
  </section>
</div>
{{-- Modal Register Team --}}
<div class="modal fade" id="modal-register-team">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Register Your Team</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('/team') }}" method="post">
        @csrf
          <div class="modal-body">
              <div class="col-md-12">
                  <div class="form-group">
                      <label>Toutnament Title</label>
                      <input type="text" class="form-control" value="{{$tournament->title}}" placeholder="Enter ..." disabled>
                      <input id="tournament_id" name="tournament_id" type="text" value="{{$tournament->id}}" hidden>
                  </div>
              </div>
              <div class="col-md-12">
                  <div class="form-group">
                      <label>Team's Name</label>
                      <input id="name" name="name" type="text" class="form-control" placeholder="Enter ...">
                  </div>
              </div>
          </div>
          <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
      </form>
    </div>
  </div>
</div>
{{-- Modal Register Team --}}
@endsection
@section('script')

@endsection