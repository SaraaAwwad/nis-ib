<?php
    require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
    require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
    require_once HOME_TEMPLATE_PATH . 'header.php';
    require_once HOME_TEMPLATE_PATH . 'nav.php';
    require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
?>

    <div class="row">
        <div class="col-lg-9 main-chart">
            <h1>Edit Semester</h1>
            <hr>
		</div>
	</div>	

        <div class="row mt">
              <div class="col-lg-12">
                  <div class="form-panel">
                      <form class="form-horizontal style-form" method="post">
                        
                          <legend>Semester Info</legend>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Year</label>
                              <div class="col-sm-4">
                              <input type="number" value="<?= $semester->year ?>" style="width:50%; border-radius: 5%" name="year" placeholder="YYYY" min="2017" max="2100" required>
                              </div>

                               <label class="col-sm-2 col-sm-2 control-label">Season</label>
                              <div class="col-sm-4">
                                <select name="season" class="form-control" id="status" required>
                                    <option value="" disabled>Select Season</option>
                                    <?php 
                                        foreach($season as $st){
                                            if($st->id == $semester->season_id_fk){
                                                echo '<option selected value='.$st->id.'>'.$st->season_name.'</option>';
                                            }else{
                                                echo '<option value='.$st->id.'>'.$st->season_name.'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                              </div>
                          </div>

                                                       
                          ` <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Start Date</label>
                              <div class="col-sm-4">
                              <input type="date" value="<?= $semester->start_date; ?>" name="start_date" id="startdate" required>
                              </div>

                               <label class="col-sm-2 col-sm-2 control-label">End Date</label>
                              <div class="col-sm-4">
                              <input type="date" value="<?= $semester->end_date; ?>" id="enddate" onchange="handler(event);" name="end_date" required>
                              </div>
                          </div>

         <div id="sched">
    <table id="tab_sched" class="table table-striped text-center">
        <colgroup>
            <col width="33%">
                <col width="33%">
                    <col width="33%">
        </colgroup>
        <thead>
            <tr class='warning'>
                <th>Grade</th>
                <th>Price</th>              
                <th>Currency</th>              
            </tr>
        </thead>
        <tbody>
        
            <?php
            if(!empty($semester->prices)){
                foreach ($semester->prices as $pr){
                    echo '<tr>
                    <td>'.$pr->grade_name.'</td>
                    <td align="center"><input type="number" min="0" name="price[]" class="form-control" placeholder= "Enter Price" value="'.$pr->price.'" required></td>
                    <td align="center"><select name="currency[]" class="form-control" required>
                    <option value="" disabled >Select Currency</option>';
                    
                        foreach($currency as $c){
                            if($c->id == $pr->currency_id_fk){
                                echo '<option selected value='.$c->id.'>'.$c->code .'</option>';                                
                            }else{
                                echo '<option value='.$c->id.'>'.$c->code .'</option>';

                            }
                        }
                    echo'    </select></td>
                    </tr>';    
                }
            }
            ?>
        
            </tbody>
        </table>
    </div>

                        </fieldset>
                        <input type="submit" name="editsemester" id="main">
                      </form>
                  </div>
              </div>      
            </div>

    <script>
     $(document).ready(function(data){
        $('#main').on('click', function(e){
            //alert()
            var end = $('#enddate').val();
            var start = $('#startdate').val();
            console.log(start);
            console.log(end);
            if(start > end){
                e.preventDefault();
                e.stopPropagation();
            }
           
        });
     });
    </script>
<?php
    require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
    require_once HOME_TEMPLATE_PATH . 'templatefooter.php';