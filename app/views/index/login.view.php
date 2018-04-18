
<?php
require_once TEMPLATE_PATH . 'templateheaderstart.php';
require_once TEMPLATE_PATH . 'templateheaderend.php';
              //  require_once TEMPLATE_PATH . 'wrapperstart.php';
require_once TEMPLATE_PATH . 'header.php';
              //  require_once TEMPLATE_PATH . 'nav.php';
?>
              <div class="login">
              <div class="container">
                  <div class="row justify-content-center">
                      <div class="col-md-6">
                         <div id="login-overlay" class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="well">
                                                <form id="loginForm" method="POST" action="" novalidate="novalidate">
                                                    <div class="form-group">
                                                        <label for="username" class="control-label">Username</label>
                                                        <input type="text" class="form-control" id="username" name="username" value="" required title="Please enter you username" placeholder="example@gmail.com">
                                                        
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password" class="control-label">Password</label>
                                                        <input type="password" class="form-control" id="password" name="password" value="" required title="Please enter your password">
                                                    </div>                                   
                                                    <button type="submit" class="btn btn-warning" id="js-subscribe-btn" name="loginbtn">LOG IN</button>                                          </form>
                                                </div>
                                            </div>
          
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php
                //require_once TEMPLATE_PATH . 'wrapperend.php';
require_once TEMPLATE_PATH . 'templatefooter.php';