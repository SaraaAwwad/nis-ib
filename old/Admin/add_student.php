<?php 
require_once("..\classes\level.php");
require_once("..\classes\address.php");
require_once("..\classes\student.php");
require_once("..\classes\parent.php");
require_once("..\db\database.php");
require_once("..\classes\status.php");

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
$Levels = Level::getAllLevel();
$Status = Status::getAllStatus();
$concatenate = "@nis.edu.eg";



if(isset($_POST['update'])) {

  $objParent = new Parents();
  $objParent->parentsearch = $_POST['parentsearch'];
  $objParent->fname = $_POST['parentfname'];
  $objParent->lname = $_POST['parentlname'];
  $objParent->phone = $_POST['parentnumber'];
  $objParent->DOB = $_POST['parentdate'];
  $objParent->gender = $_POST['parentradio'];
  $objParent->address_id_fk = $_POST['street'];
  $objParent->email = $_POST['parentemail'].$concatenate;
  $objParent->pwd = $_POST['parentpassword'];
  $objParent->username = $_POST['parentusername'];
  $objParent->img = $_POST['parentimage'];
  $objParent->parent = 0;


  $objUser = new Student();
  $objUser->fname = $_POST['fname'];
  $objUser->lname = $_POST['lname'];
  $objUser->phone = $_POST['number'];
  $objUser->DOB = $_POST['date'];
  $objUser->gender = $_POST['radio'];
  $objUser->address_id_fk = $_POST['street'];
  $objUser->email = $_POST['email'].$concatenate;
  $objUser->status = $_POST['status'];
  $objUser->pwd = $_POST['password'];
  $objUser->username = $_POST['username'];
  $objUser->img = $_POST['image'];

  switch($_POST['pickradio']) {
        case "exist":
            $idresult = Parents::getExistingParent($objParent->parentsearch);
            break;
        case "notexist":
            $idresult = Parents::InsertinDB($objParent);
            break;
  }  

  $objUser->user_id_fk = $idresult;
  Student::InsertinDB($objUser);
  header("location: view_students.php");
  }


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-daterangepicker/daterangepicker.css" />
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
  </head>

  <body>

  <section id="container" >
      <?php include_once("header.php"); ?>
      <?php include_once("side.php"); ?>
      <section id="main-content">
          <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> Add New Student</h3>
            
            <div class="row mt">
              <div class="col-lg-12">
                  <div class="form-panel">
                      <form class="form-horizontal style-form" method="post">
                        
                          <legend>Student Info</legend>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">First Name</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="fname">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Last Name</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="lname">
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
                              <label class="col-sm-2 col-sm-2 control-label">Date Of Birth</label>
                              <div class="col-sm-10">
                                  <input id="date" type="date" name="date">
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Phone Number</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="number">
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Gender</label>
                              <div class="col-sm-10">
                            <label class="containerradio">Male
                            <input type="radio" checked="checked" value="M" name="radio">
                            <span class="checkmark"></span>
                            </label>
                            <label class="containerradio" >Female
                            <input type="radio" value="F" name="radio">
                            <span class="checkmark"></span>
                            </label>
                              </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Status</label>
                            <div class="col-sm-10">
                            <?php for($i=0; $i<count($Status); $i++){ ?>
                            <label class="containerradio"><?php echo $Status[$i]->code; ?>
                            <input type="radio" checked="checked" value="<?php echo $Status[$i]->id; ?>" name="status">
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
                              <?php Address::loadCountry(); ?>
                              </select>
                              </div>
                          </div>
                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">City</label>
                              <div class="styled-select slate">
                              <select name="city" id="city" >
                              <option value="">Select City</option>
                              </select>
                          </div>
                          </div>
                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Area</label>
                              <div class="styled-select slate">
                              <select name="area" id="area">
                              <option value="">Select Area</option>
                              </select>
                          </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Street</label>
                              <div class="styled-select slate">
                              <select name="street" id="street">
                              <option value="">Select Street</option>
                              </select>
                          </div>
                          </div>


                          <legend>Account Information</legend>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Email</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="email" maxlength="15">@nis.edu.eg
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Password</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="password" value="<?php echo randomPassword(); ?>">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Username</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="username">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Image</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="image">
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
                        <input type="submit" name="update" id="main">
                      </form>
                  </div>
              </div>      
            </div>

    </section>
    </section>
  </section>
 <script src="assets/js/jquery.js"></script>
    <script src="assets/js/user.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/js/common-scripts.js"></script>
    <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>
  <script src="assets/js/bootstrap-switch.js"></script>
  <script src="assets/js/jquery.tagsinput.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
  <script src="assets/js/form-component.js"></script>  
    <script src="assets/js/add-parent.js"></script>  


  </body>
</html>
