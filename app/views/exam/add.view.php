<?php
require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';

?>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<?php
require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
require_once HOME_TEMPLATE_PATH . 'header.php';
require_once HOME_TEMPLATE_PATH . 'nav.php';
require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
?>
    <div class="row">
        <div class="col-lg-9 main-chart">
            <h1>Add Exam Details</h1>
            <hr>
        </div>
    </div>

    <div class="row mt info">
        <div class="col-lg-12">
            <div class="form-panel">
                <form class="form-horizontal style-form" method="post">

                    <legend>Exam Info</legend>

                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Grade</label>
                        <div class="col-sm-4">
                            <select name="grade" id="grade" class="form-control class" required>
                                <option value="" selected="selected" disabled="disabled">Select Grade</option>
                                <?php
                                foreach($grades as $grade){
                                    echo '<option value='.$grade->id.'>'.$grade->grade_name.'</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <label class="col-sm-2 col-sm-2 control-label">Course</label>
                        <div class="col-sm-4">
                            <select name="course" id="course" class="form-control class" required>
                                <option value="" selected="selected" disabled="disabled">Select Course</option>
                            </select>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Students</label>
                        <div class="col-sm-4">
                            <select multiple = "multiple" name="students[]" id="students" class="form-control semester" required>
                                <option value="" disabled>Select Students</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">

                        <label class="col-sm-2 col-sm-2 control-label">Day</label>
                        <div class="col-sm-4">
                            <select name="day" id="day" class="form-control semester" required>
                                <option value="" selected="selected" disabled="disabled">Select Day</option>
                                <?php
                                foreach($days as $d){
                                    echo '<option value='.$d->id.'>'.$d->day.'</option>';
                                }
                                ?>
                            </select>
                        </div>


                        <select name="visible" id="visible" class="form-control semester" style="display:none;">
                        <option value="" disabled="disabled">Select Date</option>
                        </select>

                        <label class="col-sm-2 col-sm-2 control-label">Date</label>
                        <div class="col-sm-4">
                            <input id="date" type="text" name="dateinput" required>
                        </div>

                    </div>


                    <div class="form-group">

                        <label class="col-sm-2 col-sm-2 control-label">Slot</label>
                        <div class="col-sm-4">
                            <select name="slot" id="slot" class="form-control semester" required>
                                <option value="" selected="selected" disabled="disabled">Select Slot</option>
                                <?php
                                foreach($slots as $slot){
                                    echo '<option value='.$slot->id.'>'.$slot->slot_name.'</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <label class="col-sm-2 col-sm-2 control-label">Room</label>
                        <div class="col-sm-4">
                            <select name="room" id="room" class="form-control semester" required>
                                <option value="" selected="selected" disabled="disabled">Select Room</option>
                            </select>
                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-sm-2 col-sm-2 control-label">Semester</label>
                        <div class="col-sm-4">
                            <select name="semester" id="semester" class="form-control semester" required>
                                <option value="" selected="selected" disabled="disabled">Select Semester</option>
                                <?php
                                foreach($semesters as $semester){
                                    echo '<option value='.$semester->id.'>'.$semester->season_name.' - '.$semester->year.'</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <label class="col-sm-2 col-sm-2 control-label">Status</label>
                        <div class="col-sm-4">
                            <select name="status" id="status" class="form-control semester" required>
                                <option value="" selected="selected" disabled="disabled">Select Status</option>
                                <?php
                                foreach($status as $stmt){
                                    echo '<option value='.$stmt->id.'>'.$stmt->code.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    </fieldset>
                    <input type="submit" name="addDetail" id="main">
                    <a href="/exam/default" id="cancel">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    <script>

        // $(function(){
        //     var dtToday = new Date();
        //
        //     var month = dtToday.getMonth() + 1;
        //     var day = dtToday.getDate();
        //     var year = dtToday.getFullYear();
        //
        //     if(month < 10)
        //         month = '0' + month.toString();
        //     if(day < 10)
        //         day = '0' + day.toString();
        //
        //     var maxDate = year + '-' + month + '-' + day;
        //     $('#date').attr('max', maxDate);
        // });


        $(document).ready(function(data) {
            var pathname = window.location.pathname;

            $("#students").on('change',function() {
                if( $('#students :selected').length > 0) {
                    var selectednumbers = [];
                    $('#students :selected').each(function (i, selected) {
                        selectednumbers[i] = $(selected).val();
                    });

                    var stmt = selectednumbers.join(',');

                    $.ajax({
                        url: pathname,
                        method: 'POST',
                        data: {
                            students : stmt,
                            action : "getStudents"
                        },
                        success: function (data) {
                            //alert("by3ml");
                            $('#visible').html('');
                            $.each(JSON.parse(data), function (i, data) {
                                $('#visible').append($('<option>', {
                                    value: data.date
                                    ,text: data.date
                                }));
                            });
                        }, error: function(XMLHttpRequest, textStatus, errorThrown) {
                            alert("Status: " + textStatus); alert("Error: " + errorThrown);
                        }
                    });
                }
            });

            $("#day").on('click',function() {

                var disableddates = [];
                $('#visible option').each(function() {
                     disableddates.push($(this).val());
                });
                //console.log(disableddates);
                function DisableSpecificDates(date) {
                    var m = ("0" + (date.getMonth() + 1)).slice(-2);
                    var d = ("0" + (date.getDate())).slice(-2);
                    var y = date.getFullYear();
                    var currentdate = y + '-' + m + '-' + d ;
                    //console.log(currentdate);
                    for (var i = 0; i < disableddates.length; i++) {
                        if ($.inArray(currentdate, disableddates) != -1 ) {
                            return [false];
                        }else{
                            var today = $("#day").val();
                            return disabledays(date,today);
                        } } }

                function disabledays(date,num) {
                    var day = date.getDay();
                    return [(day == num)];
                }

                $(function () {
                    $("#date").datepicker({
                        dateFormat: 'yy-mm-dd',
                        beforeShowDay: DisableSpecificDates
                    });
                });  });

             $("#grade, #course").on('change',function() {
                 $.ajax({
                     url:pathname,
                     method:'POST',
                     dataType:'json',
                     data:{
                         grade: $("#grade").val(),
                         course: $("#course").val(),
                         action:"getCourse"
                     },
                     success:function(data)
                     {
                         $('#students').html('');
                         $.each(data, function (i, data) {
                             $('#students').append($('<option>', {
                                 value: data.id,
                                 text : data.fname + ' ' + data.lname
                             }));
                         });

                     },
                     error: function (jqXHR, exception) {
                         var msg = '';
                         if (jqXHR.status === 0) {
                             msg = 'Not connect.\n Verify Network.';
                         } else if (jqXHR.status == 404) {
                             msg = 'Requested page not found. [404]';
                         } else if (jqXHR.status == 500) {
                             msg = 'Internal Server Error [500].';
                         } else if (exception === 'parsererror') {
                             msg = 'Requested JSON parse failed.';
                         } else if (exception === 'timeout') {
                             msg = 'Time out error.';
                         } else if (exception === 'abort') {
                             msg = 'Ajax request aborted.';
                         } else {
                             msg = 'Uncaught Error.\n' + jqXHR.responseText;
                         }
                         //alert(msg);
                     }
             }); });


            $("#slot").on('change',function() {

                    $.ajax({
                        url: pathname,
                        method: 'POST',
                        data: {
                            slot: $("#slot").val(),
                            date: $("#date").val(),
                            action : "getRooms"
                        },
                        success: function (data) {
                            $('#room').html('');
                            $('#room').append($('<option>', {
                                value: "",
                                text: "Select Room",
                                selected: true,
                                disabled: true
                            }));
                            $.each(JSON.parse(data), function (i, data) {
                                $('#room').append($('<option>', {
                                    value: data.id,
                                    text: data.room_name
                                }));
                            });
                        }, error: function(XMLHttpRequest, textStatus, errorThrown) {
                            alert("Status: " + textStatus); alert("Error: " + errorThrown);
                        }
                    });
                });

            $("#grade").on('change',function() {

                $.ajax({
                    url: pathname,
                    method: 'POST',
                    data: {
                        grade: $("#grade").val(),
                        action : "getCourseByGrade"
                    },
                    success: function (data) {
                        $('#course').html('');
                        $('#course').append($('<option>', {
                            value: "",
                            text: "Select Course",
                            selected: true,
                            disabled: true
                        }));
                        $.each(JSON.parse(data), function (i, data) {
                            $('#course').append($('<option>', {
                                value: data.id,
                                text: data.name
                            }));
                        });
                    }, error: function(XMLHttpRequest, textStatus, errorThrown) {
                        alert("Status: " + textStatus); alert("Error: " + errorThrown);
                    }
                });
            });

        });

            // $("#date").on('click',function() {
            //     if( $('#students :selected').length > 0) {
            //         var selectednumbers = [];
            //         $('#students :selected').each(function (i, selected) {
            //             selectednumbers[i] = $(selected).val();
            //         });
            //
            //         var stmt = selectednumbers.join(',');
            //         $.ajax({
            //             url: pathname,
            //             method: 'POST',
            //             data: {
            //                 students : stmt,
            //                 day: $("#day").val(),
            //                 date: $("#date").val(),
            //                 action : "getSlots"
            //             },
            //             success: function (data) {
            //                 alert("by3ml");
            //                 $.each(JSON.parse(data), function (i, data) {
            //                     $('#slot').append($('<option>', {
            //                         value: data.id,
            //                         text: data.slot_name
            //                     }));
            //                 });
            //             }, error: function(XMLHttpRequest, textStatus, errorThrown) {
            //                 alert("Status: " + textStatus); alert("Error: " + errorThrown);
            //             }
            //         });
            //     } });

    </script>
<?php
require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
require_once HOME_TEMPLATE_PATH . 'templatefooter.php';