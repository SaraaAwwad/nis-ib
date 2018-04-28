<?php
    require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
    
?>
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
                        
                          <legend>Schedule Info</legend>

                         <div class="form-group">                               
                              <label class="col-sm-2 col-sm-2 control-label">Course</label>
                              <div class="col-sm-4">
                                <select name="course" id="course" class="form-control class" required>
                                    <option value="" selected="selected" disabled="disabled">Select Course</option>
                                    <?php 
                                        foreach($courses as $c){
                                            echo '<option value='.$c->id.'>'.$c->name.'</option>';
                                        }
                                    ?>
                                </select>
                              </div>


<!--                             <div class="form-group">-->
<!--                                 <label class="col-sm-2 control-label">Students</label>-->
<!--                                 <div class="col-sm-4">-->
<!--                                     <dl class="dropdown">-->
<!--                                         <dt>-->
<!--                                             <a href="#">-->
<!--                                                 <span class="hida">Select Students</span>-->
<!--                                                 <p class="multiSel"></p>-->
<!--                                             </a>-->
<!--                                         </dt>-->
<!--                                         <dd>-->
<!--                                             <div class="mutliSelect">-->
<!--                                                 <ul id="students">-->
<!--                                                 </ul>-->
<!--                                             </div>-->
<!--                                         </dd></dl>-->
<!--                                 </div>-->
<!--                             </div>-->

                             <label class="col-sm-2 col-sm-2 control-label">Students</label>
                             <div class="col-sm-4">
                                 <select multiple = "multiple" name="students[]" id="students" class="form-control semester" required>
                                     <option value="" disabled>Select Students</option>

                                 </select>
                             </div>

                             <label class="col-sm-2 col-sm-2 control-label">Slot</label>
                              <div class="col-sm-4">
                                <select name="slot" id="slot" class="form-control semester" required>
                                    <option value="" disabled selected >Select Slot</option>
                                </select>
                              </div>

                        </div>


                        <div class="form-group">

                        <label class="col-sm-2 col-sm-2 control-label">Day</label>
                              <div class="col-sm-4">
                                <select name="day" id="days" class="form-control semester" required>
                                    <option value="" disabled>Select Day</option>
                                </select>
                              </div>

                              <label class="col-sm-2 col-sm-2 control-label">Room</label>
                              <div class="col-sm-4">
                                <select name="room" id="rooms" class="form-control semester" required>
                                    <option value="" disabled>Select Room</option>
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
    // $(".dropdown dt a").on('click', function() {
    //     $(".dropdown dd ul").slideToggle('fast');
    // });
    //
    // $(".dropdown dd ul li a").on('click', function() {
    //     $(".dropdown dd ul").hide();
    // });
    //
    // function getSelectedValue(id) {
    //     return $("#" + id).find("dt a span.value").html();
    // }
    //
    // $(document).bind('click', function(e) {
    //     var $clicked = $(e.target);
    //     if (!$clicked.parents().hasClass("dropdown")) $(".dropdown dd ul").hide();
    // });
    //
    // // $('.mutliSelect input[type="checkbox"]').on('click', function() {
    // //
    // //     var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').val(),
    // //         title = $(this).val() + ",";
    // //
    // //     if ($(this).is(':checked')) {
    // //         var html = '<span title="' + title + '">' + title + '</span>';
    // //         $('.multiSel').append(html);
    // //         $(".hida").hide();
    // //     } else {
    // //         $('span[title="' + title + '"]').remove();
    // //         var ret = $(".hida");
    // //         $('.dropdown dt a').append(ret);
    // //
    // //     }
    // // });


    $(document).ready(function(data) {
        var pathname = window.location.pathname;
        $("#course").on('change',function(e){
            e.preventDefault();
            e.stopPropagation();
            $.ajax({
                url:pathname,
                method:'POST',
                dataType:'json',
                data:{
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
                    // alert(msg);
                },
            });
        });


    });
</script>   
<?php
    require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
    require_once HOME_TEMPLATE_PATH . 'templatefooter.php';