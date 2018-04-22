<?php
    require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
    require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
    require_once HOME_TEMPLATE_PATH . 'header.php';
    require_once HOME_TEMPLATE_PATH . 'nav.php';
    require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
?>

    <div class="row">
        <div class="col-lg-9 main-chart">
            <h1>Add A New Class</h1>
            <hr>
		</div>
	</div>	

        <div class="row mt">
        <div class="col-lg-12">
        <div class="form-panel">
        <form class="form-horizontal style-form" method="post">
                        
        <legend>Course Info</legend>
        <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label">Course Name</label>
        <div class="col-sm-8">
        <input name="name" type="text" class="form-control" required>
        </div>
        </div>

        <div class="form-group">                               
        <label class="col-sm-2 col-sm-2 control-label">Course Code</label>
        <div class="col-sm-8">
        <select name="status" class="form-control" id="status">
        <option value="" disabled>Select Status</option>
        <?php 
        foreach($status as $st){
        echo '<option value='.$st->id.'>'.$st->code.'</option>';
                      }
                  ?>
              </select>
            </div>
        </div>

        <div class="form-group">                               
        <label class="col-sm-2 col-sm-2 control-label">Grade</label>
        <div class="col-sm-8">
        <select name="grade" class="form-control">
        <option value="" disabled>Select Grade</option>
        <?php 
        foreach($grade as $g){
        echo '<option value='.$g->id.'>'.$g->grade_name.'</option>';
         }
          ?>
        </select>
        </div>
        </div>

        </fieldset>
        <input type="submit" name="addclass" id="main">
        </form>
        </div>
              </div>      
            </div>
<?php
    require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
    require_once HOME_TEMPLATE_PATH . 'templatefooter.php';