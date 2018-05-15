<?php
    require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
    require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
    require_once HOME_TEMPLATE_PATH . 'header.php';
    require_once HOME_TEMPLATE_PATH . 'nav.php';
    require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';

?>

    <div class="row">
        <div class="col-lg-9 main-chart">
            <h1>Add A Decorator</h1>
            <hr>
		</div>
	</div>	

        <div class="row mt">
              <div class="col-lg-12">
                  <div class="form-panel">
                      <form class="form-horizontal style-form" method="post">
                        
                          <legend>Decorator Info</legend>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Name</label>
                              <div class="col-sm-4">
                              <input type="text" style="width:50%; border-radius: 5%" name="name" required>
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
            if(!empty($grades)){
                foreach ($grades as $g){
                    echo '<tr>
                    <td>'.$g->grade_name.'</td>
                    <td align="center"><input type="number" min="0" name="price[]" class="form-control" placeholder= "Enter Price" required></td>
                    <td align="center"><select name="currency[]" class="form-control" required>
                    <option value="" disabled selected>Select Currency</option>';
                    
                        foreach($currency as $c){
                            echo '<option value='.$c->id.'>'.$c->code .'</option>';
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
                        <input type="submit" name="addfees" id="main">
                      </form>
                  </div>
              </div>      
            </div>

<?php
    require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
    require_once HOME_TEMPLATE_PATH . 'templatefooter.php';