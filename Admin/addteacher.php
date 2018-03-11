<?php 
require_once("..\db\database.php");
require_once("..\classes\address.php");
require_once("..\classes\usertype.php");
require_once("..\classes\user.php");
require_once("..\classes\currency.php");
require_once("../classes/teacher.php");

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
$Users = UserType::getAllUserTypes();
$Currency = Currency::SelectCurrencyInDB();
$concatenate = "@nis.edu.eg";


if(isset($_POST['update'])) {
  $objUser = new User();
  $objUser->fname = $_POST['fnameinput'];
  $objUser->lname = $_POST['lnameinput'];
  $objUser->phone = $_POST['numberinput'];
  $objUser->DOB = $_POST['dateinput'];
  $objUser->gender = $_POST['radioinput'];
  $objUser->type_id = $_POST['professioninput'];
  $objUser->country = $_POST['country'];
  $objUser->address_id_fk = $_POST['street'];
  $objUser->area = $_POST['area'];
  $objUser->city = $_POST['city'];
  $objUser->email = $_POST['emailinput'].$concatenate;
  $objUser->status = $_POST['statusinput'];
  $objUser->pwd = $_POST['passwordinput'];
  $objUser->username = $_POST['usernameinput'];
  $objUser->img = $_POST['imageinput'];
  $objUser->amount = $_POST['salaryinput'];
  $objUser->currency = $_POST['currencyinput'];
  Teacher::InsertinDB($objUser);
  header("location: view_staff.php");
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
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
  </head>

  <body>

  <section id="container" >
      <?php require_once("header.php"); ?>
      <?php require_once("side.php"); ?>

      <section id="main-content">
          <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> Add To Staff</h3>
            
            <!-- BASIC FORM ELELEMNTS -->
            <div class="row mt">
              <div class="col-lg-12">
                  <div class="form-panel">
                      <form class="form-horizontal style-form" method="post">
                        <fieldset>
                          <legend>Personal Information</legend>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">First Name</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="fnameinput">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Last Name</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="lnameinput">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Phone Number</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="numberinput">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Date Of Birth</label>
                              <div class="col-sm-10">
                                  <input id="date" type="date" name="dateinput">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Gender</label>
                              <div class="col-sm-10">
                            <label class="containerradio">Male
                            <input type="radio" checked="checked" value="M" name="radioinput">
                            <span class="checkmark"></span>
                            </label>
                            <label class="containerradio" >Female
                            <input type="radio" value="F" name="radioinput">
                            <span class="checkmark"></span>
                            </label>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Status</label>
                              <div class="col-sm-10">
                            <label class="containerradio">Active
                            <input type="radio" checked="checked" value="1" name="statusinput">
                            <span class="checkmark"></span>
                            </label>
                            <label class="containerradio" >Inactive
                            <input type="radio" value="2" name="statusinput">
                            <span class="checkmark"></span>
                            </label>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Profession</label>
                              <div class="styled-select slate">
                              <select name="professioninput">
                              <option>Select Profession</option>
                               <?php for($i=0; $i<count($Users); $i++){ ?>
                              <option value="<?php echo $Users[$i]->id; ?>"><?php echo $Users[$i]->title; ?></option>
                              <?php } ?>
                              </select>
                          </div>
                          </div>
                          </fieldset>
                          <fieldset>
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
                          </fieldset>
                          <fieldset>
                          <legend>Account Information</legend>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Email</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="emailinput" maxlength="15">@nis.edu.eg
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Password</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="passwordinput" value="<?php echo randomPassword(); ?>">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Username</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="usernameinput">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Image</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="imageinput">
                              </div>
                          </div>
                          <legend>Salary Information</legend>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Salary</label>
                              <div class="col-sm-10">
                                  <input type="number" class="form-control" name="salaryinput">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Currency</label>
                              <div class="styled-select slate">
                              <select name="currencyinput">
                              <?php for($i=0; $i<count($Currency); $i++){ ?>
                              <option value="<?php echo $Currency[$i]->id; ?>"><?php echo $Currency[$i]->code; ?></option>
                              <?php } ?>
                              </select>
                          </div>
                          </div>
                        </fieldset>
                          <input type="submit" name="update" id="main">
                      </form>
                  </div>
              </div><!-- col-lg-12-->       
            </div><!-- /row -->
    </section><!--/wrapper -->
    </section><!-- /MAIN CONTENT -->
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

  </body>
</html>
