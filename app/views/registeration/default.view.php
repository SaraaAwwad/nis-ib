<?php
require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
require_once HOME_TEMPLATE_PATH . 'header.php';
require_once HOME_TEMPLATE_PATH . 'nav.php';
require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
?>
    <div class="row">
        <div class="col-lg-9 main-chart">
            <h1>Registeration</h1>
        </div>
    </div>

    <section class="tabcontent">
        <div class="row">
            <div class="col-lg-12 main-chart">
                <a class="buttonlink btn btn-theme04 left" href="/registeration/add"><i class="fa fa-plus"></i>Register</a>
            </div>
        </div>
    </section>

    <section class="tabcontent">
        <table class="order-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Student</th>
                <th>Class</th>
                <th>Semester</th>
                <th>Datetime</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <?php
                if(!empty($details)){
                foreach ($details as $reg){
                    echo '<tr>
                    <td>'.$reg->id.'</td>
                    <td>'.$reg->fname .' - '. $reg->lname.'</td>
                    <td>'.$reg->name.'</td>
                    <td>'.$reg->season_name .' - '. $reg->year .'</td>                    
                    <td>'.$reg->datetime.'</td>
                    
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
