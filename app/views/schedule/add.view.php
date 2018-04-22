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
                                <select name="semester" class="form-control semester" >
                                    <option value="" disabled>Select Semester</option>
                                    <?php 
                                        foreach($semester as $st){
                                            echo '<option value='.$st->id.'>'.$st->season_name .' - '.$st->year.'</option>';
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
                                        foreach($status as $st){
                                            echo '<option value='.$st->id.'>'.$st->code.'</option>';
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

<?php
    require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
   require_once HOME_TEMPLATE_PATH . 'templatefooter.php';