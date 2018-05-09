<?php
require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
require_once HOME_TEMPLATE_PATH . 'header.php';
require_once HOME_TEMPLATE_PATH . 'nav.php';
require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';

use PHPMVC\Views\SemesterView;
$sm = new SemesterView();
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
                                    <label class="col-sm-1 col-sm-1 control-label"><strong>Payment Method</strong></label>
                                    <div class="col-sm-5">
                                        <select name="method" class="form-control selectMethod" id="method" required>
                                            <option value="" disabled selected="selected">Select Method</option>
                                            <?php
                                            foreach($methods as $meth){
                                                echo '<option value='.$meth->id.'>'.$meth->method.'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <label class="col-sm-1 col-sm-1 control-label"><strong>Semester</strong></label>
                                    <div class="col-sm-5"> <!-- change it to non registered semesters -->
                                    <?= $sm->getAllSemester($semester); ?>
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
                                        <?php  echo $st->gradeObj->grade_name ?><br>
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
                                
                                                <tr>
                                                <td><input type="hidden"  name="concrete" value="" id="semlabel"/> <input type="checkbox"  class="myCheck" name="concrete"  disabled="disabled" checked="checked">Semester</td>
                                                <td class="text-center checkprice" id="semprice"></td>
                                                </tr>
                                
                                                <?php
                                                foreach($decorator as $dec){
                                                    echo '<tr>
                                                    <td><input type="checkbox"  class="myCheck" name="myCheck[]" value="'.$dec->id.'"> '. $dec->decoratorObj->name.'</td>
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
    var pathname = window.location.pathname;
    $(".table1").hide();
        $(".myCheck").on('change',function () {
            //var checked = [];
           updatetotal();
        });

        $(".semester").on('change', function(){
            var sem = $(this).val();

            $.ajax({  
                url:pathname,  
                method:'POST',  
                dataType:'json',
                data:{  
                    semester: sem,
                    action:"getSemesterPrice"
                },  
                success:function(data)  
                { 
                    alert(data.sid); 

                    $('#semprice').html(data.price);
                    $('#semlabel').val(data.sid);
                    $(".table1").show();
                    updatetotal();

                  /*$('#days').html('');
                  $('#days').append($('<option>', { 
                            text : "Select Day",
                            selected: true,
                            disabled: true,
                            value: ""
                        }));
                  $.each(data, function (i, data) {
                        $('#days').append($('<option>', { 
                            value: data.id,
                            text : data.day, 
                        }));
                    });*/
                
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

        function updatetotal(){
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
        }
    </script>
<?php
require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
require_once HOME_TEMPLATE_PATH . 'templatefooter.php';
?>