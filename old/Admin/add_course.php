<?php 
require_once("..\classes\level.php");
require_once("..\db\database.php");
require_once("..\classes\status.php");
require_once("..\classes\group.php");
require_once("..\classes\courses.php");

$Levels = Level::getAllLevel();
$Status = Status::getAllStatus();
$Groups= Group::getAllGroups();

if(isset($_POST['update'])) {

  $objCourse = new Courses();
  $objCourse->cname = $_POST['cname'];
  $objCourse->ccode = $_POST['ccode'];
  $objCourse->level = $_POST['level'];
  $objCourse->group = $_POST['group'];
  $objCourse->hours = $_POST['hours'];
  $objCourse->descr = $_POST['descr'];
  $objCourse->status = $_POST['status'];

  Courses::InsertinDB($objCourse);
   header("location: view_courses.php");
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
            <h3><i class="fa fa-angle-right"></i> Add Course</h3>
            <div class="row mt">
              <div class="col-lg-12">
                  <div class="form-panel">
                      <form class="form-horizontal style-form" method="post">
                          <legend>Course Information</legend>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Course Name</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="cname">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Course Code</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="ccode">
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Level</label>
                              <div class="styled-select slate">
                              <select name="level" id="level">
                              <option>Select Level</option>
                              <?php for($i=0; $i<count($Levels); $i++){ ?>
                              <option value="<?php echo $Levels[$i]->id; ?>"><?php echo $Levels[$i]->level; ?></option>
                              <?php } ?>
                              </select>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Group</label>
                              <div class="styled-select slate">
                              <select name="group" id="group">
                              <option>Select Group</option>
                              <?php for($i=0; $i<count($Groups); $i++){ ?>
                              <option value="<?php echo $Groups[$i]->id; ?>"><?php echo $Groups[$i]->group_name; ?></option>
                              <?php } ?>
                              </select>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Teaching Hours</label>
                              <div class="col-sm-10">
                                  <input type="number" class="form-control" name="hours">
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Description</label>
                              <div class="col-sm-10">
                                  <textarea rows="4" cols="50" name="descr">
                                  </textarea>
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
                          <input type="submit" name="update" id="main">
                      </form>
                  </div>
              </div><!-- col-lg-12-->       
            </div><!-- /row -->
            
    </section><!--/wrapper -->
    </section><!-- /MAIN CONTENT -->
  </section>

  <script src="assets/js/jquery.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
  <script src="assets/js/jquery.scrollTo.min.js"></script>
  <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
  <script src="assets/js/common-scripts.js"></script>
  <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>
  <script src="assets/js/bootstrap-switch.js"></script>
  <script src="assets/js/jquery.tagsinput.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap-daterangepicker/date.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
  <script src="assets/js/form-component.js"></script>
  <script>
  $(function(){  
  $('input[type="time"][value="now"]').each(function(){    
    var d = new Date(),        
        h = d.getHours(),
        m = d.getMinutes();
    if(h < 10) h = '0' + h; 
    if(m < 10) m = '0' + m; 
    $(this).attr({
      'value': h + ':' + m
    });
  });
});
  </script>
  </body>
</html>
