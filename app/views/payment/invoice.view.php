<?php
require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
require_once HOME_TEMPLATE_PATH . 'header.php';
require_once HOME_TEMPLATE_PATH . 'nav.php';
require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
?>

    <div class="col-lg-9 main-chart">
        <button class = "btn btn-success left glyphicon glyphicon-arrow-left"></button>

        <h3><i class="fa fa-angle-right"></i>Invoice details</h3>
    </div>

    <div class="row mt">
        <div class="col-lg-12">
            <div class="form-panel">
                <form class="form-horizontal style-form" method="post">
                    <legend></legend>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Student Info</strong></h3>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <address>
                                            <strong>Name:</strong><br>
                                            <?php echo $child->fname ." ".  $child->lname ?><br>
                                        </address>
                                        </address>
                                        <strong>Grade:</strong><br>
                                        <?php  echo $child->gradeObj->grade_name ?><br>
                                        </address>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Parent Info</strong></h3>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <address>
                                            <strong>Name:</strong><br>
                                            <?php echo $parent->fname ." ".  $parent->lname ?><br>
                                        </address>
                                        </address>
                                        <strong>Phone:</strong><br>
                                        <?php  echo $parent->phone ?><br>
                                        </address>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-8">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <?php
                                    if($payment->status_id_fk == $pending) {
                                        echo '<h3 class="panel-title"><strong>Payment Method</strong><label class= "label label-warning label-mini">'
                                            . $payment->status_val.'</label></h3>';
                                    }else{
                                        echo '<h3 class="panel-title"><strong>Payment Method </strong>
                                             <label class= "label label-info label-mini">'. $payment->status_val.
                                            '</label></h3>';
                                    }

                                    ?>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <?php
                                        foreach($methods as $meth){
                                            echo  '<address><strong>'.$meth->attr_name.':</strong> '.$meth->value.'<br>
                                        </address>';
                                        }
                                            ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="col-md-8">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><strong>Invoice</strong></h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-condensed table1">
                                                <thead>
                                                <tr>
                                                    <td><strong>Description</strong></td>
                                                    <td class="text-center"><strong>Price</strong></td>
                                                </tr>
                                                </thead>

                                                <tr>
                                                    <td><input type="hidden"  name="concrete" value="" id="semlabel"/>
                                                        Semester</td>
                                                    <td class="text-center checkprice" id="semprice"><?php echo $semesterPrice->price ?> </td>
                                                </tr>

                                                <?php
                                                foreach($details as $det){
                                                    echo '<tr>
                                                    <td>'. $det->decoratorObj->name.'</td>
                                                    <td class="text-center" value="'.$det->id.'">'.$det->amount.'</td>
                                                </tr>';
                                                }
                                                ?>
                                                <tr>
                                                    <td class="no-line text-center"><strong>Total</strong></td>
                                                    <td class="text-center" id="tdTotal">
                                                        <b><?php echo $payment->amount ?></b></td>
                                                </tr>
                                                <tr>
                                                    <td class="no-line text-center"><strong>Currency</strong></td>
                                                    <td class="text-center" id="tdTotal">
                                                        <b><?php echo $payment->currency_val ?></b></td>
                                                </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>

<script>


</script>

<?php
require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
require_once HOME_TEMPLATE_PATH . 'templatefooter.php';
?>