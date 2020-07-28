<div class="form-group">
    <label class="col-form-label" for="inputSuccess"><i class="fas fa-check"></i> Input with
      success</label>
    <input type="text" class="form-control is-valid" id="inputSuccess" placeholder="Enter ...">
  </div>
  <div class="form-group">
    <label class="col-form-label" for="inputWarning"><i class="far fa-bell"></i> Input with
      warning</label>
    <input type="text" class="form-control is-warning" id="inputWarning" placeholder="Enter ...">
  </div>
  <div class="form-group">
    <label class="col-form-label" for="inputError"><i class="far fa-times-circle"></i> Input with
      error</label>
    <input type="text" class="form-control is-invalid" id="inputError" placeholder="Enter ...">
  </div>

  <script type="text/javascript">
    $(document).ready(function() {
        $('select[name="state"]').on('change', function() {
            var stateID = $(this).val();
                                    

            if(stateID) {
                $.ajax({
                    url: '/myform/ajax/'+stateID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        // debugger;
// document.getElementById("demo").innerHTML = x;

                        $('select[name="city"]').empty();
                        $.each([data], function(value, value) {
                            $('select[name="city"]').append('<option value="'+ value +'->id">'+ value +'</option>');
                        });


                    }
                });
            }else{
                $('select[name="city"]').empty();
            }
        });
    });
</script>
<table id="example2" class="table table-bordered table-striped  table-responsive">
  <thead>
  <tr>
    <th>Tournament Title</th>
    <th>Team Name</th>
    <th>Paid</th>
    <th>Fighters</th>
    <th>CSS grade</th>
  </tr>
  </thead>
  <tbody>
  <tr>
    <td>Tournament Tournament Tournament Tournament Tournament Tournament</td>
    <td>Team Name</td>
    <td><center> <span class="badge badge-danger">Unpaid</span></center>
    </td>
    <td>
      <div class="progress progress-sm bg-secondary">
        <div class="progress-bar bg-green" role="progressbar" aria-volumenow="7" aria-volumemin="0" aria-volumemax="8" style="width: 87%">
        </div>
      </div>
      <center><small>
      7/8
      </small></center>
    </td>
    <td>
      <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-detail-team"><i class="fas fa-eye"></i></a>
      <a href="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-fighter"><i class="fas fa-plus"></i></a>
      <a href="" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
      <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete-team"><i class="fas fa-trash"></i></a>
    </td>
  </tr>
  <tr>
    <td>Tournament Tournament Tournament Tournament Tournament Tournament</td>
    <td>Team Name</td>
    <td><center> <span class="badge badge-success px-3">Paid</span></center>
    </td>
    <td>
      <div class="progress progress-sm bg-secondary">
        <div class="progress-bar bg-green" role="progressbar" aria-volumenow="7" aria-volumemin="0" aria-volumemax="8" style="width: 87%">
        </div>
      </div>
      <center><small>
      7/8
      </small></center>
    </td>
    <td>
      <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-detail-team"><i class="fas fa-eye"></i></a>
      <a href="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-fighter"><i class="fas fa-plus"></i></a>
      <a href="" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
      <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete-team"><i class="fas fa-trash"></i></a>
    </td>
  </tr>
  <tr>
    <td>Tournament Tournament Tournament Tournament Tournament Tournament</td>
    <td>Team Name</td>
    <td><center> <span class="badge badge-primary">Process</span></center>
    </td>
    <td>
      <div class="progress progress-sm bg-secondary">
        <div class="progress-bar bg-green" role="progressbar" aria-volumenow="7" aria-volumemin="0" aria-volumemax="8" style="width: 87%">
        </div>
      </div>
      <center><small>
      7/8
      </small></center>
    </td>
    <td>
      <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-detail-team"><i class="fas fa-eye"></i></a>
      <a href="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-fighter"><i class="fas fa-plus"></i></a>
      <a href="" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
      <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete-team"><i class="fas fa-trash"></i></a>
    </td>
  </tr>
  <tr>
    <td>Tournament Tournament Tournament Tournament Tournament Tournament</td>
    <td>Team Name</td>
    <td><center> <span class="badge badge-secondary px-2">Cancel</span></center>
    </td>
    <td>
      <div class="progress progress-sm bg-secondary">
        <div class="progress-bar bg-green" role="progressbar" aria-volumenow="7" aria-volumemin="0" aria-volumemax="8" style="width: 87%">
        </div>
      </div>
      <center><small>
      7/8
      </small></center>
    </td>
    <td>
      <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-detail-team"><i class="fas fa-eye"></i></a>
      <a href="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-fighter"><i class="fas fa-plus"></i></a>
      <a href="" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
      <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete-team"><i class="fas fa-trash"></i></a>
    </td>
  </tr>
  </tbody>
  <tfoot>
  <tr>
    <th>Tournament Title</th>
    <th>Team Name</th>
    <th>Paid</th>
    <th>Fighters</th>
    <th>CSS grade</th>
  </tr>
  </tfoot>
</table>

Ada berapa aktor? Siapa Aja? (Admin, CEO, Marketing .etc)

Apa yang bisa dilakukan tiap-tiap aktor? (CRUD)
-Admin
-bisa menghapus member.
-bisa membuat daftar member
-bisa mengedit member
