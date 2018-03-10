<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Contact - Unisco - Education Website Template for University, College, School</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Simple Line Font -->
    <link rel="stylesheet" href="css/simple-line-icons.css">
    <!-- Owl Carousel -->
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
                <h1>Contact Us</h1>
            </div>
        </div>
    </div>
</div>
<!--//END ABOUT IMAGE -->
<section class="contact">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="contact-title">
                    <h2>Contact Details</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="contact-form">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 contact-option">
                            <div class="contact-option_rsp">
                                <h3>Leave a message</h3>
                                <form action="php/contact.php" method="post" id="phpcontactform">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Name" name="name" required>
                                    </div>
                                    <!-- // end .form-group -->
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Email" name="email" required>
                                    </div>
                                    <!-- // end .form-group -->
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Phone" name="phone" required>
                                    </div>
                                    <!-- // end .form-group -->
                                    <div class="form-group">
                                        <textarea placeholder="Message" class="form-control" name="message" required rows="5"></textarea>
                                    </div>
                                    <!-- // end .form-group -->
                                    <button type="submit" class="btn btn-default btn-submit" id="js-contact-btn">SUBMIT</button>
                                    <div id="js-contact-result" data-success-msg="Success, Your message has been sent" data-error-msg="Oops! Something went wrong"></div>
                                    <!-- // end #js-contact-result -->
                                </form>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="contact-address">
                                <h3>Location</h3>
                                <div class="contact-details">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <h6>Address</h6>
                                    <p> Unisco university
                                        <br> Albany, NY
                                        <br> USA. 11001</p>
                                    </div>
                                    <br>
                                    <div class="contact-details">
                                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                        <h6>Email</h6>
                                        <p>info@unisco.edu
                                            <br> admin@unisco.edu
                                        </p>
                                    </div>
                                    <br>
                                    <div class="contact-details">
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                        <h6>phone</h6>
                                        <p>+91 555 668 986</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p class="contact-center">OR</p>
                </div>
            </div>
        </div>
        <!-- Google map will appear here! Edit the Latitude, Longitude and Zoom Level below using data-attr-*  -->
        <div id="map" data-lat="40.674" data-lon="-73.945" data-zoom="12"></div>
    </section>
    <!--//END  ABOUT IMAGE -->
    <!--============================= Instagram Feed =============================-->
    <div id="instafeed"></div>
    <!--//END Instagram feed JS -->
    <!--============================= FOOTER =============================-->
   <?php include_once ("footer.php"); ?>
            <!--//END FOOTER -->
            <!-- jQuery, Bootstrap JS. -->
            <script src="js/jquery.min.js"></script>
            <script src="js/tether.min.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <!-- Plugins -->
            <script src="js/instafeed.min.js"></script>
            <script src="js/owl.carousel.min.js"></script>
            <script src="js/validate.js"></script>
            <script src="js/tweetie.min.js"></script>
            <!-- Subscribe / Contact-->
            <script src="js/subscribe.js"></script>
            <script src="js/contact.js"></script>
            <!-- Script JS -->
            <script src="js/script.js"></script>
            <!-- Map JS (Please change the API key below. Read documentation for more info) -->
            <script src="https://maps.googleapis.com/maps/api/js?callback=myMap&key=AIzaSyDMTUkJAmi1ahsx9uCGSgmcSmqDTBF9ygg"></script>
        </body>

        </html>
