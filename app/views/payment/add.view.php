<?php
require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
require_once HOME_TEMPLATE_PATH . 'header.php';
require_once HOME_TEMPLATE_PATH . 'nav.php';
require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
?>


    <div class="row mt">
        <div class="col-lg-12">
            <div class="form-panel">
                <form class="form-horizontal style-form " method="post">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-9">
                                <div class="invoice-title">
                                    <h2>Invoice</h2>
                                </div>
                                <hr>

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label"><strong>Payment Method</strong></label>
                                    <div class="col-sm-8">
                                        <select name="method" class="form-control selectMethod" id="method">
                                            <option value="" disabled>Select Method</option>
                                            <?php
                                            foreach($methods as $meth){
                                                echo '<option value='.$meth->id.'>'.$meth->method.'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <fieldset id="attributesform" style="display:none;">
                                    <div class="container" style="margin-top:20px;">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <h5><strong>details</strong></h5>
                                                <div class="PaymentAttributes" style="max-height: 300px;overflow: auto;">

                                                </div>
                                            </div>
                                </fieldset>


                                <div class="row">
                                    <div class="col-sm-4 col-md-4">
                                            <address>
                                            <strong>Student Name:</strong><br>
                                            <?php echo $st->fname ." ".  $st->lname ?><br>
                                            </address>
                                    </div>

                                    <div class="col-sm-4 col-md-4">
                                        </address>
                                        <strong>Grade:</strong><br>
                                        <?php echo $st->gradeObj->grade_name ?><br>
                                        </address>
                                    </div>

                                        <div class="col-sm-4 col-md-4">
                                            </address>
                                                    <strong>Payment Date:</strong><br>
                                                <?php echo date("d-m-Y") ?><br>
                                            </address>
                                    </div>
                                </div>

                        <div class="row">
                            <div class="col-md-9">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><strong>Preview</strong></h3>
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
                                                <tbody>

                                                <?php
                                                foreach($decorator as $dec){
                                                    echo '<tr>
                                                    <td><input type="checkbox"  name="myCheck[]" value="'.$dec->id.'"> '. $dec->decoratorObj->name.'</td>
                                                    <td class="text-center checkprice" value="'.$dec->id.'">'.$dec->price.'</td>

                                                </tr>';
                                                }
                                                ?>
                                                <tr>
                                                    <td class="no-line text-center"><strong>Total</strong></td>
                                                    <td class="text-center" id="tdTotal"></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <input type="submit" name="addPayment" id="main">
                </form>
            </div>
        </div>
    </div>


    <script>

        $(".myCheck").on('change',function () {
            //var checked = [];
            var prices = [];
            $(".myCheck").map(function() {
                if( this.checked ) {
                   // checked.push(this.id);
                    var currentRow=$(this).closest("tr");
                    var col=currentRow.find("td:eq(1)").html();
                    prices.push(parseInt(col));
                }
            });

            var total=0;
            for(var i in prices){
                total +=  prices[i];
            }
            document.getElementById('tdTotal').innerHTML = total;
        });

    </script>
<?php
require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
require_once HOME_TEMPLATE_PATH . 'templatefooter.php';
?>