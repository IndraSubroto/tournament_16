@section('modal')
<div class="modal fade" id="modal-detail-team">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detail Modal</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <div class="col-md-12">
            <div class="form-group">
              <label>Company</label>
              <input type="text" class="form-control" value="Shirayuki" placeholder="Enter ..." disabled>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Company</label>
              <input type="text" class="form-control" placeholder="Enter ...">
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
</div>

<div class="modal fade" id="modal-fighter">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Fighter Modal</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post" id="dynamic_field">
          <div class="modal-body">
            <table>
              <tr>
                <td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" /></td>  
                <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  
              </tr>
            </table>
              <div class="col-md-12">
                  <div class="form-group">
                      <label>Company</label>
                      <input type="text" class="form-control" value="Shirayuki" placeholder="Enter ..." disabled>
                  </div>
              </div>
              <div class="col-md-12">
                  <div class="form-group">
                      <label>Company</label>
                      <input type="text" class="form-control" placeholder="Enter ...">
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

<div class="modal fade" id="modal-delete-team">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Delete Modal</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post">
          <div class="modal-body">
              <div class="col-md-12">
                  <div class="form-group">
                      <label>Company</label>
                      <input type="text" class="form-control" value="Shirayuki" placeholder="Enter ..." disabled>
                  </div>
              </div>
              <div class="col-md-12">
                  <div class="form-group">
                      <label>Company</label>
                      <input type="text" class="form-control" placeholder="Enter ...">
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
@endsection