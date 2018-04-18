<?php
    require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
    require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
    require_once HOME_TEMPLATE_PATH . 'header.php';
    require_once HOME_TEMPLATE_PATH . 'nav.php';
    require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
?>                    

                      <form class="form-horizontal style-form" method="post">
                        
                          <legend>Student Info</legend>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">First Name</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="fname" value="<?=$student->fname?>">
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Last Name</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="lname" value="<?=$student->lname;?>">
                              </div>
                          </div>
                          
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Date Of Birth</label>
                              <div class="col-sm-10">
                                  <input id="date" type="date" name="date" value="<?=$student->DOB;?>">
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Phone Number</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="number" value="<?=$student->phone;?>">
                              </div>
                          </div>
                          
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Email</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="email" maxlength="15" value="<?=$student->email;?>">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Password</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="password" maxlength="15" value="<?=$student->password;?>">
                              </div>
                          </div>                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Username</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="username" maxlength="15" value="<?=$student->username;?>">
                              </div>
                          </div>                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Image</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="img" maxlength="15" value="<?=$student->img?>">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Gender</label>
                              <div class="col-sm-10">
                        <?php if($student->gender == "M"){ ?>
                            <label class="containerradio">Male
                            <input type="radio" checked="checked" value="M" name="radio">
                            <span class="checkmark"></span>
                            </label>
                            <label class="containerradio" >Female
                            <input type="radio" value="F" name="radio">
                        <?php }else{ ?>
                            <label class="containerradio">Male
                            <input type="radio"  value="M" name="radio">
                            <span class="checkmark"></span>
                            </label>
                            <label class="containerradio" >Female
                            <input type="radio" checked="checked" value="F" name="radio">
                       <?php } ?>
                            <span class="checkmark"></span>
                            </label>
                              </div>
                          </div>
                        <input type="submit" name="updatestudent" id="main">
                      </form>


<?php                    
require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
require_once HOME_TEMPLATE_PATH . 'templatefooter.php';
?>