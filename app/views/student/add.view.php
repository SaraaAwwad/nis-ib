<?php
    require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
    require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
    require_once HOME_TEMPLATE_PATH . 'header.php';
    require_once HOME_TEMPLATE_PATH . 'nav.php';
    require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
?>

    <div class="row">
        <div class="col-lg-9 main-chart">
            <h1>Add A New Student Type</h1>
            <hr>
    </div>
  </div>  

        <div class="row mt">
              <div class="col-lg-12">
                  <div class="form-panel">
                      <form class="form-horizontal style-form" method="post">
                        
                          <legend>Student Info</legend>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">First Name</label>
                              <div class="col-sm-8">
                                  <input name="title" type="text" class="form-control" required>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Last Name</label>
                              <div class="col-sm-8">
                                  <input name="title" type="text" class="form-control" required>
                              </div>
                          </div>

                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Date Of Birth</label>
                              <div class="col-sm-8">
                                  <input id="date" type="date" name="date">
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Gender</label>
                              <div class="col-sm-8">
                            <label class="containerradio">Male
                            <input type="radio" checked="checked" value="M" name="radio">
                            <span class="checkmark"></span>
                            </label>
                            <label class="containerradio" >Female
                            <input type="radio" value="F" name="radio">
                            <span class="checkmark"></span>
                            </label>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Phone Number</label>
                              <div class="col-sm-8">
                                  <input name="title" type="text" class="form-control" required>
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
                              <label class="col-sm-2 col-sm-2 control-label">Status</label>
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

                          <legend>Address Information</legend>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Country</label>
                              <div class="styled-select slate">
                              <select name="country" id="country">
                              <option value="">Select Country</option>
                              <?php
                              foreach($Address as $ad){
                                            echo '<option value='.$ad->id.'>'.$address->.'</option>';
                                        }
                               ?>
                              </select>
                              </div>
                          </div>

                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">City</label>
                              <div class="styled-select slate">
                              <select name="city" id="city" >
                              <option value="">Select City</option>
                              </select>
                          </div>
                          </div>

                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Area</label>
                              <div class="styled-select slate">
                              <select name="area" id="area">
                              <option value="">Select Area</option>
                              </select>
                          </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Street</label>
                              <div class="styled-select slate">
                              <select name="street" id="street">
                              <option value="">Select Street</option>
                              </select>
                          </div>
                          </div>

                        </fieldset>
                        <input type="submit" name="addstudent" id="main">
                      </form>
                  </div>
              </div>      
            </div>
<?php
    require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
    require_once HOME_TEMPLATE_PATH . 'templatefooter.php';