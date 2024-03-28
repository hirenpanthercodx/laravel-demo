<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme.css') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!-- Script -->
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' type='text/javascript'></script>

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"> </script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"> </script>

    {{-- <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet' type='text/css'> --}}

</head>
<body>
    @if (session('auth_user') && session('auth_user')->role === 'admin')    
        <div style="display: flex">
            <div style="width: 250px">
                <aside class="main-sidebar sidebar-dark-primary elevation-4">
                    <p class="brand-link m-0">
                        <img class="brand-image elevation-3" style="opacity: 0.8">
                        <span class="brand-text font-weight-light">AdminLTE 3</span>
                    </p>
                    <div class="sidebar">
                        <nav class="mt-2">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                <li class="nav-item">
                                    <a href="/admin"
                                        @class([
                                            'nav-link',
                                            'active' => strpos(request()->url(), 'admin') && !strpos(request()->url(), 'calendar')
                                        ])
                                    >
                                        <i class="nav-icon far fa-calendar-alt"></i>
                                        <p>Dashboard</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/calendar" 
                                        @class([
                                            'nav-link',
                                            'active' => strpos(request()->url(), 'calendar')
                                        ])
                                    >
                                        <i class="nav-icon far fa-calendar-alt"></i>
                                        <p>Calendar</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/addRecord" 
                                        @class([
                                            'nav-link',
                                            'active' => strpos(request()->url(), 'salary')
                                        ])
                                    >
                                        <i class="nav-icon far fa-image"></i>
                                        <p>Salary</p>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </aside>
            </div>
            <div class="p-2" style="width: 85%">
                @yield('admin_dashboard')
                @yield('edit_admin')
                @yield('calender')
            </div>
        </div>
    @else
        <div class="container p-2">
            @yield('employee_data')
            @yield('edit_employee')
        </div>
    @endif

    <script>

        $(document).ready(function () {
        
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                }
            });
        
            var calendar = $('#calendar').fullCalendar({
                editable:true,
                header:{
                    left:'prev,next today',
                    center:'title',
                    right:'month,agendaWeek,agendaDay'
                },
                events:'/admin/calendar',
                selectable:true,
                selectHelper: true,
                // select:function(start, end, allDay)
                // {
                //     var title = prompt('Event Title:');
        
                //     if(title)
                //     {
                //         var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');
                //         var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');
        
                //         $.ajax({
                //             url:"/admin/calendar/action",
                //             type:"POST",
                //             data:{
                //                 title: title,
                //                 start: start,
                //                 end: end,
                //                 type: 'add'
                //             },
                //             success:function(data)
                //             {
                //                 calendar.fullCalendar('refetchEvents');
                //                 alert("Event Created Successfully");
                //             }
                //         })
                //     }
                // },
                editable:true,
                eventResize: function(event, delta)
                {
                    var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                    var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                    var title = event.title;
                    var id = event.id;
                    $.ajax({
                        url:"/admin/calendar/action",
                        type:"POST",
                        data:{
                            title: title,
                            start: start,
                            end: end,
                            id: id,
                            type: 'update'
                        },
                        success:function(response)
                        {
                            calendar.fullCalendar('refetchEvents');
                            alert("Event Updated Successfully");
                        }
                    })
                },
                eventDrop: function(event, delta)
                {
                    var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                    var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                    var title = event.title;
                    var id = event.id;
                    $.ajax({
                        url:"/admin/calendar/action",
                        type:"POST",
                        data:{
                            title: title,
                            start: start,
                            end: end,
                            id: id,
                            type: 'update'
                        },
                        success:function(response)
                        {
                            calendar.fullCalendar('refetchEvents');
                            alert("Event Updated Successfully");
                        }
                    })
                },
        
                eventClick:function(event)
                {
                    document.querySelector('select[name="user"]').value = '';
                    document.querySelector('input[name="title"]').value = '';
                    document.querySelector('input[name="start"]').value = '';
                    document.querySelector('input[name="end"]').value = '';

                    $('#mediumModal').modal("show");
                    const id = event.id;
                    // window.location.href = `{{ url('/admin/calendar/edit')}}/${id}`;

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

                    $.ajax({
                        url: '/admin/calendar/edit/' + id,
                        type: 'GET',
                        success: function(response) {
                            $('#title').val(response.title);
                            $('#id').val(response.id);
                            $('#delete_id').val(response.id);
                            
                            var startString = formatDate(response.start);
                            $('#start').val(startString);
                            var endString = formatDate(response.end);
                            $('#end').val(endString);
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });

                    // if(confirm("Are you sure you want to remove it?"))
                    // {
                    //     var id = event.id;
                    //     $.ajax({
                    //         url:"/admin/calendar/action",
                    //         type:"POST",
                    //         data:{
                    //             id:id,
                    //             type:"delete"
                    //         },
                    //         success:function(response)
                    //         {
                    //             calendar.fullCalendar('refetchEvents');
                    //             alert("Event Deleted Successfully");
                    //         }
                    //     })
                    // }
                }
            });
        
        });

        function formatDate(dateTimeString) {
            var date = new Date(dateTimeString);
            var year = date.getFullYear();
            var month = ('0' + (date.getMonth() + 1)).slice(-2); // Months are zero-based
            var day = ('0' + date.getDate()).slice(-2);
            var hours = ('0' + date.getHours()).slice(-2);
            var minutes = ('0' + date.getMinutes()).slice(-2);
            return year + '-' + month + '-' + day + 'T' + hours + ':' + minutes;
        }
   
    </script>
          
</body>
</html>