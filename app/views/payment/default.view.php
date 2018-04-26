<?php
use PHPMVC\Views\ScheduleView;
require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
require_once HOME_TEMPLATE_PATH . 'header.php';
require_once HOME_TEMPLATE_PATH . 'nav.php';
require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
$schedView = new ScheduleView();
$schedView->schedulePDF();
?>
    <div class="row">
        <div class="col-lg-9 main-chart">
            <h1>Your Children</h1>
        </div>
    </div>

    <section class="tabcontent">
        <table class="order-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <?php
                if(!empty($schedule)){
                    foreach ($schedule as $s){
                        echo '<tr>
                    <td>'.$s->id.'</td>
                    <td>'.$s->name.'</td>
                    <td>'.$s->season_name .' - '. $s->year.'</td>
                    <td>'.$s->code.'</td>
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