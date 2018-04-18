<?php
require_once("..\db\database.php");
require_once("..\classes\section.php");
require_once("..\classes\schedule.php");
$id = $_GET['id'];
$allSchedule = array();
$allSchedule = Schedule::SelectAllSchedulesInDB($id);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>NIS</title>

    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

  </head>

  <body>

  <section id="container" >
      <!-- TOP BAR CONTENT & NOTIFICATIONS -->
      <!--header start-->
      <?php include_once("header.php"); ?>
      <!--header end-->
      
      <!-- MAIN SIDEBAR MENU -->
      <!-- sidebar start-->
      <?php include_once("side.php"); ?>
      <!--sidebar end-->
      
      <!--MAIN CONTENT-->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> View Schedule</h3>
  <section class="tabcontent">
    <a class="buttonlink btn btn-theme04 left" href="add_schedule.php?id=<?php echo ''.$id.''; ?>"><i class="fa fa-plus"></i> Schedule</a>
    <input type="search" class="light-table-filter" results="2" name="s" data-table="order-table" placeholder="Search.." />
    <table class="order-table">
      <thead>
        <tr>
          <th>ID</th>
          <th class="hidden-phone">Section id</th>
          <th>Room id</th>
          <th>Room's Capacity</th>
          <th>Day</th>
          <th>Slot</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
         <?php for($i=0; $i<count($allSchedule); $i++){ 
          echo
        '<tr>
          <td> '.$allSchedule[$i]->id.'</td>
          <td>'.$allSchedule[$i]->section_id.'</td>
          <td>'.$allSchedule[$i]->name.'</td>
          <td>'.$allSchedule[$i]->size.'</td>
          <td>'.$allSchedule[$i]->day.'</td>
          <td>'.$allSchedule[$i]->slot_name.'</td>
          <td  colspan="2">
            <a class="btn btn-success btn-xs" href="update.php?id='.$allSchedule[$i]->id.'">Update</a><br><br>
            <a class="btn btn-success btn-xs" href="update.php?id='.$allSchedule[$i]->id.'">Activate</a>
          </td>
        </tr>';
         } ?>
      </tbody>
    </table>
  </section>

                      
    </section><!-- wrapper -->
      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/js/common-scripts.js"></script>
    <script src="assets/js/staff.js"></script>
    <!--script for this page-->

  </body>
</html>