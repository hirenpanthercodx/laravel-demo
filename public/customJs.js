    
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
                $('#deleteBtn').show();
                $('#itemModalLabel').text('Edit Event');

                const id = event.id;
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
                        $('#user').val(response.admin_id);
                        
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
        var month = ('0' + (date.getMonth() + 1)).slice(-2);
        var day = ('0' + date.getDate()).slice(-2);
        var hours = ('0' + date.getHours()).slice(-2);
        var minutes = ('0' + date.getMinutes()).slice(-2);
        return year + '-' + month + '-' + day + 'T' + hours + ':' + minutes;
    }

    document.addEventListener("DOMContentLoaded", function() {
        var button = document.getElementById("mediumButton");

        button?.addEventListener("click", function() {
            document.querySelector('select[name="user"]').value = '';
            document.querySelector('input[name="title"]').value = '';
            document.querySelector('input[name="start"]').value = '';
            document.querySelector('input[name="end"]').value = '';

            $('#mediumModal').modal("show");
            $('#deleteBtn').hide();
            $('#itemModalLabel').text('Add Event');
            
            $.ajax({
                url: '/admin/dropdown',
                type: 'GET',
                success: function(response) {
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

    function deleteButton (id) {
        $('#deleteUserModel').modal("show");
        $('#deleteUserId').val(id);
    }

    function deleteEventButton () {
        $('#deleteCalendarEvent').modal("show");
    }