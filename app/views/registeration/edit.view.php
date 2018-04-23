<?php
require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
require_once HOME_TEMPLATE_PATH . 'header.php';
require_once HOME_TEMPLATE_PATH . 'nav.php';
require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
?>
    <div class="row">
        <div class="col-lg-9 main-chart">
            <h3>Edit Registeration</h3>
        </div>
    </div>
    <div class="row mt">
    <div class="col-lg-12">
    <div class="form-panel">

    <form class="form-horizontal style-form" method="post">

        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Student ID</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="st_id" value="<?=$regist->student_id?>">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Class ID</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="cl_id" value="<?=$regist->class_id;?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Semester ID</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="sem_id" value="<?=$regist->Semester_id_fk;?>">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">datetime</label>
            <div class="col-sm-10">
                <input id="date" type="date" name="dt" value="<?=$regist->datetime;?>">
            </div>
        </div>

        <input type="submit" name="updateReg" id="main">
    </form>


<?php
require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
require_once HOME_TEMPLATE_PATH . 'templatefooter.php';
?>