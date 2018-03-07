<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Nefertari - View Students</title>

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
      <?php include_once("side.php"); ?>
      <!--sidebar end-->
      
      <!-- ************ MAIN CONTENT **************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">

              <div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">
                          <table class="table table-striped table-advance table-hover">
                            <h4><i class="fa fa-angle-right"></i> Students Table</h4>
                            <hr>
                              <thead>
                              <tr>
                                  <th><i class="fa fa-question-circle"></i> First Name </th>
                                  <th class="hidden-phone"><i class="fa fa-question-circle"></i>Last Name</th>
                                   <th class="hidden-phone"><i class="fa fa-user"></i> Username</th>
                                  <th class="hidden-phone"><i class="fa fa-envelope"></i> Email</th>
                                  <th class="hidden-phone"><i class="fa fa-lock"></i> Password</th>
                                  <th><i class=" fa fa-edit"></i> Actions </th>
                                  
                              </tr>
                              </thead>
                              <tbody>
                              <tr>
                                  <td>Amira</td>
                                  <td class="hidden-phone">Galal</td>
                                  <td class="hidden-phone">Amirag</td>
                                  <td class="hidden-phone">amirag@gmail.com</td>
                                  <td class="hidden-phone">123456</td>

                                  <td>
                                      <button class="btn btn-primary btn-xs" onclick="window.location.href='#'">
                                        <i class="fa fa-pencil"></i></button>
                                      <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                                  </td>
                              </tr>

                               <tr>
                                  <td>Sara</td>
                                  <td class="hidden-phone">Awwad</td>
                                  <td class="hidden-phone">Saraw</td>
                                  <td class="hidden-phone">Saraw@gmail.com</td>
                                  <td class="hidden-phone">654321</td>

                                  <td>
                                      <button class="btn btn-primary btn-xs" onclick="window.location.href='#'">
                                        <i class="fa fa-pencil"></i></button>
                                      <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                                  </td>
                              </tr>

                                <tr>
                                  <td>Farah</td>
                                  <td class="hidden-phone">Hisham</td>
                                  <td class="hidden-phone">Farahh</td>
                                  <td class="hidden-phone">Farahh@gmail.com</td>
                                  <td class="hidden-phone">123456</td>

                                  <td>
                                      <button class="btn btn-primary btn-xs" onclick="window.location.href='#'">
                                        <i class="fa fa-pencil"></i></button>
                                      <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                                  </td>
                              </tr>
                                <tr>
                                  <td>Menna</td>
                                  <td class="hidden-phone">Mohamed</td>
                                  <td class="hidden-phone">Mennam</td>
                                  <td class="hidden-phone">mennam@gmail.com</td>
                                  <td class="hidden-phone">123123</td>

                                  <td>
                                      <button class="btn btn-primary btn-xs" onclick="window.location.href='#'">
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
