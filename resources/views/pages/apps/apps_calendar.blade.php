@extends('layouts.app')

@section('content')

<div>
    <h1>ALL EVENTS</h1>
    <!-- @foreach ($events as $event) -->
    <!-- {{$start = $event->start->dateTime}}
    @if (empty($start))
    {{$start = $event->start->date}}
    @endif -->
    <!-- <p>{{$event->id}}</p> -->
    <!-- <p>{{$event->description}}</p> -->
    <!-- <p>{{$event->start->dateTime}}</p> -->
    <!-- <p>{{$event->end->dateTime}}</p> -->


    <!-- <p>{{$event->description}}</p> -->

    <!-- <p>{{$event->getSummary()}}</p> -->
    <!-- @endforeach -->

</div>

<div class="layout-px-spacing">
    <div class="row layout-top-spacing" id="cancel-row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <div class="calendar-upper-section">
                        <div class="row">
                            <div class="col-md-8 col-12">
                                <div class="labels">
                                    <p class="label label-primary">Work</p>
                                    <p class="label label-warning">Travel</p>
                                    <p class="label label-success">Personal</p>
                                    <p class="label label-danger">Important</p>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <form action="javascript:void(0);"
                                    class="form-horizontal mt-md-0 mt-3 text-md-right text-center">
                                    <button id="myBtn" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-calendar mr-2">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                            <line x1="16" y1="2" x2="16" y2="6"></line>
                                            <line x1="8" y1="2" x2="8" y2="6"></line>
                                            <line x1="3" y1="10" x2="21" y2="10"></line>
                                        </svg> Add Event</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="calendar"></div>
                </div>
            </div>
        </div>

        <!-- The Modal -->
        <div id="addEventsModal" class="modal animated fadeIn">

            <div class="modal-dialog modal-dialog-centered">

                <!-- Modal content -->
                <div class="modal-content">

                    <div class="modal-body">

                        <span class="close">&times;</span>

                        <div class="add-edit-event-box">
                            <div class="add-edit-event-content">
                                <h5 class="add-event-title modal-title">Add Events</h5>
                                <h5 class="edit-event-title modal-title">Edit Events</h5>

                                <form class="">

                                    <div class="row">

                                        <div class="col-md-12">
                                            <label for="start-date" class="">Event Title:</label>
                                            <div class="d-flex event-title">
                                                <input id="write-e" type="text" placeholder="Enter Title"
                                                    class="form-control" name="task">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="form-group start-date">
                                                <label for="start-date" class="">From:</label>
                                                <div class="d-flex">
                                                    <input id="start-date" placeholder="Start Date" class="form-control"
                                                        type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="form-group end-date">
                                                <label for="end-date" class="">To:</label>
                                                <div class="d-flex">
                                                    <input id="end-date" placeholder="End Date" type="text"
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="start-date" class="">Event Description:</label>
                                            <div class="d-flex event-description">
                                                <textarea id="taskdescription" placeholder="Enter Description" rows="3"
                                                    class="form-control" name="taskdescription"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="event-badge">
                                                <p class="">Badge:</p>

                                                <div class="d-sm-flex d-block">
                                                    <div class="n-chk">
                                                        <label class="new-control new-radio radio-primary">
                                                            <input type="radio" class="new-control-input" name="marker"
                                                                value="1" checked>
                                                            <span class="new-control-indicator"></span>Work
                                                        </label>
                                                    </div>

                                                    <div class="n-chk">
                                                        <label class="new-control new-radio radio-warning">
                                                            <input type="radio" class="new-control-input" name="marker"
                                                                value="5">
                                                            <span class="new-control-indicator"></span>Travel
                                                        </label>
                                                    </div>

                                                    <div class="n-chk">
                                                        <label class="new-control new-radio radio-success">
                                                            <input type="radio" class="new-control-input" name="marker"
                                                                value="2">
                                                            <span class="new-control-indicator"></span>Personal
                                                        </label>
                                                    </div>

                                                    <div class="n-chk">
                                                        <label class="new-control new-radio radio-danger">
                                                            <input type="radio" class="new-control-input" name="marker"
                                                                value="11" selected>
                                                            <span class="new-control-indicator"></span>Important
                                                        </label>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button id="discard" class="btn" data-dismiss="modal">Discard</button>
                        <button id="add-e" class="btn">Add Task</button>
                        <button id="edit-event" class="btn">Save</button>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {

        // Get the modal
        var modal = document.getElementById("addEventsModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the Add Event button
        var addEvent = document.getElementById("add-e");
        // Get the Edit Event button
        var editEvent = document.getElementById("edit-event");
        // Get the Discard Modal button
        var discardModal = document.querySelectorAll("[data-dismiss='modal']")[0];

        // Get the Add Event button
        var addEventTitle = document.getElementsByClassName("add-event-title")[0];
        // Get the Edit Event button
        var editEventTitle = document.getElementsByClassName("edit-event-title")[0];

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // Get the all <input> elements insdie the modal
        var input = document.querySelectorAll('input[type="text"]');
        var radioInput = document.querySelectorAll('input[type="radio"]');

        // Get the all <textarea> elements insdie the modal
        var textarea = document.getElementsByTagName('textarea');

        // Create BackDrop ( Overlay ) Element
        function createBackdropElement() {
            var btn = document.createElement("div");
            btn.setAttribute('class', 'modal-backdrop fade show')
            document.body.appendChild(btn);
        }

        // Reset radio buttons

        function clearRadioGroup(GroupName) {
            var ele = document.getElementsByName(GroupName);
            for (var i = 0; i < ele.length; i++)
                ele[i].checked = false;
        }

        // Reset Modal Data on when modal gets closed
        function modalResetData() {
            modal.style.display = "none";
            for (i = 0; i < input.length; i++) {
                input[i].value = '';
            }
            for (j = 0; j < textarea.length; j++) {
                textarea[j].value = '';
                i
            }
            clearRadioGroup("marker");
            // Get Modal Backdrop
            var getModalBackdrop = document.getElementsByClassName('modal-backdrop')[0];
            document.body.removeChild(getModalBackdrop)
        }

        // When the user clicks on the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
            addEvent.style.display = 'block';
            editEvent.style.display = 'none';
            addEventTitle.style.display = 'block';
            editEventTitle.style.display = 'none';
            document.getElementsByTagName('body')[0].style.overflow = 'hidden';
            createBackdropElement();
            enableDatePicker();
        }

        // Clear Data and close the modal when the user clicks on Discard button
        discardModal.onclick = function() {
            modalResetData();
            document.getElementsByTagName('body')[0].removeAttribute('style');
        }

        // Clear Data and close the modal when the user clicks on <span> (x).
        span.onclick = function() {
            modalResetData();
            document.getElementsByTagName('body')[0].removeAttribute('style');
        }

        // Clear Data and close the modal when the user clicks anywhere outside of the modal.
        window.onclick = function(event) {
            if (event.target == modal) {
                modalResetData();
                document.getElementsByTagName('body')[0].removeAttribute('style');
            }
        }

        newDate = new Date()
        monthArray = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12']

        function getDynamicMonth(monthOrder) {
            var getNumericMonth = parseInt(monthArray[newDate.getMonth()]);
            var getNumericMonthInc = parseInt(monthArray[newDate.getMonth()]) + 1;
            var getNumericMonthDec = parseInt(monthArray[newDate.getMonth()]) - 1;

            if (monthOrder === 'default') {

                if (getNumericMonth < 10) {
                    return '0' + getNumericMonth;
                } else if (getNumericMonth >= 10) {
                    return getNumericMonth;
                }

            } else if (monthOrder === 'inc') {

                if (getNumericMonthInc < 10) {
                    return '0' + getNumericMonthInc;
                } else if (getNumericMonthInc >= 10) {
                    return getNumericMonthInc;
                }

            } else if (monthOrder === 'dec') {

                if (getNumericMonthDec < 10) {
                    return '0' + getNumericMonthDec;
                } else if (getNumericMonthDec >= 10) {
                    return getNumericMonthDec;
                }
            }
        }

        /* initialize the calendar
        -----------------------------------------------------------------*/

        var calendar = $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: [
                <?php for ($i = 0; $i<sizeof($events); $i++) {
    $className = "bg-primary";

    if ($events[$i]['colorId']==11) {
        $className = "bg-danger";
    } elseif ($events[$i]['colorId']==2) {
        $className = "bg-success";
    } elseif ($events[$i]['colorId']==5) {
        $className = "bg-warning";
    } ?>
                {
                    id: "{!! $events[$i]['id'] !!}",
                    start: "{!! $events[$i]['start']['dateTime'] !!}",
                    end: "{!! $events[$i]['end']['dateTime'] !!}",
                    title: "{!! $events[$i]->getSummary() !!}",
                    description: "{!! $events[$i]['description'] !!}",
                    className: "{!! $className !!}",
                },
                <?php
} ?>
            ],
            editable: true,
            eventLimit: true,
            eventMouseover: function(event, jsEvent, view) {
                $(this).attr('id', event.id);

                $('#' + event.id).popover({
                    template: '<div class="popover popover-primary" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>',
                    title: event.title,
                    content: event.description,
                    placement: 'top',
                });

                $('#' + event.id).popover('show');
            },
            eventMouseout: function(event, jsEvent, view) {
                $('#' + event.id).popover('hide');
            },
            eventClick: function(info) {
                addEvent.style.display = 'none';
                editEvent.style.display = 'block';

                addEventTitle.style.display = 'none';
                editEventTitle.style.display = 'block';
                modal.style.display = "block";
                document.getElementsByTagName('body')[0].style.overflow = 'hidden';
                createBackdropElement();

                // Calendar Event Featch
                var eventTitle = info.title;
                var eventDescription = info.description;

                // Task Modal Input
                var taskTitle = $('#write-e');
                var taskTitleValue = taskTitle.val(eventTitle);

                var taskDescription = $('#taskdescription');
                var taskDescriptionValue = taskDescription.val(eventDescription);

                var taskInputStarttDate = $("#start-date");
                var taskInputStarttDateValue = taskInputStarttDate.val(info.start.format(
                    "YYYY-MM-DD HH:mm:ss"));

                var taskInputEndDate = $("#end-date");
                var taskInputEndtDateValue = taskInputEndDate.val(info.end.format(
                    "YYYY-MM-DD HH:mm:ss"));

                var startDate = flatpickr(document.getElementById('start-date'), {
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                    defaultDate: info.start.format("YYYY-MM-DD HH:mm:ss"),
                });

                var abv = startDate.config.onChange.push(function(selectedDates, dateStr,
                    instance) {
                    var endtDate = flatpickr(document.getElementById('end-date'), {
                        enableTime: true,
                        dateFormat: "Y-m-d H:i",
                        minDate: dateStr
                    });
                })

                var endtDate = flatpickr(document.getElementById('end-date'), {
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                    defaultDate: info.end.format("YYYY-MM-DD HH:mm:ss"),
                    minDate: info.start.format("YYYY-MM-DD HH:mm:ss")
                });

                var colorValue = 1;

                if (info.className[0] == 'bg-warning') {
                    colorValue = 5;
                } else if (info.className[0] == 'bg-success') {
                    colorValue = 2;
                } else if (info.className[0] == 'bg-danger') {
                    colorValue = 11;
                } else if (info.className[0] == 'bg-primary') {
                    colorValue = 1;
                }

                $("input[name=marker][value=" + colorValue + "]").prop("checked", true);

                $('#edit-event').off('click').on('click', function(event) {
                    event.preventDefault();
                    /* Act on the event */
                    var radioValue = $("input[name='marker']:checked").val();

                    var taskStartTimeValue = document.getElementById("start-date").value;
                    var taskEndTimeValue = document.getElementById("end-date").value;

                    info.title = taskTitle.val();
                    info.description = taskDescription.val();
                    info.start = taskStartTimeValue;
                    info.end = taskEndTimeValue;

                    var className = 'bg-primary';
                    radioValue = parseInt(radioValue);

                    if (radioValue == 11) {
                        className = 'bg-danger'
                    } else if (radioValue == 5) {
                        className = 'bg-warning'
                    } else if (radioValue == 2) {
                        className = 'bg-success'
                    }

                    info.className = className;

                    var updatedEvent = {
                        'id': info.id,
                        'title': info.title,
                        'description': info.description,
                        'start': info.start,
                        'end': info.end,
                        'className': radioValue
                    }

                    console.log(info);

                    editEventData(updatedEvent);

                    $('#calendar').fullCalendar('updateEvent', info);
                    modal.style.display = "none";
                    modalResetData();
                    document.getElementsByTagName('body')[0].removeAttribute('style');
                });
            }
        })

        function editEventData(updatedEvent) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/gcal/events/edit',
                data: updatedEvent,
                success: function(data) {
                    if (data['status'] == 'success') {
                        console.log('success')
                    } else {
                        console.log('error')
                    }
                }
            });
        }


        function enableDatePicker() {
            var startDate = flatpickr(document.getElementById('start-date'), {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                minDate: new Date()
            });

            var abv = startDate.config.onChange.push(function(selectedDates, dateStr, instance) {

                var endtDate = flatpickr(document.getElementById('end-date'), {
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                    minDate: dateStr
                });
            })

            var endtDate = flatpickr(document.getElementById('end-date'), {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                minDate: new Date()
            });
        }


        function randomString(length, chars) {
            var result = '';
            for (var i = length; i > 0; --i) result += chars[Math.round(Math.random() * (chars.length - 1))];
            return result;
        }
        $("#add-e").off('click').on('click', function(event) {
            var radioValue = $("input[name='marker']:checked").val();
            var randomAlphaNumeric = randomString(10,
                '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
            var inputValue = $("#write-e").val();
            var inputStarttDate = document.getElementById("start-date").value;
            var inputEndDate = document.getElementById("end-date").value;

            var arrayStartDate = inputStarttDate.split(' ');

            var arrayEndDate = inputEndDate.split(' ');

            var startDate = arrayStartDate[0];
            var startTime = arrayStartDate[1];

            var endDate = arrayEndDate[0];
            var endTime = arrayEndDate[1];

            var concatenateStartDateTime = startDate + 'T' + startTime + ':00';
            var concatenateEndDateTime = endDate + 'T' + endTime + ':00';

            var inputDescription = document.getElementById("taskdescription").value;
            var myCalendar = $('#calendar');
            // console.log(radioValue);

            var className = 'bg-primary';
            radioValue = parseInt(radioValue);

            if (radioValue == 11) {
                className = 'bg-danger'
            } else if (radioValue == 5) {
                className = 'bg-warning'
            } else if (radioValue == 2) {
                className = 'bg-success'
            }


            myCalendar.fullCalendar();
            var myEvent = {
                timeZone: 'UTC',
                allDay: false,
                id: randomAlphaNumeric,
                title: inputValue,
                start: concatenateStartDateTime,
                end: concatenateEndDateTime,
                colorId: radioValue,
                className: className,
                description: inputDescription
            };
            addToDatabase(myEvent);
            myCalendar.fullCalendar('renderEvent', myEvent, true);
            modal.style.display = "none";
            modalResetData();
            document.getElementsByTagName('body')[0].removeAttribute('style');
        });

        function addToDatabase(myEvent) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/gcal/events/store',
                data: myEvent,
                success: function(data) {
                    if (data['status'] == 'success') {
                        console.log('success')
                    } else {
                        console.log('error')
                    }
                }
            });
        }


        // Setting dynamic style ( padding ) of the highlited ( current ) date

        function setCurrentDateHighlightStyle() {
            getCurrentDate = $('.fc-content-skeleton .fc-today').attr('data-date');
            if (getCurrentDate === undefined) {
                return;
            }
            splitDate = getCurrentDate.split('-');
            if (splitDate[2] < 10) {
                $('.fc-content-skeleton .fc-today .fc-day-number').css('padding', '3px 8px');
            } else if (splitDate[2] >= 10) {
                $('.fc-content-skeleton .fc-today .fc-day-number').css('padding', '3px 4px');
            }
        }
        setCurrentDateHighlightStyle();

        const mailScroll = new PerfectScrollbar('.fc-scroller', {
            suppressScrollX: true
        });

        var fcButtons = document.getElementsByClassName('fc-button');
        for (var i = 0; i < fcButtons.length; i++) {
            fcButtons[i].addEventListener('click', function() {
                const mailScroll = new PerfectScrollbar('.fc-scroller', {
                    suppressScrollX: true
                });
                $('.fc-scroller').animate({
                    scrollTop: 0
                }, 100);
                setCurrentDateHighlightStyle();
            })
        }
    });
</script>
@endsection
