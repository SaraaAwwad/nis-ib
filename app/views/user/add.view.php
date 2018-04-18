
<?php

function randomPassword() {
    $alphabet = "0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}



                require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
                require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
                require_once HOME_TEMPLATE_PATH . 'header.php';
                require_once HOME_TEMPLATE_PATH . 'nav.php';

?>  
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>      
      <script src="../../../public/js/user.js">
      </script>
      <section id="container" >
      <section id="main-content">
          <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> Add To Staff</h3>
            
            <!-- BASIC FORM ELELEMNTS -->
            <div class="row mt">
              <div class="col-lg-12">
                  <div class="form-panel">
                      <form class="form-horizontal style-form" method="post">
                        <fieldset>
                          <legend>Personal Information</legend>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">First Name</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="fnameinput">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Last Name</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="lnameinput">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Phone Number</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="numberinput">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Date Of Birth</label>
                              <div class="col-sm-10">
                                  <input id="date" type="date" name="dateinput">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Gender</label>
                              <div class="col-sm-10">
                            <label class="containerradio">Male
                            <input type="radio" checked="checked" value="M" name="radioinput">
                            <span class="checkmark"></span>
                            </label>
                            <label class="containerradio" >Female
                            <input type="radio" value="F" name="radioinput">
                            <span class="checkmark"></span>
                            </label>
                              </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Status</label>
                            <div class="col-sm-10">
                            <label class="containerradio">
                            <input type="radio" checked="checked" value="" name="statusinput">
                            <span class="checkmark"></span>
                            </label>
                          </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Profession</label>
                              <div class="styled-select slate">
                              <select name="professioninput">
                              <option>Select Profession</option>
                              <option></option>
                              </select>
                          </div>
                          </div>
                          </fieldset>
                          <fieldset>
                          <legend>Address Information</legend>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Country</label>
                              <div class="styled-select slate">
                              <select name="country" id="country">
                              <option value="">Select Country</option>
                              <?php foreach($country as $count){ ?>
                              <option value="<?php echo $count->id; ?>"><?php echo $count->address; ?></option>
                              <?php } ?>
                              </select>
                              </div>
                          </div>
                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">City</label>
                              <div class="styled-select slate">
                              <select name="city" id="city">
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
                          <fieldset>
                          <legend>Account Information</legend>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Email</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="emailinput" maxlength="15">@nis.edu.eg
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Password</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="passwordinput" value="<?php echo randomPassword(); ?>">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Username</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="usernameinput">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Image</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="imageinput">
                              </div>
                          </div>
                          <legend>Salary Information</legend>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Salary</label>
                              <div class="col-sm-10">
                                  <input type="number" class="form-control" name="salaryinput">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Currency</label>
                              <div class="styled-select slate">
                              <select name="currencyinput">
                              <option value=""></option>
                              </select>
                          </div>
                          </div>
                        </fieldset>
                          <input type="submit" name="submit" id="main">
                      </form>
                  </div>
              </div><!-- col-lg-12-->       
            </div><!-- /row -->
    </section><!--/wrapper -->
    </section><!-- /MAIN CONTENT -->
  </section>
                <?php
                //require_once TEMPLATE_PATH . 'wrapperend.php';
                require_once HOME_TEMPLATE_PATH . 'templatefooter.php';

