<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>About - Unisco - Education Website Template for University, College, School</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Simple Line Font -->
    <link rel="stylesheet" href="css/simple-line-icons.css">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/slick-theme.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <!-- Main CSS -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- ========================= ABOUT IMAGE =========================-->
    <div class="about_bg">
        <div class="container">
    <?php include_once ("header.php");  ?>
        <div class="row">
            <div class="col-md-12">
                <h1>Sign Up</h1>
            </div>
        </div>
    </div>
</div>
<!--//END ABOUT IMAGE -->

<!--============================= Login =============================-->
<div class="login sign-up">
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-xs-12 col-sm-12 col-md-5 well well-sm">
              <form action="#" class="form sign-up-form">
                <div class="row">
                    <div class="col-xs-6 col-md-6">
                        <div class="form-group">
                            <input class="form-control" name="firstname" placeholder="First Name" type="text"
                            required autofocus />
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-6">
                        <div class="form-group">
                            <input class="form-control" name="lastname" placeholder="Last Name" type="text" required />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input class="form-control" name="youremail" placeholder="Your Email" type="email" />
                </div>
                <div class="form-group">
                    <input class="form-control" name="reenteremail" placeholder="Re-enter Email" type="email" />
                </div>
                <div class="form-group">
                    <input class="form-control" name="password" placeholder="New Password" type="password" />
                </div>
                <label>
                    Birth Date</label>
                    <div class="row">
                        <div class="col-xs-4 col-md-4">
                            <select class="form-control custom-select">
                             <option selected="" value="">Month</option>
                             <option value="select">One</option>
                             <option value="select">Two</option>
                             <option value="select">Three</option>
                             <option value="select">Four</option>
                         </select>
                     </div>
                     <div class="col-xs-4 col-md-4">
                        <select class="form-control custom-select">
                            <option selected="" value="">Day</option>
                            <option value="select">One</option>
                            <option value="select">Two</option>
                            <option value="select">Three</option>
                            <option value="select">Four</option>
                        </select>
                    </div>
                    <div class="col-xs-4 col-md-4">
                        <select class="form-control custom-select">
                            <option selected="" value="">Year</option>
                            <option value="select">One</option>
                            <option value="select">Two</option>
                            <option value="select">Three</option>
                            <option value="select">Four</option>
                        </select>
                    </div>
                </div>
                <label class="radio-inline">
                    <input type="radio" name="sex" id="inlineCheckbox1" value="male" />
                    Male
                </label>
                <label class="radio-inline">
                    <input type="radio" name="sex" id="inlineCheckbox2" value="female" />
                    Female
                </label>
                <br />
                <br />
                <button type="submit" class="btn btn-warning" id="js-subscribe-btn">SIGN UP</button>
            </form>
        </div>
    </div>
</div>
</div>
<!--//End Login -->
       <!--  ============================= Instagram Feed =============================
       <div id="instafeed"></div>
       //END Instagram feed JS -->
       <!--============================= FOOTER =============================-->
       <?php include_once ("footer.php"); ?>
            <!--//END FOOTER -->
            <!-- jQuery, Bootstrap JS. -->
            <script src="js/jquery.min.js"></script>
            <script src="js/tether.min.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <!-- Plugins -->
            <script src="js/slick.min.js"></script>
            <script src="js/waypoints.min.js"></script>
            <script src="js/counterup.min.js"></script>
            <script src="js/instafeed.min.js"></script>
            <script src="js/owl.carousel.min.js"></script>
            <script src="js/validate.js"></script>
            <script src="js/tweetie.min.js"></script>
            <!-- Subscribe -->
            <script src="js/subscribe.js"></script>
            <!-- Script JS -->
            <script src="js/script.js"></script>
        </body>

        </html>
