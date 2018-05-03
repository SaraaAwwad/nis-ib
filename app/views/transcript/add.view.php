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
                                <option value="" disabled selected>Select Grade</option>
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
                                <option value="" disabled selected>Select Course</option>
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
                        <option value="" disabled selected>Select Semester</option>
<<<<<<< HEAD
                        <!-- <?php foreach($semester as $s){ ?>
                        <option value="<?php echo $s->id; ?>"><?php echo $s->season_name .' - '. $s->year; ?></option>
                        <?php } ?> -->
=======
>>>>>>> dc3a80f63d51bd0cc16a0f5128e8d8e29dd536bd
                            </select>
                        </div>
                    </div>


                    <fieldset id="studentform" style="display:none;">
                    <div class="container" style="margin-top:20px;">
                        <div class="row">
                            <div class="col-xs-6">
                                <h5>Students</h5>
                                <div class="students" style="max-height: 300px;overflow: auto;">

                                </div>
                            </div>
                    </fieldset>

                    <input type="submit" name="addTran" id="main">
                </form>
            </div>
        </div>
    </div>

    <script>

        $(document).ready(function(data){
            $('#transcriptform').hide();

            $('#grade').on('change',function(e){
                e.preventDefault();
                e.stopPropagation();

                $.ajax({
                    url:"/transcript/add",
                    method:'POST',
                    dataType:'json',
                    data:{
                        grade:$('#grade').val(),
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
                        $.each(data, function (i, course) {
                            $('#course').append($('<option>', { 
                                value: course.id,
                                text : course.course_code + " - "+ course.name
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
                           // alert(semester.id);
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

            
        });


    </script>
<?php
require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
require_once HOME_TEMPLATE_PATH . 'templatefooter.php';