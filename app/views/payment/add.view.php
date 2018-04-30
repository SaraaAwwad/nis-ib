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
<!--                                    <h4 class="pull-right">payment ID # 12345</h4>-->
                                    <div class="col-sm-4 col-md-4">
                                        <address>
                                            <strong>Billed To:</strong><br>
                                            John Smith<br>
                                            1234 Main<br>
                                            Apt. 4B<br>
                                            Springfield, ST 54321
                                        </address>
                                    </div>

                                    <div class="col-sm-4 col-md-4">
                                        <address>
                                            <strong>Payment Method:</strong><br>
                                            Visa ending **** 4242<br>
                                            jsmith@email.com
                                        </address>
                                    </div>

                                        <div class="col-sm-4 col-md-4">
                                            <address>
                                                    <strong>Payment Date:</strong><br>
                                                March 7, 2014<br><br>
                                            </address>
                                    </div>
                                </div>

                        <div class="row">
                            <div class="col-md-9">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><strong>summary</strong></h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-condensed">
                                                <thead>
                                                <tr>
                                                    <td><strong>Description</strong></td>
                                                    <td class="text-center"><strong>Price</strong></td>
                                                    <td class="text-right"><strong>Totals</strong></td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                                <tr>
                                                    <td>Year fees</td>
                                                    <td class="text-center">$10.99</td>
                                                    <td class="text-right">$10.99</td>
                                                </tr>
                                                <tr>
                                                    <td>Bus</td>
                                                    <td class="text-center">$20.00</td>
                                                    <td class="text-right">$60.00</td>
                                                </tr>
                                                <tr>
                                                    <td>Books</td>
                                                    <td class="text-center">$600.00</td>
                                                    <td class="text-right">$600.00</td>
                                                </tr>
                                                <tr>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                                    <td class="thick-line text-right">$670.99</td>
                                                </tr>
                                                <tr>
                                                    <td class="no-line"></td>
                                                    <td class="no-line text-center"><strong>Annual increase</strong></td>
                                                    <td class="no-line text-right">$15</td>
                                                </tr>
                                                <tr>
                                                    <td class="no-line"></td>
                                                    <td class="no-line text-center"><strong>Total</strong></td>
                                                    <td class="no-line text-right">$685.99</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <input type="submit" name="addusertype" id="main">
                </form>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function(data){

            $('.selectMethod').on('change',function(e){
                e.preventDefault();
                e.stopPropagation();

                $.ajax({
                    url:"/payment/add",
                    method:'POST',
                    dataType:'json',
                    data:{
                        methodd: $('#method').val(),
                        action:"getAttributes"
                    },
                    success:function(data)
                    {   alert("hii");
                        attributesArr = data.attributesArr;


                        $('.PaymentAttributes').append($('<option>', {
                            text : "Select Class",
                            selected: true,
                            disabled: true,
                            value: ""
                        }));

                        $.each(classes, function (i, classes) {
                            $('#class').append($('<option>', {
                                value: classes.id,
                                text : classes.name
                            }));
                        });


                        $('.PaymentAttributes').html('');
                        $.each(SelectedAttr, function (i, SelectedAttr) {
                            $inputDiv = '<div class="form-group">'+
                                        '<label class="col-sm-2 col-sm-2 control-label">'.Attributes->attrname.'</label>'+
                                        '<div class="col-sm-8">'+
                                        '<input name="'.SelectedAttr->id.''" type="text" class="form-control" required>'+
                                        '</div></div>';
                            $('.PaymentAttributes').append($inputDiv);
                            $(".PaymentAttributes").show();

                    },

                    error: function (jqXHR, exception) {
                        var msg = '';
                        if (jqXHR.status === 0) {
                            msg = 'Not connect.\n Verify Network.';
                        } else if (jqXHR.status == 404) {
                            msg = 'Requested page not found. [404]';
                        } else if (jqXHR.status == 500) {
                            msg = 'Internal Server Error [500].';
                        } else if (exception === 'parsererror') {
                            msg = 'Requested JSON parse failed.';
                        } else if (exception === 'timeout') {
                            msg = 'Time out error.';
                        } else if (exception === 'abort') {
                            msg = 'Ajax request aborted.';
                        } else {
                            msg = 'Uncaught Error.\n' + jqXHR.responseText;
                        }
                        alert(msg);
                    },
                });
            });

        });

    </script>
<?php
require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
require_once HOME_TEMPLATE_PATH . 'templatefooter.php';
?>