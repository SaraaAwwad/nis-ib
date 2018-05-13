
$(document).ready(function(data) {

    $("#gradeof").keydown(function (e) {

        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            // Allow: Ctrl/cmd+A
            (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: Ctrl/cmd+C
            (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: Ctrl/cmd+X
            (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });



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

        function DisableSpecificDates(date) {
            var m = ("0" + (date.getMonth() + 1)).slice(-2);
            var d = ("0" + (date.getDate())).slice(-2);
            var y = date.getFullYear();
            var currentdate = y + '-' + m + '-' + d ;

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