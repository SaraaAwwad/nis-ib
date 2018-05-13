<footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="subscribe">
                        <h3>Newsletter</h3>
                        <form id="subscribeform" action="php/subscribe.php" method="post">
                            <input class="signup_form" type="text" name="email" placeholder="Enter Your Email Address">
                            <button type="submit" class="btn btn-warning" id="js-subscribe-btn">SUBSCRIBE</button>
                            <div id="js-subscribe-result" data-success-msg="Success, Please check your email." data-error-msg="Oops! Something went wrong"></div>
                            <!-- // end #js-subscribe-result -->
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="foot-logo">
                        <a href="index.html">
                            <img src="<?= IMG ?>nib_logo.png" class="img-fluid" alt="footer_logo">
                        </a>
                        <p>2018 © copyright
                            <br> All rights reserved.</p>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="address">
                            <h3>Contact us</h3>
                            <p><span>Address: </span> Km 22 Ismailia desert road -Left side , Cairo</p>
                            <p>Email :  nlsinfo@niscl.com
                                <br> Telephone :  26562521– 26562522 - 26562526 -01066682298</p>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

            <script src="<?= JS ?>jquery.min.js"></script>
            <script src="<?= JS ?>tether.min.js"></script>
            <script src="<?= JS ?>bootstrap.min.js"></script>
            <!-- Plugins -->
            <script src="<?= JS ?>slick.min.js"></script>
            <script src="<?= JS ?>waypoints.min.js"></script>
            <script src="<?= JS ?>counterup.min.js"></script>
            <script src="<?= JS ?>instafeed.min.js"></script>
            <script src="<?= JS ?>owl.carousel.min.js"></script>
            <script src="<?= JS ?>validate.js"></script>
            <script src="<?= JS ?>tweetie.min.js"></script>
            <!-- Subscribe -->
            <script src="<?= JS ?>subscribe.js"></script>
            <!-- Script JS -->
            <script src="<?= JS ?>script.js"></script>
</body>
</html>