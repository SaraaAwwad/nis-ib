<?php 
require_once("..\db\database.php");
require_once("..\classes\address.php");
require_once("..\classes\student.php");
require_once("..\classes\usertype.php");
require_once("..\classes\user.php");
require_once("../classes/teacher.php");

$allStudents = array();
$allStudents = Student::SelectAllInDB();
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
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
  </head>
  <body>

  <section id="container" >
      <?php include_once("header.php"); ?>
      <?php include_once("side.php"); ?>
      <section id="main-content">
          <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> View Students</h3>

  <section class="tabcontent">
    <a class="buttonlink btn btn-theme04 left" href="add_student.php"><i class="fa fa-plus"></i> Add Student</a>
    <input type="search" class="light-table-filter" results="2" name="s" data-table="order-table" placeholder="Search.." />
    <table class="order-table">
      <thead>
        <tr>
          <th>ID</th>
          <th class="hidden-phone">First Name</th>
          <th class="hidden-phone">Last Name</th>
          <th>Gender</th>
          <th>DOB</th>
          <th>Telephone</th>
          <th>Username</th>
          <th>Password</th>
          <th>Email</th>
          <th><i class=" fa fa-edit"></i> Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php for($i=0; $i<count($allStudents); $i++){ ?>
        <tr>
          <td><?php echo $allStudents[$i]->id;?></td>
          <td><?php echo $allStudents[$i]->fname;?></td>
          <td><?php echo $allStudents[$i]->lname;?></td>
          <td><?php echo $allStudents[$i]->gender;?></td>
          <td><?php echo $allStudents[$i]->DOB;?></td>
          <td><?php echo $allStudents[$i]->telephone;?></td>
          <td><a href="teacherspanel.php#"><?php echo $allStudents[$i]->username;?></a></td>
          <td><?php echo ''.$allStudents[$i]->pwd.''; ?></td>
          <td><?php echo $allStudents[$i]->email;?></td>
          <td><span class="label label-info label-mini"><?php echo $allStudents[$i]->active;?></span></td>
          <td  colspan="2">
            <a class="btn btn-success btn-xs" href="update.php?id='.$allStudents[$i]->id.'">Update</a><br><br>
            <a class="btn btn-success btn-xs" href="update.php?id='.$allStudents[$i]->id.'">Activate</a>
          </td>
        </tr>
        <?php } ?>
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
s