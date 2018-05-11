<?php
require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
require_once HOME_TEMPLATE_PATH . 'header.php';
require_once HOME_TEMPLATE_PATH . 'nav.php';
require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
?>

        <div class="col-lg-9 main-chart">
            <h3><i class="fa fa-angle-right"></i> Payment Status</h3>
        </div>


    <div class="row mt">
        <div class="col-lg-12">
            <div class="form-panel">
                <form class="form-horizontal style-form" method="post">
                    <legend></legend>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Name: </label>
                        <div class="col-sm-6">
                            <input name="title" type="text" class="form-control" value="<?php echo $payment->studentObj->fname .' '. $payment->studentObj->lname ?>"  disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Status</label>
                        <div class="col-sm-8">
                            <select name="statusid" class="form-control" id="status">
                                <option value="" disabled>Select Status</option>
                                <?php
                                foreach($status as $st){
                                    if($st->id == $payment->status_id_fk){
                                        echo '<option selected value='.$st->id.'>'.$st->code.'</option>';
                                    }else{
                                        echo '<option value='.$st->id.' >'.$st->code.'</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    </fieldset>
                    <input type="submit" name="updatepaymentstatus" id="main">
                </form>
            </div>
        </div>
    </div>



<?php
require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
require_once HOME_TEMPLATE_PATH . 'templatefooter.php';
?>