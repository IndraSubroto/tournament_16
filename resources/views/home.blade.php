@extends('layouts.layout')
@extends('layouts.navbar')
@extends('layouts.sidebar')

@section('title', 'Tournament 16 | Home')

@section('content')
<div class="content-wrapper">
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Home</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"><a href="#">Home</a></li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container">

      {{-- Info Count --}}
      @auth
      <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">User</span>
              <span class="info-box-number">@money($user)</span>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Promotor</span>
              <span class="info-box-number">@money($promotor)</span>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-medal"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Tournaments</span>
              <span class="info-box-number">@money($count)</span>
            </div>
          </div>        
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-credit-card"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Success Payment</span>
              <span class="info-box-number">@money($payment)</span>
            </div>
          </div>
        </div>
      </div>
      @endauth
      {{-- Info Count --}}

      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-medal"></i> Tournaments</h3>
            </div>
            <div class="card-body">
              <div class="row">
                @if ($tournaments->count() == 0)
                <div class="col-12">
                  <center> Theres Nothing Data.</center>
                </div>
                @endif
                @foreach ($tournaments as $tournament)
                <div class="col-md-4">
                  <div class="card card-widget">
                    <div class="card-header bg-info">
                      <div class="user-block">
                        <img class="img-circle" src="{{ url('/') }}/admin/dist/img/user1-128x128.jpg" alt="User Image">
                        <span class="username">{{$tournament->title}}</span>
                        <span class="description text-white">Shared : @created_at($tournament->created_at)</span>
                      </div>
                    </div>              
                    <div class="card-body">
                      <img class="img-fluid pad mb-2" src="{{ url('/') }}/admin/dist/img/photo2.png" alt="Photo">
                      <span class="text-muted">127 likes - 3 comments</span>
                      <a href="{{ url('/tournament/detail') }}/{{$tournament->id}}" type="button" class="btn btn-info btn-sm float-right"><i class="fas fa-arrow-right"></i> More</a>
                    </div>                
                  </div>                
                </div>
                @endforeach
              </div>
              <div class="row
               justify-content-center">
                {{ $tournaments->render() }}
              </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
  
</div>
@endsection
@section('script')
<script>
$(function () {  
  /* -----------------------------------
  --- initialize the external events ---
  ------------------------------------*/
  function ini_events(ele) {
    ele.each(function () {
      // it doesn't need to have a start or end
      var eventObject = {
        title: $.trim($(this).text()) // use the element's text as the event title
      }
      
      // store the Event Object in the DOM element so we can get to it later
      $(this).data('eventObject', eventObject)

      // make the event draggable using jQuery UI
      $(this).draggable({
        zIndex        : 1070,
        revert        : true, // will cause the event to go back to its
        revertDuration: 0  //  original position after the drag
      })
    })
  }
  
  ini_events($('#external-events div.external-event'));
  /* ----------------------------------
  ---   initialize the calendar    ---
  -----------------------------------*/
  //Date for the calendar events (dummy data)
  var date = new Date();
  var d    = date.getDate(),
      m    = date.getMonth(),
      y    = date.getFullYear()
  
  var Calendar = FullCalendar.Calendar;
  var Draggable = FullCalendarInteraction.Draggable;

  var containerEl = document.getElementById('external-events');
  var checkbox = document.getElementById('drop-remove');
  var calendarEl = document.getElementById('calendar');
  
  /* -----------------------------------
  --- initialize the external events ---
  ------------------------------------*/
  
  new Draggable(containerEl, {
    itemSelector: '.external-event',
    eventData: function(eventEl) {
      console.log(eventEl);
      return {
        title: eventEl.innerText,
        backgroundColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
        borderColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
        textColor: window.getComputedStyle( eventEl ,null).getPropertyValue('color'),
      };
    }
  });
  
  var calendar = new Calendar(calendarEl, {
    plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid' ],
    header    : {
      left  : 'prev,next today',
      center: 'title',
      right : 'dayGridMonth,timeGridWeek,timeGridDay'
    },

    //Random default events
    events    : [
      {
        title          : 'Universitas Esa Unggul Futsal CUP',
        start          : new Date(y, m, 1),
        end            : new Date(y, m, 12),
        backgroundColor: '#0073b7', //Blue
        borderColor    : '#0073b7', //Blue
        allDay         : true
      },
    ],

    editable  : false,
    droppable : true, // this allows things to be dropped onto the calendar !!!
    drop : function(info) {
      // is the "remove after drop" checkbox checked?
      if (checkbox.checked) {
        // if so, remove the element from the "Draggable Events" list
        info.draggedEl.parentNode.removeChild(info.draggedEl);
      }
    }
  });
  
  calendar.render();
  // $('#calendar').fullCalendar()
  /* ADDING EVENTS */
  var currColor = '#3c8dbc'; //Red by default
  //Color chooser button
  var colorChooser = $('#color-chooser-btn');
  $('#color-chooser > li > a').click(function (e) {
    e.preventDefault();
    //Save color
    currColor = $(this).css('color');
    //Add color effect to button
    $('#add-new-event').css({
      'background-color': currColor,
      'border-color'    : currColor
    });
  });
  $('#add-new-event').click(function (e) {
    e.preventDefault();
    //Get value and make sure it is not null
    var val = $('#new-event').val();
    if (val.length == 0) {
      return
    }
  
    //Create events
    var event = $('<div />');
    event.css({
      'background-color': currColor,
      'border-color'    : currColor,
      'color'           : '#fff'
    }).addClass('external-event');
    event.html(val);
    $('#external-events').prepend(event);
  
    //Add draggable funtionality
    ini_events(event)
  
    //Remove event from text input
    $('#new-event').val('');
  });
});
</script>
@endsection