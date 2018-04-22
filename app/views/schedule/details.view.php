<?php
    require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
    require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
    require_once HOME_TEMPLATE_PATH . 'header.php';
    require_once HOME_TEMPLATE_PATH . 'nav.php';
    require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
?>
    <div class="row">
        <div class="col-lg-9 main-chart">
            <h1>Add Schedule Details</h1>
            <hr>
		</div>
	</div>	

        <div class="row mt info">
              <div class="col-lg-12">
                  <div class="form-panel">
                      <form class="form-horizontal style-form" method="post">
                        
                          <legend>Schedule Info</legend>

                         <div class="form-group">                               
                              <label class="col-sm-2 col-sm-2 control-label">Course</label>
                              <div class="col-sm-4">
                                <select name="courses" class="form-control class" required>
                                    <option value="" disabled>Select Course</option>
                                    <?php 
                                        foreach($courses as $c){
                                            echo '<option value='.$c->id.'>'.$c->name.'</option>';
                                        }
                                    ?>
                                </select>
                              </div>

                           <label class="col-sm-2 col-sm-2 control-label">Day</label>
                              <div class="col-sm-4">
                                <select name="day" class="form-control semester" required>
                                    <option value="" disabled>Select Day</option>
                                    <?php 
                                        foreach($days as $d){
                                            echo '<option value='.$d->id.'>'.$d->day .'</option>';
                                        }
                                    ?>
                                </select>
                              </div>

                        </div>


                        <div class="form-group">                               
                              <label class="col-sm-2 col-sm-2 control-label">Slot</label>
                              <div class="col-sm-4">
                                <select name="slot" class="form-control semester" required>
                                    <option value="" disabled>Select Slot</option>
                                    <?php 
                                        foreach($slots as $st){
                                            echo '<option value='.$st->id.'>'.$st->slot_name .'</option>';
                                        }
                                    ?>
                                </select>
                              </div>
                              
                              <label class="col-sm-2 col-sm-2 control-label">Room</label>
                              <div class="col-sm-4">
                                <select name="room" class="form-control semester" required>
                                    <option value="" disabled>Select Room</option>
                                    <?php 
                                        foreach($rooms as $r){
                                            echo '<option value='.$r->id.'>'.$r->room_name .'</option>';
                                        }
                                    ?>
                                </select>
                              </div>
                              
                          </div>

                            <div class="form-group">                               
                            <label class="col-sm-2 control-label">Teacher</label>
                              <div class="col-sm-4">
                                <select name="teacher" class="form-control semester" required>
                                    <option value="" disabled>Select Teacher</option>
                                    <?php 
                                        foreach($teacher as $t){
                                            echo '<option value='.$t->id.'>'.$t->fname .', '. $t->lname .'</option>';
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

  <section class="tabcontent">
    <table class="order-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Course</th>
          <th>Slot</th>
          <th>Day</th>                              
          <th>Teacher</th>                              
          <th>Room</th>                              
        </tr>
      </thead>
      <tbody>
        <tr>
            <?php
            if(!empty($details)){
                foreach ($details as $s){
                    echo '<tr>
                    <td>'.$s->id.'</td>
                    <td>'.$s->course_code.'</td>
                    <td>'.$s->slot_name.'</td>
                    <td>'.$s->day.'</td>                    
                    <td>'.$s->fname .' - '. $s->lname.'</td>
                    <td>'.$s->room_name.'</td>
                    <td> <a href="\schedule\edit\\'.$s->id.'">Edit ,  </a>
                     <a href="\schedule\details\\'.$s->id.'">View Details </a></td>
                    </tr>';    
                }
            }
            ?>
        </tr>
        </tbody>
    </table>
  </section>	

<?php
    require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
    require_once HOME_TEMPLATE_PATH . 'templatefooter.php';