<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admission Form - Unisco - Education Website Template for University, College, School</title>
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
                <h1>Admissions</h1>
            </div>
        </div>
    </div>
</div>
    <!--//END ABOUT IMAGE -->
    <div class="container">
        <!--============================= ADMISSION FORM RULES =============================-->
        <section class="admission-form_rules">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 admission-form_mr">
                        <h2>Admission Rules</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries. It has survived not only five centuries, but also the leap into electronic.</p>
                    </div>
                    <div class="col-md-5 admission-form_mr">
                        <ul class="admission-form_listed">
                            <li>Donec molestie felis eget justo pellentesque</li>
                            <li>Phasellus et justo sit amet nisl fringilla semper.</li>
                            <li>Nam vitae ligula at risus posuere laoreet.</li>
                            <li>Mauris tempor ex id sapien tincidunt porta</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!--//END ADMISSION FORM RULES -->
        <hr />
        <!-- ================ ADMISSION FORM BADGE ================-->
        <section class="admission_form">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 my-5">
                        <img src="images/badge-icon.png" class="img-fluid" alt="#">
                        <h2>Admission Form</h2>
                    </div>
                </div>
                <form action="php/admission.php" method="post" id="admissionform">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row form-group">
                                <div class="col-lg-4">
                                    <label>
                                        Course Name</label>
                                </div>
                                <div class="col-lg-8">
                                    <select class="form-control custom-select" name="course" required>
                                        <option selected="" value="">Select</option>
                                        <option value="select">One</option>
                                        <option value="select">Two</option>
                                        <option value="select">Three</option>
                                        <option value="select">Four</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-4">
                                    <label>
                                        Join date</label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="date" name="join" class="form-control" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-4">
                                    <label>
                                        First name</label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="text" name="first_name" class="form-control" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-4">
                                    <label>
                                        Last name</label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="text" name="last_name" class="form-control" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-4">
                                    <label>
                                        Email address</label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-4">
                                    <label>
                                        Phone</label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="text" name="phone" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-4">
                                    <label>
                                        Date of birth </label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="date" name="dob" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row form-group">
                                <div class="col-lg-4">
                                    <label>
                                        Address</label>
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <input type="text" name="address1" class="form-control" placeholder="City" required>
                                    </div>
                                    <div class="form-group mb-0">
                                        <input type="text" name="address2" class="form-control" placeholder="State" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-4">
                                    <label>
                                        Education</label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="text" name="education" class="form-control" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-4">
                                    <label>
                                        Message</label>
                                </div>
                                <div class="col-lg-8">
                                    <textarea class="form-control" name="message" placeholder="Any other comments?" rows="11"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-default btn-courses mt-4" id="js-admission-btn">Submit Now</button>
                        </div>
                        <div class="col-md-12">
                            <div id="js-admission-result" data-success-msg="Success, Your application has been sent" data-error-msg="Oops! Something went wrong"></div>
                            <!-- // end #js-admission-result -->
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <!--//END ADMISSION FORM BADGE -->
    </div>
    <!-- // end .container -->
    <!--============================= Instagram Feed =============================-->
    <div id="instafeed"></div>
    <!--//END Instagram feed JS -->
    <!--============================= FOOTER =============================-->
   <?php include_once("footer.php"); ?>
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
    <!-- Admission -->
    <script src="js/admission.js"></script>
    <!-- Subscribe -->
    <script src="js/subscribe.js"></script>
    <!-- Script JS -->
    <script src="js/script.js"></script>
</body>

</html>