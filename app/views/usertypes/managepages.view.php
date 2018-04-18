<?php
    require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
    require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
    require_once HOME_TEMPLATE_PATH . 'header.php';
    require_once HOME_TEMPLATE_PATH . 'nav.php';
    require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
?>

    <div class="row">
        <div class="col-lg-9 main-chart">
            <h1>Manage Pages</h1>
            <h4><?= $userTypeName ?> Access List: </h4>
            <hr>
        </div>
    </div>

    <div class="row mt">
              <div class="col-lg-12">
                  <div class="form-panel">
                      <form class="form-horizontal style-form" method="post">
                      <div class="form-group">
    
    <?php
            foreach($allPages as $ap){
                //$userPages->id == 
                $found = false;
                foreach($userPages as $up) {
                    if ($ap->id == $up->id) {
                        $found = true;
                        break;
                    }
                }

                echo'
                <div class="col-lg-4">                
                ';
                if ($found){
                    echo '<input type="checkbox" id="cb" name="content[]" value="'.$ap->id.'" checked>';
                }else{
                    echo '<input type="checkbox" id="cb" name="content[]" value="'.$ap->id.'">';
                }
                
                echo'<label for="cb">'.$ap->id.'- '.$ap->friendlyname.'</label>
                </div>';
            }

        ?> 
                     </div>
                     <input type="submit" name="addpermission" id="main">
                    </form>
                </div>
            </div>
        </div>


<?php
    require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
    require_once HOME_TEMPLATE_PATH . 'templatefooter.php';