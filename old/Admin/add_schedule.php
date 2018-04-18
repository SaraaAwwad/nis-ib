<?php 
require_once("../classes/weekdays.php");
require_once("../classes/slot.php");
require_once("../classes/room.php");
require_once("../classes/section.php");
require_once("../classes/student.php");
require_once("../classes/courses.php");
require_once("../classes/Registeration.php");
require_once("../classes/teacher.php");
require_once("../classes/semester.php");

if(isset($_POST['update'])) {
  $objSection = new Schedule();
  $sid = $_GET['id'];
  $objSection->sectioncode = $_POST['sectioncode'];
  $objSection->day = $_POST['day'];
  $objSection->slot = $_POST['slot'];
  $objSection->room = $_POST['room'];
  Schedule::InsertinDB($sid,$objSection);

  if(isset($_POST['students'])){
  foreach ($_POST['students'] as $selectedOption)
  { Registeration::InsertinDB($sid,$selectedOption); }}
  header('location: view_schedule.php?id='.$sid.'');
  
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
            <h3><i class="fa fa-angle-right"></i> Add To Schedule</h3>
            
            <div class="row mt">
              <div class="col-lg-12">
                  <div class="form-panel">
                      <form class="form-horizontal style-form" method="get">
                        
                         <legend>Schedule Information</legend>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Section Code</label>
                              <div class="col-sm-10">
                                  <input class="form-control" name="sectioncode" id="disabledInput" type="text">
                              </div>
                          </div>

                              <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Day</label>
                              <div class="styled-select slate">
                              <select name="day" id="day">
                              <option value="">Select Day</option>
                              <?php
                                $result = array();
                                $result = Weekdays::getWeekdays();
                                for($i=0; $i<count($result); $i++){ 
                                   echo ' <option value ='.$result[$i]->id.'>'.$result[$i]->day_name.'</option>';
                                }
                                ?>
                              </select>
                              </div>
                              </div>

                              <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Slot</label>
                              <div class="styled-select slate">
                              <select name="slot" id="slot">
                              <option value="">Select Slot</option>
                              <?php
                                $qresult = array();
                                $qresult = Slot::SelectAvailableSlots();
                                for($i=0; $i<count($qresult); $i++){ 
                                 echo ' <option value ='.$qresult[$i]->id.'>'.$qresult[$i]->slotName.' '.$qresult[$i]->startTime.'-'.$qresult[$i]->endTime.'</option>';
                                }
                                ?>
                              </select>
                              </div>
                              </div>

                              <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Room</label>
                              <div class="styled-select slate">
                              <select name="room" id="room">
                              <option value="">Select Room</option>
                              <?php
                                $result = array();
                                $result = Room::SelectAvailableRooms();
                                for($i=0; $i<count($result); $i++){ 
                                 echo ' <option value ='.$result[$i]->id.'>'.$result[$i]->name.' </option>';
                                  
                                }
                                ?>
                              </select>
                              </div>
                              </div>
                           
                          <legend>Register Students</legend>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Students</label>
                              <select name="students[]" multiple>
                              <?php
                                $Students = array();
                                $Students = Student::getRegisteredStudents();
                                for($i=0; $i<count($Students); $i++){ 
                                   echo ' <option value ='.$Students[$i]->id.'>'.$Students[$i]->fname.' '.$Students[$i]->lname.'</option>';
                                }
                                ?>
                              </select>
                          </div>

                          <input type="submit" name="update" id="main">
                      </form>
                  </div>
              </div><!-- col-lg-12-->       
            </div><!-- /row -->
            
       
            
    </section><!--/wrapper -->
    </section><!-- /MAIN CONTENT -->
  </section>

  <!-- js placed at the end of the document so the pages load faster -->
  <script src="assets/js/jquery.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
  <script src="assets/js/jquery.scrollTo.min.js"></script>
  <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


  <!--common script for all pages-->
  <script src="assets/js/common-scripts.js"></script>
  <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>
  <script src="assets/js/bootstrap-switch.js"></script>
  <script src="assets/js/jquery.tagsinput.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap-daterangepicker/date.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
  <script src="assets/js/form-component.js"></script>
  </body>
</html>