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
            <h3><i class="fa fa-angle-right"></i> View Addresses</h3>
    <a class="buttonlink btn btn-theme04 left" href="AddAddress.php"><i class="fa fa-plus"></i> Add Address</a>

<div class="container1">
<div class="floatLeft">
<section class="tabcontent">
<table>
   <thead>
        <tr>
          <th>Counrty</th>
        </tr>
      </thead>
      <tbody>
      <tr>
        <td>Egypt</td>
      </tr>
    </tbody>
    </table>
  </section>
</div>

<div class="floatCenter">
<section class="tabcontent">
<table>
   <thead>
        <tr>
          <th>City</th>
        </tr>
      </thead>
      <tbody>
      <tr>
        <td>Cairo</td>
      </tr>
    </tbody>
    </table>
  </section>
</div>

<div class="floatRight">
<section class="tabcontent">
<table>
   <thead>
        <tr>
          <th>Area</th>
        </tr>
      </thead>
      <tbody>
      <tr>
        <td>Masr ElGedida</td>
      </tr>
    </tbody>
    </table>
  </section>
</div>
            </div>          
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
