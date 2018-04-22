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
            <h1>Add A New Student</h1>

    </div>
  </div>  

        <div class="row mt">
        <div class="col-lg-12">
        <div class="form-panel">
        <form class="form-horizontal style-form" method="post">
                        
        <legend>Student Info</legend>
        <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label">First Name</label>
        <div class="col-sm-8">
        <input name="fnamein" type="text" class="form-control" required>
         </div>
        </div>

        <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label">Last Name</label>
        <div class="col-sm-8">
        <input name="lnamein" type="text" class="form-control" required>
        </div>
        </div>
            <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Level</label>
                <div class="col-sm-10">
                    <?php for($i=0; $i<count($Levels); $i++){ ?>
                        <label class="containerradio"><?php echo $Levels[$i]->level; ?>
                            <input type="radio" checked="checked" value ="<?php echo $Levels[$i]->id; ?>" name="level">
                            <span class="checkmark"></span>
                        </label>
                    <?php } ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Grade</label>
                <div class="styled-select slate">
                    <select name="gradein" id="gradein">
                        <option value="">Select Grade</option>
                        <?php foreach($grade as $grad){ ?>
                            <option value="<?php echo $grad->id; ?>"><?php echo $grad->grade_name; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

        <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label">Date Of Birth</label>
        <div class="col-sm-8">
        <input id="date" type="date" name="datein">
        </div>
        </div>

            <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Phone Number</label>
                <div class="col-sm-8">
                    <input name="numberin" type="text" class="form-control" required>
                </div>
            </div>

            <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label">Gender</label>
        <div class="col-sm-8">
        <label class="containerradio">Male
        <input type="radio" checked="checked" value="M" name="radioin">
        <span class="checkmark"></span>
        </label>
        <label class="containerradio" >Female
        <input type="radio" value="F" name="radioin">
        <span class="checkmark"></span>
        </label>
        </div>
        </div>


        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Status</label>
          <div class="col-sm-10">
          <?php foreach($status as $status){ ?>
          <label class="containerradio"><?php echo $status->code; ?>
          <input type="radio" checked="checked" value="<?php echo $status->id; ?>" name="statusinput">
          <span class="checkmark"></span>
          </label>
          <?php } ?>
        </div>
        </div>

                          <legend>Address Information</legend>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Country</label>
                              <div class="styled-select slate">
                              <select name="country" id="country">
                              <option value="">Select Country</option>
                              <?php foreach($country as $count){ ?>
                              <option value="<?php echo $count->id; ?>"><?php echo $count->address; ?></option>
                              <?php } ?>
                              </select>
                              </div>
                          </div>
                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">City</label>
                              <div class="styled-select slate">
                              <select name="city" id="City">
                              <option value="">Select City</option>
                              </select>
                          </div>
                          </div>
                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Area</label>
                              <div class="styled-select slate">
                              <select name="area" id="Area">
                              <option value="">Select Area</option>
                              </select>
                          </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Street</label>
                              <div class="styled-select slate">
                              <select name="street" id="Street">
                              <option value="">Select Street</option>
                              </select>
                          </div>
                          </div>
                          
                          <legend>Account Information</legend>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Email</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="emailin" maxlength="15">@nis.edu.eg
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Password</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="passwordin" value="<?php echo randomPassword(); ?>">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Username</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="usernamein">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Image</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="imagein">
                              </div>
                          </div>

                          <legend>Parent Information</legend>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Add Parent Info</label>
                              <div class="col-sm-10">
                                  <label class="containerradio">Existing Parent
                                      <input type="radio" checked="checked" name="pickradio" value="exist" id="existp">
                                      <span class="checkmark"></span>
                                  </label>
                                  <label class="containerradio">New Parent
                                      <input type="radio" name="pickradio" value="notexist" id="newp">
                                      <span class="checkmark"></span>
                                  </label>
                              </div>
                          </div>

                          <fieldset id="searchp" style="display:none;">
                              <div class="form-group">
                                  <label class="col-sm-2 col-sm-2 control-label">Username</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control" placeholder="Search By Username" name="parentsearch">
                                  </div>
                              </div>
                          </fieldset>

                          <fieldset id="pform" style="display:none;">
                              <legend>Personal Info</legend>
                              <div class="form-group">
                                  <label class="col-sm-2 col-sm-2 control-label">First Name</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control" name="parentfname">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-sm-2 col-sm-2 control-label">Last Name</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control" name="parentlname">
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-sm-2 col-sm-2 control-label">Date Of Birth</label>
                                  <div class="col-sm-10">
                                      <input id="date" type="date" name="parentdate">
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-sm-2 col-sm-2 control-label">Phone Number</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control" name="parentnumber">
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-sm-2 col-sm-2 control-label">Gender</label>
                                  <div class="col-sm-10">
                                      <label class="containerradio">Male
                                          <input type="radio" checked="checked" value="M" name="parentradio">
                                          <span class="checkmark"></span>
                                      </label>
                                      <label class="containerradio" >Female
                                          <input type="radio" value="F" name="parentradio">
                                          <span class="checkmark"></span>
                                      </label>
                                  </div>
                              </div>

                              <legend>Account Information</legend>
                              <div class="form-group">
                                  <label class="col-sm-2 col-sm-2 control-label">Email</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control" name="parentemail" maxlength="15">@nis.edu.eg
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-sm-2 col-sm-2 control-label">Password</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control" name="parentpassword" value="<?php echo randomPassword(); ?>">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-sm-2 col-sm-2 control-label">Username</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control" name="parentusername">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-sm-2 col-sm-2 control-label">Image</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control" name="parentimage">
                                  </div>
                              </div>
                          </fieldset>


                        <input type="submit" name="addStudent" id="main">
                      </form>
                  </div>
              </div>      
            </div>

<script>
    $("#existp").click(function () {
        document.getElementById("pform").style.display="none";
        document.getElementById("searchp").style.display="block";

    });
    $("#newp").click(function () {
        document.getElementById("searchp").style.display="none";
        document.getElementById("pform").style.display="block";
    });
    $(document).ready(function(data){

                    $('.addStudent').on('click',function(e){
                    e.preventDefault();
                    e.stopPropagation();

                    $.ajax({
                        url:"/student/add",
                        method:'POST',
                        dataType:'json',
                        data:{
                            country: $(".country").val(),
                            city: $(".city").val(),
                            area: $(".area").val(),
                            street: $(".street").val(),
                            gradein: $(".gradein").val(),
                            action:"ajax",
                            status:1
                        },
                        success:function(data)
                        {
                            $('.country').attr('disabled', true);
                            $('.city').attr('disabled', true);
                            $('.area').attr('disabled', true);
                            $('.street').attr('disabled', true);
                            $('.gradein').attr('disabled', true);

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