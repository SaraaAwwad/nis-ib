<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>NIS</title>

    <!-- Bootstrap core CSS -->
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
            <h3><i class="fa fa-angle-right"></i> View Staff</h3>
  <section class="tabcontent">
    <a class="buttonlink btn btn-theme04 left" href="addteacher.php"><i class="fa fa-plus"></i> Add To Staff</a>
    <input type="search" class="light-table-filter" results="2" name="s" data-table="order-table" placeholder="Search.." />
    <table class="order-table">
      <thead>
        <tr>
          <th>ID</th>
          <th class="hidden-phone">First Name</th>
          <th class="hidden-phone">Last Name</th>
          <th>Gender</th>
          <th>DOB</th>
          <th>Username</th>
          <th>Password</th>
          <th>Email</th>
          <th>Telephone</th>
          <th>Address</th>
          <th><i class="fa fa-bookmark"></i> Salary</th>
          <th><i class=" fa fa-edit"></i> Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>Farrah</td>
          <td>Hisham</td>
          <td>Female</td>
          <td>7/11/1996</td>
          <td>
            <a href="teacherspanel.php#">Farrahhisham</a></td>
          <td>123</td>
          <td>farrah@gmail.com</td>
          <td>0111111111</td>
          <td>18 elnozha, cairo, egypt.</td>
          <td>12000.00$ </td>
          <td><span class="label label-info label-mini">Due</span></td>
          <td  colspan="2">
            <button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
            <button class="btn btn-Coordinatorimary btn-xs"><i class="fa fa-pencil"></i></button>
          </td>
        </tr>
        <tr>
          <td>1</td>
          <td>Farrah</td>
          <td>Hisham</td>
          <td>Female</td>
          <td>7/11/1996</td>
          <td>
            <a href="teacherspanel.php#">Farrahhisham</a></td>
          <td>123</td>
          <td>farrah@gmail.com</td>
          <td>0111111111</td>
          <td>18 elnozha, cairo, egypt.</td>
          <td>12000.00$ </td>
          <td><span class="label label-info label-mini">Due</span></td>
          <td  colspan="2">
            <button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
            <button class="btn btn-Coordinatorimary btn-xs"><i class="fa fa-pencil"></i></button>
          </td>
        </tr>
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


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>
    <script src="assets/js/staff.js"></script>
    <!--script for this page-->
    
  <script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>


  </body>
</html>
