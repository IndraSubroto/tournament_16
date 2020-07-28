
  var columAthl = [
    {
      data: 'DT_RowIndex',
      width: '10%',
      name: 'DT_RowIndex'
    },
    {
      data: 'first',
      width: '33%',
      name: 'first'
    },
    {
      data: 'last',
      width: '33%',
      name: 'last'
    },
    {
      data: 'action',
      width: '24%',
      name: 'action',
      orderable: false
    }
  ];
  var i=1;
  var URLAthleteStore = 'athlete';
  var URLAthleteTable = 'listTeams/athlete/';

  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
  });

  // Showing Modal Add Athlete
  $(document).on('click', '.add-athlete', function() {
    $('.modal-title').text('Add Athletes');
    $('.form-athlete').show();
    $('#count').val($(this).data('c'));
    $('#team').val($(this).data('team'));
    $('#user').val($(this).data('user'));
    $('#tournament').val($(this).data('tournament'));
    $('#modal-athlete').modal('show');
  });

  $(document).on('click', '.delete-team', function(){     
    var id = $(this).data('id');
    var $button = $(this);
    var table = $('#teamTable').DataTable();
    $.ajax({  
      url:'/team/'+id,  
      type:'GET',
      dataType:'html',
      success:function()  
      {
        $('#add-athlete').replaceWith('<button id="add-athlete" class="btn disabled btn-fsnrt btn-sm"><i class="fas fa-user-plus"></i></button>');
        $('div.infoTour').find('div').replaceWith('<div>Chose Team</div>');
        $('div.infoTeam').find('div').replaceWith('<div>Chose Team</div>');
        $('div.infoAthl').find('div').replaceWith('<div>Chose Team</div>');
        $('#athleteTable').DataTable().clear();
        $('#athleteTable').DataTable().destroy();
        toastr.success('Delete has Successfull');
        table.row( $button.parents('tr') ).remove().draw();
      }  
    });  
  });
    
  $(document).on('click', '.delete-athlete', function(){     
    var id = $(this).data('id');
    var $button = $(this);
    var table = $('#athleteTable').DataTable();
    $.ajax({
      url:'/athlete/'+id,  
      type:'GET',
      dataType:'json',
      success:function(data)
      {
        var sisa = data.athleteTotal - data.count,
          persen = (data.count/data.athleteTotal) *100;
        if(sisa == 0)
          {
            $('#add-athlete').replaceWith('<button id="add-athlete" class="btn disabled btn-danger btn-sm"><i class="fas fa-user-plus"></i></button>');
          }else{
            $('#add-athlete').replaceWith('<button id="add-athlete" class="add-athlete btn btn-warning btn-sm mt-1" data-team="'+data.team_id+'" data-user="'+data.user_id+'" data-tournament="'+data.tournament_id+'" data-c="'+sisa+'"><i class="fas fa-user-plus"></i></button>');
          }
        $('div.infoAthl').replaceWith('<div class="card-body infoAthl text-center"><div>'+data.count+' / '+data.athleteTotal+' <div class="progress"><div class="progress-bar bg-success" role="progressbar" aria-valuenow="'+data.count+'" aria-valuemin="0" aria-valuemax="'+data.athleteTotal+'" style="width: '+persen+'%"></div></div></div></div>');
        $('#detailAthlete'+data.team_id).replaceWith('<button type="button" id="detailAthlete'+data.team_id+'" class="detailAthlete btn bg-lime btn-sm mt-1" data-id-team="'+data.team_id+'" data-id-user="{{$team->user->id}}" data-id-tournament="'+data.tournament_id+'" data-team="'+data.teamName+'" data-tournament="'+data.title+'" data-count="'+data.count+'" data-athlete="'+data.athleteTotal+'" data-toggle="tooltip" title="Athlete"><i class="fas fa-users"></i> Athlete</button>');
        table.row( $button.parents('tr') ).remove().draw();
        toastr.success('Delete has Successfull');
      }
    });  
  });

  $('#teamTable').DataTable({
    paging: true,
    lengthChange: true,
    searching: true,
    ordering: false,
    info: true,
    autoWidth: true,
  });

  $(document).on('click','.detailAthlete', function(){
    var user_id = $(this).data('id-user'),
    tournament_id = $(this).data('id-tournament'),
    team_id = $(this).data('id-team'),
    tournament = $(this).data('tournament'),
    team = $(this).data('team'),
    count = $(this).data('count'),
    athlete = $(this).data('athlete'),
    persen = (count/athlete) * 100,
    sisa = athlete - count;
    $('#athleteTable').DataTable().destroy();
    $('div.infoTour').replaceWith('<div class="card-body infoTour"><div>'+tournament+'</div></div>');
    $('div.infoTeam').replaceWith('<div class="card-body infoTeam"><div>'+team+'</div></div>');
    $('div.infoAthl').replaceWith('<div class="card-body text-center infoAthl"><div>'+count+' / '+athlete+' <div class="progress"><div class="progress-bar bg-success" role="progressbar" aria-valuenow="'+count+'" aria-valuemin="0" aria-valuemax="'+athlete+'" style="width: '+persen+'%"></div></div> </div></div>');
    if (count == athlete) {
      $('#add-athlete').replaceWith('<button id="add-athlete" class="btn disabled btn-danger btn-sm"><i class="fas fa-user-plus"></i></button>');
    } else {
      $('#add-athlete').replaceWith('<button id="add-athlete" class="add-athlete btn btn-warning btn-sm" data-team="'+team_id+'" data-user="'+user_id+'" data-tournament="'+tournament_id+'" data-c="'+sisa+'"><i class="fas fa-user-plus"></i></button>');
    }
    $('#athleteTable').DataTable({
      serverSide: true, info:false,
      ajax: {
        url: URLAthleteTable+team_id,
      },
      columns: columAthl,
    });
  });

$(document).ready(function(){
  //Add Input field
  $('.add-field').click(function(){
    var c = $('input#count').val(),
      user = $('input#user').val(),
      team = $('input#team').val(),
      tournament = $('input#tournament').val();
    if(i < c){
      i++;
      $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><center><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></center> </td><td><input type="text" name="user_id" value="'+user+'" class="form-control name_list" hidden /><input type="text" name="team_id" value="'+team+'" class="form-control name_list" hidden /><input type="text" name="tournament_id" value="'+tournament+'" class="form-control name_list" hidden /><input type="text" name="first[]" placeholder="Enter your Name" class="form-control name_list" required /></td><td><input type="text" name="last[]" placeholder="Enter your Name" class="form-control name_list" required/></td></tr>');  
    }else{
      toastr.error('Your Limits Athlete is <strong>'+c+'</strong>');
    }
  });

  //delete form dynamic-added after close modal
  $(document).on('click', '#close', function() {
    $('td#dynamic_field').remove();
    $('tr.dynamic-added').remove();
    $('tr#dynamic_field').append('<td id="dynamic_field" id="dynamic_field"><input id="count" hidden/><input type="text" name="team_id" id="team" value="" class="form-control name_list"  hidden/><input type="text" name="user_id" id="user" value="" class="form-control name_list" hidden /><input type="text" name="tournament_id" id="tournament" value="" class="form-control name_list" hidden /><input id="first" type="text" name="first[]" placeholder="Enter your Name" class="form-control name_list" required /></td><td id="dynamic_field"><input type="text" name="last[]" placeholder="Enter your Name" class="form-control name_list" required/></td>');  
    i=1;
  });
  
  //delete form dynamic-added after click button X
  $(document).on('click', '.btn_remove', function(){
    i--;
    var button_id = $(this).attr("id");
    $('#row'+button_id+'').remove();
    var c = $('input#count').val();
  });

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  //Save Athlete
  $('#athlete').click(function(){ 
    var $button = $(this);
    $.ajax({  
      url:URLAthleteStore,  
      method:"POST",
      data:$('#add_name').serialize(),
      type:'json',
      success:function(data)  
      {
        if(data.error){
          printErrorMsg(data.error);
        }else{
          i=1;
          var sisa = data.athleteTotal - data.count,
          persen = (data.count/data.athleteTotal) *100;
          $('#athleteTable').DataTable().destroy();
          $('td#dynamic_field').remove();
          $('tr.dynamic-added').remove();
          $('tr#dynamic_field').append('<td id="dynamic_field" id="dynamic_field"><input id="count" hidden/><input type="text" name="team_id" id="team" value="" class="form-control name_list"  hidden/><input type="text" name="user_id" id="user" value="" class="form-control name_list" hidden /><input type="text" name="tournament_id" id="tournament" value="" class="form-control name_list" hidden /><input id="first" type="text" name="first[]" placeholder="Enter your Name" class="form-control name_list" required /></td><td id="dynamic_field"><input type="text" name="last[]" placeholder="Enter your Name" class="form-control name_list" required/></td>');  
          $('#modal-athlete').modal('hide');
          // toastr.success('Your Limits Athlete is');
          if(sisa == 0)
          {
            $('#add-athlete').replaceWith('<button id="add-athlete" class="btn disabled btn-danger btn-sm"><i class="fas fa-user-plus"></i></button>');
          }else{
            $('#add-athlete').replaceWith('<button id="add-athlete" class="add-athlete btn btn-warning btn-sm mt-1" data-team="'+data.team_id+'" data-user="'+data.user_id+'" data-tournament="'+data.tournament_id+'" data-c="'+sisa+'"><i class="fas fa-user-plus"></i></button>');
          }
          $('div.infoAthl').replaceWith('<div class="card-body text-center infoAthl"><div>'+data.count+' / '+data.athleteTotal+' <div class="progress"><div class="progress-bar bg-success" role="progressbar" aria-valuenow="'+data.count+'" aria-valuemin="0" aria-valuemax="'+data.athleteTotal+'" style="width: '+persen+'%"></div></div></div></div>');
          $('#detailAthlete'+data.team_id).replaceWith('<button type="button" id="detailAthlete'+data.team_id+'" class="detailAthlete btn bg-lime btn-sm mt-1" data-id-team="'+data.team_id+'" data-id-user="{{$team->user->id}}" data-id-tournament="'+data.tournament_id+'" data-team="'+data.teamName+'" data-tournament="'+data.title+'" data-count="'+data.count+'" data-athlete="'+data.athleteTotal+'" data-toggle="tooltip" title="Athlete"><i class="fas fa-users"></i> Athlete</button>');
          $('[data-toggle="tooltip"]').tooltip();
          $('#athleteTable').DataTable({serverSide: true, info:false,ajax: {url: URLAthleteTable+data.team_id,},columns: columAthl,});
        }
      }
    });  
  });

  function printErrorMsg (msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display','block');
    $(".print-success-msg").css('display','none');
    $.each( msg, function( key, value ) {
      $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
    });
  }
});  
