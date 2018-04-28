<?php
    require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
    require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
    require_once HOME_TEMPLATE_PATH . 'header.php';
    require_once HOME_TEMPLATE_PATH . 'nav.php';

?>       
      <script src="../../../public/js/user.js"></script>
      <section id="container" >
      <section id="main-content">
          <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> Add New Course</h3>
            
            <div class="row mt">
              <div class="col-lg-12">
                <div class="form-panel">
                <form class="form-horizontal style-form" method="post">
                <fieldset>
                <legend>Course Information</legend>
                    <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Course Name</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="coursename" required>
                    </div>
            </div>
                          
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Course Code</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control" name="coursecode" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Description</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="description" required>
                    </div>
                </div>

                <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Level</label>
                <div class="col-sm-8">
                <?php for($i=0; $i<count($Levels); $i++){ ?>
                <label class="containerradio"><?php echo $Levels[$i]->level; ?>
                <input type="radio" checked="checked" value ="<?php echo $Levels[$i]->id; ?>" name="level">
                <span class="checkmark"></span>
                </label>
                <?php } ?>
                </div>
                </div>

                <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Group</label>
                <div class="col-sm-8">
                <?php for($i=0; $i<count($group); $i++){ ?>
                <label class="containerradio"><?php echo $group[$i]->group_name; ?>
                <input type="radio" checked="checked" value ="<?php echo $group[$i]->id; ?>" name="group">
                <span class="checkmark"></span>
                </label>
                <?php } ?>
                </div>
                </div>   

                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Status</label>
                  <div class="col-sm-10">
                  <?php foreach($status as $status){ ?>
                  <label class="containerradio"><?php echo $status->code; ?>
                  <input type="radio" checked="checked" value="<?php echo $status->id; ?>" name="status">
                  <span class="checkmark"></span>
                  </label>
                  <?php } ?>
                </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Teaching Hours</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="teaching" required>
                    </div>
                </div>
                      
                </div>

                </fieldset>
                
                          <input type="submit" name="addcourse" id="main">
                      </form>
                  </div>
              </div>     
            </div>
    </section>
    </section>
  </section>
                <?php
                require_once HOME_TEMPLATE_PATH . 'templatefooter.php'; ?>

