<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Nefertari - Add Course</title>

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
      <!-- ****************** TOP BAR CONTENT & NOTIFICATIONS **************** -->
      <!--header start-->
      <?php include_once("header.php"); ?>
      <!--header end-->
      
      <!-- ************* MAIN SIDEBAR MENU **************** -->
      <!--sidebar start-->
      <?php include_once("sidemenu.php"); ?>
      <!--sidebar end-->
      
      <!-- ************ MAIN CONTENT **************** -->
      <!--main content start-->
       <section id="main-content">
          <section class="wrapper site-min-height">
            <h3><i class="fa fa-angle-right"></i> View Courses: </h3>
            <div class="row mt">
              <div class="col-lg-12">
                 <div class="container">
                       
                    <form class="form form-horizontal">
                       <div class="form-group">
                         <div class="col-md-3">
                          <label>Course Name:</label>
                          <input type="text" class="form-control" id="email" placeholder="Enter Name of Course">
                         </div>

                         <div class="col-md-3">
                          <label>Course Code:</label>
                          <input type="text" class="form-control" id="email" placeholder="Enter Code of Course">
                         </div>
                       </div>
                     
                   </form>
                        <form class="form form-horizontal">
                          <div class="form-group">
                            <div class="col-md-3">
                              <label>Teaching Hours:</label>
                              <input type="text" class="form-control" id="email" placeholder="Teaching hours">
                            </div>

                            <div class="col-md-3">
                            <div class="form-group">
                              <label for="sel1">Select stage:</label>
                              <select class="form-control" id="sel1">
                                <option>MYP</option>
                                <option>PYP</option>
                                <option>DP</option>
                                
                              </select>
                            </div>
                            </div>
                          </div>
                        </form>
                        <button type="button" class="btn btn-primary">Add</button>
                   </div>

              
              </div>
            </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->
    
  <script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>

  </body>
</html>
