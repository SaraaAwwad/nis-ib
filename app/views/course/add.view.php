<?php
    require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
    require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
    require_once HOME_TEMPLATE_PATH . 'header.php';
    require_once HOME_TEMPLATE_PATH . 'nav.php';

?>
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
                    <input type="text" class="form-control" name="name" required>
                    </div>
            </div>
                          
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Course Code</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control" name="code" required>
                    </div>
                </div>

                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Description</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="description" rows="7" cols="10" required></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Grade</label>
                        <div class="styled-select slate">
                            <select name="grade" id="grade" required>
                                <option value="" selected="selected" disabled="disabled">Select Grade</option>
                                <?php foreach($grade as $gr){ ?>
                                    <option value="<?php echo $gr->id; ?>"><?php echo $gr->grade_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Status</label>
                        <div class="styled-select slate">
                            <select name="status" id="status" required>
                                <option value="" selected="selected" disabled="disabled">Select Status</option>
                                <?php foreach($status as $st){ ?>
                                    <option value="<?php echo $st->id; ?>"><?php echo $st->code; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                </div>
                </fieldset>
                          <input type="submit" name="addCourse" id="main">
                      </form>
                  </div>
              </div>     
            </div>
    </section>
    </section>
  </section>
                <?php
                require_once HOME_TEMPLATE_PATH . 'templatefooter.php'; ?>

