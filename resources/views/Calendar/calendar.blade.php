@extends('Layouts.app')

@section('calender')
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Calendar</h1>
          </div>
          <div class="col-sm-6">
            <a class="btn btn-success text-light float-sm-right" data-toggle="modal" id="mediumButton"
                title="Create a project">Add Event
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          {{-- <div class="col-md-3">
            <div class="sticky-top mb-3">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Draggable Events</h4>
                </div>
                <div class="card-body">
                  <!-- the events -->
                  <div id="external-events">
                    <div class="external-event bg-success">Lunch</div>
                    <div class="external-event bg-warning">Go home</div>
                    <div class="external-event bg-info">Do homework</div>
                    <div class="external-event bg-primary">Work on UI design</div>
                    <div class="external-event bg-danger">Sleep tight</div>
                    <div class="checkbox">
                      <label for="drop-remove">
                        <input type="checkbox" id="drop-remove">
                        remove after drop
                      </label>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Create Event</h3>
                </div>
                <div class="card-body">
                  <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                    <ul class="fc-color-picker" id="color-chooser">
                      <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                    </ul>
                  </div>
                  <!-- /btn-group -->
                  <div class="input-group">
                    <input id="new-event" type="text" class="form-control" placeholder="Event Title">

                    <div class="input-group-append">
                      <button id="add-new-event" type="button" class="btn btn-primary">Add</button>
                    </div>
                    <!-- /btn-group -->
                  </div>
                  <!-- /input-group -->
                </div>
              </div>
            </div>
          </div> --}}
          <div class="col-md-12">
            <div class="card card-primary p-0">
              <div class="card-body p-0">
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="top: 100px">
          <form method="post" action="{{ url('/admin/calendar/store') }}">
            @csrf
            <div class="modal-body" id="mediumBody">
              <div class="form-group">
                  <input type="text" name="id" id="id" hidden/>
                  <label for="user">User</label>
                  <select class="custom-select" id="user" name="user" required>

                  </select>
              </div>
              <div class="form-group">
                <label for="reason">Reason</label>
                <input type="text" id="title" name="title" class="form-control" placeholder="Enter Reason" required/>
              </div>
              <div class="">
                <div class="form-group">
                  <label for="startTime">Start</label>
                  <input type="datetime-local" name="start" class="form-control" id="start">
                </div>
                <div class="form-group">
                  <label for="startTime">End</label>
                  <input type="datetime-local" name="end" class="form-control" id="end">
                </div>
              </div>
              <div class="d-flex justify-content-end">
                <button class="btn btn-secondary mr-3" data-dismiss="modal">Cancel</button>
                <button class="btn btn-success" type="submit">Save</button>
              </div>
            </div>
          </form>
          <div style="position: absolute; top: 84%; margin-left: 16px">
            <form method="post" action="{{ url('/admin/calendar/delete') }}">
              @csrf
              <input type="text" name="delete_id" id="delete_id" hidden/>
              <button class="btn btn-danger">Delete</button>
            </form>
          </div>
        </div>
    </div>
  </div>
@endsection

  <script>
    document.addEventListener("DOMContentLoaded", function() {
    var button = document.getElementById("mediumButton");

      button.addEventListener("click", function() {
        document.querySelector('select[name="user"]').value = '';
        document.querySelector('input[name="title"]').value = '';
        document.querySelector('input[name="start"]').value = '';
        document.querySelector('input[name="end"]').value = '';

        $('#mediumModal').modal("show");

        $.ajax({
          url: '/admin/dropdown',
          type: 'GET',
          success: function(response) {
              // $('#user').empty();
              $('#user').append($('<option>', {
                    value: null,
                    text: 'Select User'
              }));
              $.each(response, function(index, user) {
                  $('#user').append($('<option>', {
                      value: user.id,
                      text: user.firstName + ' ' + user.lastName
                  }));
              });
          },
          error: function(xhr, status, error) {
              console.error(xhr.responseText);
          }
        });
      });
    }); 
  </script>