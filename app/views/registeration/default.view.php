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
                <th>Student id</th>
                <th>Class id</th>
                <th>Datetime</th>
                <th>Semester id</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <?php
                foreach ($details as $reg){
                    echo '<tr>
                    <td>'.$reg->id.'</td>
                    <td>'.$reg->student_id.'</td>
                    <td>'.$reg->class_id.'</td>
                    <td>'.$reg->datetime.'</td>
                    <td>'.$reg->Semester_id_fk.'</td>
                    <td  colspan="2">
                    <a class="btn btn-success btn-xs" href="registeration\edit\\'.$reg->id.'"><i class="fa fa-pencil-square-o"></i></a>
                    </td>
                    </tr>';
                }
                ?>
            </tr>
            </tbody>
        </table>
    </section>




<?php
require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
require_once HOME_TEMPLATE_PATH . 'templatefooter.php';
