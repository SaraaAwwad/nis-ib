<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Nefertari - View Pages</title>

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
          <section class="wrapper">

              <div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">
                          <table class="table table-striped table-advance table-hover">
                            <h4><i class="fa fa-angle-right"></i> Pages Table</h4>
                            <hr>
                              <thead>
                              <tr>
                                  <th><i class="fa fa-file-o"></i> Title </th>
                                  <th class="hidden-phone"><i class="fa fa-question-circle"></i> Descrition</th>
                                  <th><i class=" fa fa-edit"></i> Actions </th>
                                  
                              </tr>
                              </thead>
                              <tbody>
                              <tr>
                                  <td><a href="basic_table.html#">index</a></td>
                                  <td class="hidden-phone">Homepage</td>
                                  <td>
                                      <button class="btn btn-primary btn-xs" onclick="window.location.href='edit_page.html'">
                                        <i class="fa fa-pencil"></i></button>
                                      <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                                  </td>
                              </tr>
                              <tr>
                                  <td><a href="basic_table.html#">Register</a></td>
                                  <td class="hidden-phone">Add new Student</td>
                                  <td>
                                      <button class="btn btn-primary btn-xs" onclick="window.location.href='edit_page.html'">
                                        <i class="fa fa-pencil"></i></button>
                                      <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                                  </td>
                              </tr>
                              <tr>
                                  <td><a href="basic_table.html#">Courses</a></td>
                                  <td class="hidden-phone">View all courses</td>
                                  <td>
                                      <button class="btn btn-primary btn-xs"onclick="window.location.href='edit_page.html'">
                                        <i class="fa fa-pencil"></i></button>
                                      <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                                  </td>
                              </tr>
                              </tbody>
                          </table>
                      </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->

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
