<?php
    require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
    require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
    require_once HOME_TEMPLATE_PATH . 'header.php';
    require_once HOME_TEMPLATE_PATH . 'nav.php';
    require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
    use PHPMVC\Views\CourseView;
    $cv = new CourseView();
?>

    <div class="row">
        <div class="col-lg-9 main-chart">
            <h1> Add A New CourseWork </h1>
            <hr>
		</div>
	</div>	


 <div class="row mt info">
              <div class="col-lg-12">
                  <div class="form-panel">
                      <form class="form-horizontal style-form" method="post" id="insert_form">
                        
                          <legend>Course Work Info</legend>

                         <div class="form-group">                               
                              <label class="col-sm-3 col-sm-3 control-label">Course Work Requirement</label>
                              <div class="col-sm-4">
                                  <input name="coursework" type="text" class="form-control" required>                                    
                              </div>
                        </div>

        <div class="form-group">
        <label class="col-sm-3 col-sm-3 control-label">Select From Existing Attributes</label>
        <div class="col-lg-9">
            <select class="form-control" style="height:100px;" name="attr[]" multiple>
                <option value="" disabled>(Optional)</option>            
                 <?= $cv->preCourseWorkAttr($preAttr); ?>
            </select>
        </div>
    </div>


                        <div class="form-group container" id="dynamic_field"> 

                             <div class="row mt">                            
                                <div class="col-lg-12">
                                  <label class="col-sm-1 col-sm-1 control-label">Label</label>
                                    <div class="col-sm-4">
                                        <input name="name[]" type="text" class="form-control" required>
                                    </div>

                                    <label class="col-sm-1 col-sm-1 control-label">Type</label>
                                    <div class="col-sm-4">
                                        <select name="type[]" id="type" class="form-control" required>
                                            <option value="" disabled>Select Type</option>
                                            <?= $cv->newCourseWorkType("ayhaga"); ?>
                                        </select>
                                    </div>
                              
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-success btn-sm" id="add"> + Add More</button>                              
                                    </div>
                                </div>
                            </div>
                    
                        </div>
                      
                        </fieldset>
                        <input type="submit" name="newcoursework" id="main">
                      </form>
                  </div>
              </div>      
            </div>


<script>  
 $(document).ready(function(){  
    var htmloption = '';
    htmloption += "<?php echo $cv->newCourseWorkType('ayhaga')  ?>";
      var i=1;  

      $('#add').click(function(){  
           
        i++;  
        
         $('#dynamic_field').append('<div class="row mt" id="row'+i+'" > <div class="col-lg-12"> <label class="col-sm-1 col-sm-1 control-label">Label</label><div class="col-sm-4"><input name="name[]" placeholder="Enter Label" type="text" class="form-control" required>  </div>'+
         '<label class="col-sm-1 col-sm-1 control-label">Type</label><div class="col-sm-4">'
         +'<select id="type'+i+'" name="type[]" class="form-control" required>'
         +htmloption+'</select></div>'+
         '<div class="col-sm-2"><button type="button" class="btn btn-danger btn_remove btn-sm" id="'+i+'"> X </button></div></div></div>');
        
        });
                           

      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });

      
 });

 </script>
<?php
    require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
    require_once HOME_TEMPLATE_PATH . 'templatefooter.php';