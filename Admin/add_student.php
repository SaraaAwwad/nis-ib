<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Nefertari - Add Student</title>

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
          <section class="wrapper site-min-height">
            <h3><i class="fa fa-angle-right"></i> Add New Student: </h3>
            <div class="row mt">
              <div class="col-lg-12">
                 <div class="container">
                       <!-- STUDENT FORM -->
                    <form class="form form-horizontal">
                       <div class="form-group">
                         <div class="col-md-3">
                          <label>First Name:</label>
                          <input type="text" name="FName" class="form-control" placeholder=""  required="">
                         </div>

                         <div class="col-md-3">
                          <label>Last Name:</label>
                          <input type="text" name="LName" class="form-control" placeholder="" required="">
                         </div>
                         </div>
                    </form>

                    <form class="form form-horizontal">
                       <div class="form-group">
                         <div class="col-md-3">
                          <label>Level:</label>
                          <select class="form-control" required="">
                            <option>Level</option>
                            <option>PYP</option>
                            <option>MYP</option>
                            <option>DP</option>
                          </select>
                         </div>

                         <div class="form-group">
                            <div class="col-md-3">
                         <label>Gender :</label> 
                          <select class="form-control" required="">
                            <option>Gender</option>
                            <option>Male</option>
                            <option>Female</option>
                          </select>
                          </div>
                        </div>
                      
                         </div>
                    </form>

                      <form class="form form-horizontal">
                       <div class="form-group">
                          <div class="col-md-3">
                          <label>Username:</label>
                          <input type="text" name="username" class="form-control" placeholder="" required="">
                            <br/>
                         </div>

                          <div class="col-md-3">
                          <label>Email:</label>
                          <input type="text" name="email" class="form-control" placeholder="" required="">

                         </div>
                      </div>
                      </form>

                        <form class="form form-horizontal">
                       <div class="form-group">
                          <div class="col-md-3">
                          <label>Password:</label>
                          <input type="password" name="pwd1" class="form-control" placeholder="" required="">
                            <br/>
                         </div>

                          <div class="col-md-3">
                          <label>retype password:</label>
                          <input type="password" name="pwd2" class="form-control" placeholder="" required="">

                         </div>
                      </div>
                      </form>


                        <form class="form form-horizontal">
                       <div class="form-group">
                          <div class="col-md-3">
                          <label>Telephone:</label>
                          <input type="text" name="tele" class="form-control" placeholder="" required="">
                            <br/>
                         </div>
                          <div class="col-md-3">
                          <label>Birthdate :</label>
                          <input type="text" name="bdate" class="form-control" placeholder="DD/MM/YYYY" required="">
                         </div>

                          
                      </div>
                      </form>

                      <form class="form form-horizontal">
                       <div class="form-group">
                          <div class="col-md-3">
                          <label>Address:</label>
                          <input type="text" name="address" class="form-control" placeholder="" required="">
                            <br/>
                         </div>

                          
                      </div>
                      </form>

                      <form class="form form-horizontal">
                       <div class="form-group">
                          <div class="col-md-3">
                          <div class="radio">
                          <label><input type="radio" name="optradio" id="existp">Add to existing parent</label>
                          <label><input type="radio" name="optradio" id="newp">Add new parent</label>
                        </div>
                            <br/>
                         </div>

                        
                      </div>

                      </form>

                      
                    </div>
                  </div>
                  </div>
                      
                      
                       
                       <!-- student form ends here -->

                      <div class="row mt">
                      <div class="col-lg-12">
  
                       <div class="container" id="searchp">
                         <form class="form form-horizontal">
                          <div class="form-group">
                         <div class="col-md-3">
                          <label>Search for parent:</label>
                          <input type="text" name="FName" class="form-control" placeholder="Search by username">
                         </div>
                         </form>
                       </div>
                       </div>
                     </div>



                       <!-- PARENT FORM -->

                       <div class="container" id="pform">
   
                          <form class="form form-horizontal">
                       <div class="form-group">
                         <div class="col-md-3">
                          <label>First Name:</label>
                          <input type="text" name="FName" class="form-control" placeholder=""  required="">
                         </div>

                         <div class="col-md-3">
                          <label>Last Name:</label>
                          <input type="text" name="LName" class="form-control" placeholder="" required="">
                         </div>
                         </div>
                    </form>

                    <form class="form form-horizontal">
                       <div class="form-group">
                         <div class="col-md-3">
                         <label>Gender :</label> 
                          <select class="form-control" required="">
                            <option>Gender</option>
                            <option>Male</option>
                            <option>Female</option>
                          </select>
                          </div>
                         </div>
                    </form>

                       <form class="form form-horizontal">
                       <div class="form-group">
                          <div class="col-md-3">
                          <label>Username:</label>
                          <input type="text" name="username" class="form-control" placeholder="" required="">
                            <br/>
                         </div>

                          <div class="col-md-3">
                          <label>Email:</label>
                          <input type="text" name="email" class="form-control" placeholder="" required="">

                         </div>
                      </div>
                      </form>

                        <form class="form form-horizontal">
                       <div class="form-group">
                          <div class="col-md-3">
                          <label>Password:</label>
                          <input type="password" name="pwd1" class="form-control" placeholder="" required="">
                            <br/>
                         </div>

                          <div class="col-md-3">
                          <label>retype password:</label>
                          <input type="password" name="pwd2" class="form-control" placeholder="" required="">

                         </div>
                      </div>
                      </form>


                        <form class="form form-horizontal">
                       <div class="form-group">
                          <div class="col-md-3">
                          <label>Telephone:</label>
                          <input type="text" name="tele" class="form-control" placeholder="" required="">
                            <br/>
                         </div>
                          <div class="col-md-3">
                          <label>Birthdate :</label>
                          <input type="text" name="bdate" class="form-control" placeholder="DD/MM/YYYY" required="">
                         </div>

                          
                      </div>
                      </form>

                      <form class="form form-horizontal">
                       <div class="form-group">
                          <div class="col-md-3">
                          <label>SSN:</label>
                          <input type="text" name="tele" class="form-control" placeholder="" required="">
                            <br/>
                         </div>

                          <div class="form-group">
                          <div class="col-md-3">
                          <label>Address:</label>
                          <input type="text" name="address" class="form-control" placeholder="" required="">
                            <br/>
                         </div>

                          
                      </div>
                          
                      </div>
                      </form>

                      
                      
                       </div>

                       <!-- parent form ends here -->
                     
                   
                 </div>
                        <button type="button" class="btn btn-primary">Add</button>
                   </div>

              
              
            
 


    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>
    <script src="assets/js/add-parent.js"></script>
    <!--script for this page-->
    
  <script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>

  </body>
</html>
