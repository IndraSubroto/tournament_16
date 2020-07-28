@extends('layouts.layout')
@extends('layouts.navbar')
@extends('layouts.sidebar')

@section('link')
    <!-- summernote -->
  <link rel="stylesheet" href="{{ url('/') }}/admin/plugins/summernote/summernote-bs4.css">
@endsection

@section('title','Tournament 16 | Create Tournament')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Tournament Form</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Tournament Form</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Tournament Form 2</h3>
            </div>
            <div class="card-body">
              <form role="form"  method="POST" action="{{ url('/tournament') }}">
                @method('POST')
                @csrf
                <div class="row">
                  <div class="col-md-5">
                    <label for="img">Preview Poster</label>    
                    <img id="image-preview" class="img-responsive img-fluid" src="{{ url('/') }}/robust/app-assets/images/carousel/06.jpg" style="height: 370px;" alt="image preview">
                    <div class="form-group mt-3">
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="image-source" onchange="previewImage();">
                          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-7">
                    <div class="form-group">
                      <label>Tournament's Title</label>
                      <input id="title" name="title" type="text" class="form-control" placeholder="Enter ..." required autofocus>
                    </div>
                    <div class="form-group">
                        <label>Company</label>
                        @can('isPromotor', Model::class)
                        <input type="text" value="{{$user->promotor->company}}" class="form-control" disabled>
                        @endcan
                    </div>
                    <div class="row">
                      @component('components.location')
                      {{-- Chain Dropdown Location --}}
                      @endcomponent
                    </div>
                    <div class="form-group">
                      <label>Description Rule</label>
                      <div class="card-body pad">
                        <div class="mb-3">
                          <textarea name="description" class="textarea" placeholder="Place some text here"
                                    style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                        </div>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row my-4">
                  <div class="col-md-4">
                    <div class="card card-primary">
                      <div class="card-header"></div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label>Slot</label>
                              <select id="slot" name="slot" class="custom-select">
                                <option value="">How many?</option>    
                                <option value="2"> 2</option>
                                <option value="4"> 4</option>
                                <option value="8"> 8</option>
                                <option value="16"> 16</option>
                                <option value="32"> 32</option>
                                <option value="64"> 64</option>
                                <option value="128"> 128</option>
                                <option value="256"> 256</option>
                                <option value="512"> 512</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label>Athlete</label>
                              <select id="athlete" name="athlete" class="custom-select">
                                <option value="">How many?</option>
                                @foreach ($ages as $age)
                                <option value="{{$age->id}}">{{$age->name}}</option>    
                                @endforeach
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="card card-primary">
                      <div class="card-header"></div>
                      <div class="card-body">
                        <div class="form-group">
                          <label for="limitRegis">Date Limit Registration</label>
                          <div class="input-group">
                            <input type="date" class="form-control" id="dateRegisLimit" name="dateRegisLimit">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="dateInitial">Date Start Event</label>
                          <div class="input-group">
                            <input type="date" class="form-control" id="dateInitial" name="dateInitial">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="dateFinal">Date Final Event</label>
                          <div class="input-group">
                            <input type="date" class="form-control" id="dateFinal" name="dateFinal">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="card card-primary">
                      <div class="card-header"></div>
                      <div class="card-body">
                        <div class="form-group">
                          <label>Registration Fee : <span id="fee-number-result">IDR 0.00</span></label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <select id="fee-number-symbol" class="select2-warning">
                                <option data-locale="european" value="IDR ">IDR</option>
                                <option value="$ ">$</option>
                                <option value="&pound; ">&pound;</option>
                                <option data-locale="european" value="&euro; ">&euro; </option>
                              </select>
                            </div>
                            <input type="text" class="form-control col-md-10" name="fee" id="fee-number-value" value="" placeholder="1,000,000">
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Price Pool : <span id="pricepool-number-result">IDR 0.00</span></label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <select id="pricepool-number-symbol" class="select2-warning">
                                <option data-locale="european" value="IDR ">IDR</option>
                                <option value="$ ">$</option>
                                <option value="&pound; ">&pound;</option>
                                <option data-locale="european" value="&euro; ">&euro; </option>
                              </select>
                            </div>
                            <input type="text" class="form-control col-md-10" name="pricepool" id="pricepool-number-value" placeholder="1,000,000">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <a href="{{ url('/home') }}" class="btn btn-warning">Cancel</a>
                  <button type="submit" class="btn btn-primary float-right">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection

@section('script')
<script src="{{ url('/') }}/js/location.js"></script>
<script src="{{ url('/') }}/ac/accounting.js"></script>

<!-- Summernote -->
<script src="{{ url('/') }}/admin/plugins/summernote/summernote-bs4.min.js"></script>
<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>

<script type="text/javascript">
jQuery(document).ready(function() {
  var $feeValue = $('#fee-number-value'),
  $feeSymbol = $('#fee-number-symbol'),
  $feeResult = $('#fee-number-result');

  $feeValue.add($feeSymbol).bind('keydown keyup keypress focus blur paste change', function() {
    var symbol = $feeSymbol.find(':selected').val(),
    result = accounting.formatMoney(
      $feeValue.val(),
      symbol,
      2,
      ($feeSymbol.find(':selected').data('locale') === 'european') ? "." : ",",
      ($feeSymbol.find(':selected').data('locale') === 'european') ? "," : "."
    );
    $feeResult.text(result);
  });

  var $priceValue = $('#pricepool-number-value'),
  $priceSymbol = $('#pricepool-number-symbol'),
  $priceResult = $('#pricepool-number-result');

  $priceValue.add($priceSymbol).bind('keydown keyup keypress focus blur paste change', function() {
    var symbol = $priceSymbol.find(':selected').val(),
    result = accounting.formatMoney(
      $priceValue.val(),
      symbol,
      2,
      ($priceSymbol.find(':selected').data('locale') === 'european') ? "." : ",",
      ($priceSymbol.find(':selected').data('locale') === 'european') ? "," : "."
    );
    $priceResult.text(result);
  });
});
</script>
<script>
function previewImage() {
  document.getElementById("image-preview").style.display = "block";
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("image-source").files[0]);
  oFReader.onload = function(oFREvent) {
    document.getElementById("image-preview").src = oFREvent.target.result;
  };
};
</script>

@endsection