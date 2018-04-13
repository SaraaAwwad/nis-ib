<?php
require_once("..\db\database.php");
require_once("..\classes\courses.php");

$allCourses = array();
$allCourses = Courses::SelectAllCoursesInDB();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <title>NIS - View Courses</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

  </head>
  <body>
  <section id="container" >
      <?php include_once("header.php"); ?>
      <?php include_once("side.php"); ?>
      <section id="main-content">
          <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> View Courses</h3>
  <section class="tabcontent">
    <a class="buttonlink btn btn-theme04 left" href="add_course.php"><i class="fa fa-plus"></i>Course</a>
    <input type="search" class="light-table-filter" results="2" name="s" data-table="order-table" placeholder="Search.." />
    <table class="order-table">
      <thead>
        <tr>
          <th>ID</th>
          <th class="hidden-phone">Course Name</th>
          <th class="hidden-phone">Course Code</th>
          <th>Course Level</th>
          <th>Course Group</th>
          <th>Teaching Hours</th>
          <th>Description</th>
          <th><i class=" fa fa-edit"></i> Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php for($i=0; $i<count($allCourses); $i++){ 
          echo
        '<tr>
          <td> '.$allCourses[$i]->id.'</td>
          <td><a href="view_sections.php?id='.$allCourses[$i]->id.'"> '.$allCourses[$i]->name.' </a></td>
          <td>'.$allCourses[$i]->course_code.'</td>
          <td>'.$allCourses[$i]->level.'</td>
          <td>'.$allCourses[$i]->group_name.'</td>
          <td>'.$allCourses[$i]->teaching_hours.'</td>
          <td>'.$allCourses[$i]->descr.'</td>
          <td><span class="label label-info label-mini">'.$allCourses[$i]->active.'</span></td>
          <td  colspan="2">
            <a class="btn btn-success btn-xs" href="update.php?id='.$allCourses[$i]->id.'">Update</a><br><br>
            <a class="btn btn-success btn-xs" href="update.php?id='.$allCourses[$i]->id.'">Activate</a>
          </td>
        </tr>';
         } ?>
      </tbody>
    </table>
  </section>

                      
    </section><!-- wrapper -->
      </section><!-- /MAIN CONTENT -->
  </section>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/js/common-scripts.js"></script>
    <script src="assets/js/staff.js"></script>

  </body>
</html>
