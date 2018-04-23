<?php
    require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
    
?>  

    <script type="text/javascript" src="<?=PDF?>jspdf.debug.js"></script>
<?php
    require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
    require_once HOME_TEMPLATE_PATH . 'header.php';
    require_once HOME_TEMPLATE_PATH . 'nav.php';
    require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
?>
    <div class="row">
        <div class="col-lg-9 main-chart">
            <h1>Add Schedule Details</h1>
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
                                <select name="course" class="form-control class" required>
                                    <option value="" disabled>Select Course</option>
                                    <?php 
                                        foreach($courses as $c){
                                            echo '<option value='.$c->id.'>'.$c->name.'</option>';
                                        }
                                    ?>
                                </select>
                              </div>

                               <label class="col-sm-2 col-sm-2 control-label">Slot</label>
                              <div class="col-sm-4">
                                <select name="slot" id="slot" class="form-control semester" required>
                                    <option value="" disabled selected >Select Slot</option>
                                    <?php 
                                        foreach($slots as $st){
                                            echo '<option value='.$st->id.'>'.$st->slot_name .'</option>';
                                        }
                                    ?>
                                </select>
                              </div>

                        </div>


                        <div class="form-group">                               
                             
                        <label class="col-sm-2 col-sm-2 control-label">Day</label>
                              <div class="col-sm-4">
                                <select name="day" id="days" class="form-control semester" required>
                                    <option value="" disabled>Select Day</option>
                                    <?php 
                                        foreach($days as $d){
                                            echo '<option value='.$d->id.'>'.$d->day .'</option>';
                                        }
                                    ?>
                                </select>
                              </div>

                              <label class="col-sm-2 col-sm-2 control-label">Room</label>
                              <div class="col-sm-4">
                                <select name="room" id="rooms" class="form-control semester" required>
                                    <option value="" disabled>Select Room</option>
                                    <?php 
                                        foreach($rooms as $r){
                                            echo '<option value='.$r->id.'>'.$r->room_name .'</option>';
                                        }
                                    ?>
                                </select>
                              </div>
                              
                          </div>

                            <div class="form-group">                               
                            <label class="col-sm-2 control-label">Teacher</label>
                              <div class="col-sm-4">
                                <select name="teacher" id="teachers" class="form-control semester" required>
                                    <option value="" disabled>Select Teacher</option>

                                    <?php 
                                        foreach($teacher as $t){
                                            echo '<option value='.$t->id.'>'.$t->fname .', '. $t->lname .'</option>';
                                        }
                                    ?>
                                </select>
                              </div>

                            </div>
                        
                        </fieldset>
                        <input type="submit" name="addDetail" id="main">
                      </form>
                  </div>
              </div>      
            </div>

<button type="button" class="btn btn-danger" id="toPDF" > Export as PDF </button>

<div id="sched">
    <table id="tab_sched" class="table table-striped text-center">
        <colgroup>
            <col width="5%">
                <col width="20%">
                    <col width="10%">
                        <col width="15%">
                            <col width="20%">
                                <col width="10%">
                                    <col width="20%">
        </colgroup>
        <thead>
            <tr class='warning'>
                <th>ID</th>
                <th>Course</th>
                <th>Slot</th>
                <th>Day</th>
                <th>Teacher</th>
                <th>Room</th>
                <th>Actions</th>                
            </tr>
        </thead>
        <tbody>
        
            <?php
            if(!empty($details)){
                foreach ($details as $s){
                    echo '<tr>
                    <td>'.$s->id.'</td>
                    <td>'.$s->course_code.'</td>
                    <td>'.$s->slot_name.'</td>
                    <td>'.$s->day.'</td>                    
                    <td>'.$s->fname .' - '. $s->lname.'</td>
                    <td>'.$s->room_name.'</td>
                    <td> 
                        <a class="delete" id="'.$s->id.'" href="\schedule\deletedetail\\'.$s->id.'" >Delete </a></td>
                    </tr>';    
                }
            }
            ?>
        
        </tbody>
    </table>
</div>

<table id="cloned">
</table>

<script>
    $(document).ready(function(data){
    var pathname = window.location.pathname;
    $('#cloned').hide();
    
    var clone = jQuery("#tab_sched").clone(true);
    $('#cloned').html('');
    $('#cloned').append(clone[0]);
    $("#cloned th:last-child, #cloned td:last-child").remove();

    $("#toPDF").click(function(){
    var pdf = new jsPDF('p', 'pt', 'letter');

    source = $('#cloned')[0];
    margins = {
        top: 80,
        bottom: 60,
        left: 40,
        width: 522
    };

    pdf.fromHTML(
    source, // HTML string or DOM elem ref.
    margins.left, // x coord
    margins.top, { // y coord
        'width': margins.width
    },

    function (dispose) {
        pdf.save('Schedule.pdf');
    }, margins);

});


    $("#slot").on('change',function(e){
        e.preventDefault();
        e.stopPropagation();
        $.ajax({  
                url:pathname,  
                method:'POST',  
                dataType:'json',
                data:{  
                    slot: $("#slot").val(),
                    action:"getDays"
                },  
                success:function(data)  
                {  
                  $('#days').html('');
                  $('#days').append($('<option>', { 
                            text : "Select Day",
                            selected: true,
                            disabled: true,
                            value: ""
                        }));
                  $.each(data, function (i, data) {
                        $('#days').append($('<option>', { 
                            value: data.id,
                            text : data.day, 
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

        $("#days").on('change',function(e){
        e.preventDefault();
        e.stopPropagation();

         $.ajax({  
                url:pathname,  
                method:'POST',  
                dataType:'json',
                data:{  
                    slot: $("#slot").val(),
                    day: $("#days").val(),
                    action:"getRooms"
                },  
                success:function(data)  
                {  
                    var rooms = data.rooms;
                    var teachers = data.teachers;

                $('#rooms').html('');
                $('#rooms').append($('<option>', { 
                    text : "Select Room",
                    selected: true,
                    disabled: true,
                    value: ""
                }));
                  $.each(rooms, function (i, rooms) {
                        $('#rooms').append($('<option>', { 
                            value: rooms.id,
                            text : rooms.room_name 
                        }));
                    });
                
                    //----------------------

                $('#teachers').html('');
                $('#teachers').append($('<option>', { 
                    text : "Select Teacher",
                    selected: true,
                    disabled: true, 
                    value: ""
                }));
                  $.each(teachers, function (i, teachers) {
                        $('#teachers').append($('<option>', { 
                            value: teachers.id,
                            text : teachers.fname 
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

    });

</script>   
<?php
    require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
    require_once HOME_TEMPLATE_PATH . 'templatefooter.php';