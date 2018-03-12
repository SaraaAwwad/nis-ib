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
$id = $_GET['id'];
$Teachers = Teacher::SelectAvailableTeachers();
$Semesters = Semester::getAllSemester();
$Course = Courses::SelectCourse($id);



if(isset($_POST['update'])) {
  $objSection = new Section();
  $objSection->username = $_POST['username'];
  $objSection->courseid = $_POST['courseid'];
  $objSection->semester = $_POST['semester'];
  $objSection->sectioncode = $_POST['sectioncode'];
  $objSection->day = $_POST['day'];
  $objSection->slot = $_POST['slot'];
  $objSection->room = $_POST['room'];

  $cid = Section::InsertinDB($objSection);

  if(isset($_POST['students'])){
  foreach ($_POST['students'] as $selectedOption)
  { Registeration::InsertinDB($cid,$selectedOption); }}

  header('location: view_sections.php?id='.$id.'');
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
            <h3><i class="fa fa-angle-right"></i> Add Section</h3>
            <div class="row mt">
              <div class="col-lg-12">
                  <div class="form-panel">
                      <form class="form-horizontal style-form" method="post">
                        
                          <legend>Teacher's Information</legend>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Username</label>
                              <div class="styled-select slate">
                              <select name="username" id="username">
                              <option value="">Select Teacher</option>
                              <?php
                                for($i=0; $i<count($Teachers); $i++){ 
                                 echo ' <option value ='.$Teachers[$i]->id.'>'.$Teachers[$i]->username.' </option>';
                                }
                                ?>
                              </select>
                              </div>
                              </div>
                          <legend>Section Information</legend>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Course Name</label>
                              <div class="col-sm-10">
                                  <input class="form-control" id="disabledInput" value="<?php echo ''.$Course[0]->name.''; ?>" type="text" ><br>
                                </div>
                                  <label class="col-sm-2 col-sm-2 control-label">Course ID</label>
                               <div class="col-sm-10">
                                  <input class="form-control" id="disabledInput" name="courseid" value="<?php echo ''.$Course[0]->id.''; ?>" type="text" >
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Semester</label>
                              <div class="styled-select slate">
                              <select name="semester" id="semester">
                              <option value="">Select Semester</option>
                              <?php
                                for($i=0; $i<count($Semesters); $i++){ 
                                 echo ' <option value ='.$Semesters[$i]->id.'>'.$Semesters[$i]->season_name.'-'.$Semesters[$i]->year.' </option>';}
                                ?>
                              </select>
                          </div>
                         </div>
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
  </script>
  </body>
</html>
