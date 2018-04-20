<?php
    require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
    require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
    require_once HOME_TEMPLATE_PATH . 'header.php';
    require_once HOME_TEMPLATE_PATH . 'nav.php';
    require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
?>

    <div class="row">
        <div class="col-lg-9 main-chart">
            <h1>Add A New Schedule</h1>
            <hr>
		</div>
	</div>	

        <div class="row mt info">
              <div class="col-lg-12">
                  <div class="form-panel">
                      <form class="form-horizontal style-form" method="post">
                        
                          <legend>Schedule Info</legend>

                         <div class="form-group">                               
                              <label class="col-sm-2 col-sm-2 control-label">Class</label>
                              <div class="col-sm-8">
                                <select name="name" class="form-control class">
                                    <option value="" disabled>Select Class</option>
                                    <?php 
                                        foreach($class as $classname){
                                            echo '<option value='.$classname->id.'>'.$classname->name.'</option>';
                                        }
                                    ?>
                                </select>
                              </div>
                          </div>

                          <div class="form-group">                               
                              <label class="col-sm-2 col-sm-2 control-label">Semester</label>
                              <div class="col-sm-8">
                                <select name="status" class="form-control semester" id="status">
                                    <option value="" disabled>Select Semester</option>
                                    <?php 
                                        foreach($semester as $st){
                                            echo '<option value='.$st->id.'>'.$st->season_name .' - '.$st->year.'</option>';
                                        }
                                    ?>
                                </select>
                              </div>
                          </div>
                        </fieldset>
                        <input type="submit" class="addSched" name="addSchedule" id="main">
                      </form>
                  </div>
              </div>      
            </div>

<script>
    $(document).ready(function(data){

        $('.addSched').on('click',function(e){
            e.preventDefault();
            e.stopPropagation();
            
            $.ajax({  
                url:"/schedule/add",  
                method:'POST',  
                dataType:'json',
                data:{  
                    semester: $(".semester").val(),
                    class: $(".class").val(),
                    action:"ajax",
                    status:1
                },  
                success:function(data)  
                {  
                    alert("Product has been Added into Cart");
                    $('.class').attr('disabled', true);
                    $('.semester').attr('disabled', true);
                    $('.info').hide();
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