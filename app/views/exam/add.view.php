<?php
    require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
    require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
    require_once HOME_TEMPLATE_PATH . 'header.php';
    require_once HOME_TEMPLATE_PATH . 'nav.php';
    require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
?>

    <div class="row">
        <div class="col-lg-9 main-chart">
            <h1>Add A New Exam</h1>
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
                              <div class="col-sm-8">
                                <select name="gradename" class="form-control class">
                                    <option value="" disabled>Select Grade</option>
                                    <?php 
                                        foreach($grade as $gradename){
                                            echo '<option value='.$gradename->id.'>'.$gradename->grade_name.'</option>';
                                        }
                                    ?>
                                </select>
                              </div>
                          </div>

                          <div class="form-group">                               
                              <label class="col-sm-2 col-sm-2 control-label">Semester</label>
                              <div class="col-sm-8">
                                <select name="semester" class="form-control semester" >
                                    <option value="" disabled>Select Semester</option>
                                    <?php 
                                        foreach($semester as $stmt){
                                            echo '<option value='.$stmt->id.'>'.$stmt->season_name .' - '.$stmt->year.'</option>';
                                        }
                                    ?>
                                </select>
                              </div>
                          </div>

                          <div class="form-group">                               
                              <label class="col-sm-2 col-sm-2 control-label">Status</label>
                              <div class="col-sm-8">
                                <select name="status" class="form-control semester" >
                                    <option value="" disabled>Select Status</option>
                                    <?php 
                                        foreach($status as $stat){
                                            echo '<option value='.$stat->id.'>'.$stat->code.'</option>';
                                        }
                                    ?>
                                </select>
                              </div>
                          </div>
                        
                        </fieldset>
                          <input type="submit" name="addExam" id="main">
                          <a href="/exam/default" id="cancel">Cancel</a>
                      </form>
                  </div>
              </div>      
            </div> 

<?php
    require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
   require_once HOME_TEMPLATE_PATH . 'templatefooter.php';