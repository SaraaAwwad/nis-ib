<?php
    require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
    require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
    require_once HOME_TEMPLATE_PATH . 'header.php';
    require_once HOME_TEMPLATE_PATH . 'nav.php';
    require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
?>

    <div class="row">
        <div class="col-lg-9 main-chart">
            <h1>Add A Room</h1>
            <hr>
		</div>
	</div>	

        <div class="row mt">
              <div class="col-lg-12">
                  <div class="form-panel">
                      <form class="form-horizontal style-form" method="post">
                        
                          <legend>Room Info</legend>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Room Name</label>
                              <div class="col-sm-4">
                              <input type="text" name="room" placeholder="room name" class="form-control"  required>
                              </div>

                          
                               <label class="col-sm-2 col-sm-2 control-label">Capacity</label>
                              <div class="col-sm-4">
                              <input type="number" style="width:50%; height:35px; border-radius: 5%" name="size" placeholder="Capacity" min="1" max="4000" required>
                            </div>
                          </div>


                        </fieldset>
                        <input type="submit" name="addroom" id="main">
                      </form>
                  </div>
              </div>      
            </div>
<?php
    require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
    require_once HOME_TEMPLATE_PATH . 'templatefooter.php';