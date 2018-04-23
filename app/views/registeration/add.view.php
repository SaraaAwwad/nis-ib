<?php
function randomPassword() {
    $alphabet = "0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
require_once HOME_TEMPLATE_PATH . 'header.php';
require_once HOME_TEMPLATE_PATH . 'nav.php';
require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
?>

    <script src="../../../public/js/user.js"></script>
    <div class="row">
        <div class="col-lg-9 main-chart">
            <h1>Registeration</h1>
        </div>
    </div>

    <div class="row mt">
        <div class="col-lg-12">
            <div class="form-panel">
                <form class="form-horizontal style-form" method="post">

                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Grade</label>
                        <div class="col-sm-8">
                            <select name="grade" class="form-control addGrade" id="grade">
                                <option value="" disabled>Select Grade</option>
                                <?php foreach($grade as $grad){ ?>
                                    <option value="<?php echo $grad->id; ?>"><?php echo $grad->grade_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Classes</label>
                        <div class="col-sm-8">
                            <select name="class" class="form-control addClass" id="class">
                                <option value="" disabled>Select Class</option>

                            </select>
                        </div>
                    </div>


                    <fieldset id="studentform" style="display:none;">
                    <div class="container" style="margin-top:20px;">
                        <div class="row">
                            <div class="col-xs-6">
                                <h5>Students</h5>
                                <div class="students" style="max-height: 300px;overflow: auto;">

                                </div>
                            </div>
                    </fieldset>




                    <input type="submit" name="addReg" id="main">
                </form>
            </div>
        </div>
    </div>

    <script>

        $("#grade").change(function () {
            document.getElementById("studentform").style.display="block";
        });
        $(document).ready(function(data){

            $('.addGrade').on('change',function(e){
                e.preventDefault();
                e.stopPropagation();

                $.ajax({
                    url:"/registeration/add",
                    method:'POST',
                    dataType:'json',
                    data:{
                        grade: $("#grade").val(),
                        class: $("#class").val(),
                        action:"getStudents"

                    },
                    success:function(data)
                    {
                        $('.students').html('');
                        $.each(data, function (i, data) {

                            $('.students').append($('<tr></tr>').append($('<td></td>').append($('<input>').attr({
                                type: 'checkbox', value: data.id})).append(
                                $('<label>').text(data.fname))));
                        });

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