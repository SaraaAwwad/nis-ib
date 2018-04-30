<?php
use PHPMVC\Views\ScheduleView;
require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
require_once HOME_TEMPLATE_PATH . 'header.php';
require_once HOME_TEMPLATE_PATH . 'nav.php';
require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
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

                <th>Name</th>
                <th>Grade</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <?php
                if(!empty($children)){
                    foreach ($children as $c){
                        echo '<tr>
                    <td>'.$c->fname . ' ' . $c->lname.'</td>
                    <td>'.$c->gradeObj->grade_name .'</td>
                    <td> <a href="\payment\add\\'.$c->id.'">View</a></td>
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