<?php
require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
require_once HOME_TEMPLATE_PATH . 'header.php';
require_once HOME_TEMPLATE_PATH . 'nav.php';
require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <div class="row">
        <div class="col-lg-9 main-chart">
            <h1>Transcript</h1>
        </div>
    </div>

    <div class="row mt">
        <div class="col-lg-12">
            <div class="form-panel">
                <form class="form-horizontal style-form" method="post">

                    

                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Grade</label>
                        <div class="col-sm-8">
                            <select name="grade" class="form-control" id="grade">
                                <option value="" selected="selected" disabled="disabled">Select Grade</option>
                                <?php foreach($grade as $grad){ ?>
                                    <option value="<?php echo $grad->id; ?>"><?php echo $grad->grade_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                            
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Course</label>
                        <div class="col-sm-8">
                            <select name="course" class="form-control" id="course">
                                <option value="" selected="selected" disabled="disabled">Select Course</option>
                                <?php foreach($course as $cr){ ?>
                                    <option value="<?php echo $cr->id; ?>"><?php echo $cr->course_code; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Semester</label>
                        <div class="col-sm-8">
                        <select name="semester" class="form-control" id="semester">
                            <option value="" selected="selected" disabled="disabled">Select Semester</option>
                            </select>
                        </div>
                    </div>


                    <fieldset id="studentform" style="display:none;">
                    
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Students</label>
                            <div class="col-sm-4">
                                <!-- <select  name="students" id="students" class="form-control semester" required>
                                    <option value="" selected="selected" disabled="disabled">Select Students</option>
                                </select> -->
                                <label class="col-sm-2 col-sm-2 control-label" id="students"></label>
                                <!-- <input type="text" class="form-control" id="studentid" disabled="disabled"> -->
                            </div>
                        

                        
                            <!-- <label class="col-sm-2 col-sm-2 control-label">Grade</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="grade" name="grade">
                            </div> -->
                        </div>
                        </div>
                        
                    </fieldset>

                    <input type="submit" name="addTran" id="main">
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(data) {
            var pathname = window.location.pathname;
            $('#transcriptform').hide();
            $('#grade').on('change',function(e){
                e.preventDefault();
                e.stopPropagation();
                $.ajax({
                    url:pathname,
                    method:'POST',
                    dataType:'json',
                    data:{
                        grade :$('#grade').val(),
                        action:"getCourses"
                    },
                    success:function(data)
                    {

                        $('#course').html('');
                        $('#course').append($('<option>', { 
                                text : "Select Course",
                                selected: true,
                                disabled: true,
                                value: ""
                            }));
                            $.each(data, function (i, data) {
                           $('#course').append($('<option>', { 
                                value: data.id,
                                text : data.course_code + " - "+ data.name
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
                        alert(msg);
                    },
                });
            });
            
            $('#course').on('change',function(e){
                e.preventDefault();
                e.stopPropagation();
                $.ajax({
                    url:"/transcript/add",
                    method:'POST',
                    dataType:'json',
                    data:{
                        course:$('#course').val(),
                        action:"getSemesters"
                    },
                    success:function(data)
                    {
                        $('#semester').html('');
                        $('#semester').append($('<option>', { 
                                text : "Select Semester",
                                selected: true,
                                disabled: true,
                                value: ""
                            }));
                            $.each(data, function (i, semester) {
                           $('#semester').append($('<option>', { 
                                value: semester.id,
                                text : semester.season_name + " - "+ semester.year
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
                        alert(msg);
                    },
                });
            });

            $("#semester").on('change',function(e){
                e.preventDefault();
                e.stopPropagation();
                $.ajax({
                    url: pathname,
                    method:'POST',
                    dataType:'json',
                    data:{
                        grade:$('#grade').val(),
                        course:$('#course').val(),
                        action:"getStudents"
                    },
                    success:function(data)
                    {
                        $("#studentform").show();
                        $('#students').html('');
                        $.each(data, function (i, data) {
                            $('#students').append($('<label>', {
                                
                                text : data.fname + ' ' + data.lname
                            })).append($('<input>'),{
                                name: data.id
                               
                            });
                        });
                    }
                });
            });

            // $("#students").on('click',function(e){
            //     e.preventDefault();
            //     e.stopPropagation();
            //     $.ajax({
            //         url: pathname,
            //         method:'POST',
            //         dataType:'json',

                    
                    


            //     });
            // });

            
        });
    </script>
<?php
require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
require_once HOME_TEMPLATE_PATH . 'templatefooter.php';