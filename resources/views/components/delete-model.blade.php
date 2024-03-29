
<div class="modal fade" id="{{$modelId}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="top: 25vh; width: 95%">
          <div class="d-flex justify-content-center mt-3">
            <h3 class="modal-title">Delete {{$header}}</h3>
          </div>
          <form method="post" action="{{ url($url) }}">
            @csrf
            <div class="modal-body">
              <div class="form-group d-flex justify-content-center">
                  <input type="text" name="{{$nameField}}" id="{{$nameField}}" hidden/>
                  <p>Are you sure wan to delete this {{$header}} ?</p>
              </div>
              <div class="d-flex justify-content-end">
                <button class="btn btn-secondary mr-3" data-dismiss="modal">Cancel</button>
                <button class="btn btn-danger" type="submit">Delete</button>
              </div>
            </div>
          </form>
        </div>
    </div>
</div>