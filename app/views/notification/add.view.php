<?php
require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
require_once HOME_TEMPLATE_PATH . 'header.php';
require_once HOME_TEMPLATE_PATH . 'nav.php';

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<section id="container" >
    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i>Send Notification</h3>

            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <form class="form-horizontal style-form" method="post" id="comment_form">

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Recipient</label>
                                <div class="col-sm-4">
                                    <select name="recipient" id="recipient" class="form-control class" required>
                                        <option value="" selected="selected" disabled="disabled">Select Recipient</option>
                                        <?php
                                        foreach($usertype as $usertypes){
                                            echo '<option value='.$usertypes->id.'>'.$usertypes->title.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Enter Subject</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="subject" required>
                                    </div>
                                </div>

                            <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Enter Comment</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="comment" rows="7" cols="10" required></textarea>
                                    </div>
                            </div>

                                <button id="buttonkite" name="addnotification">
                                    <span>SEND</span>
                                    <i id="fabutton" class="fa fa-paper-plane fa-lg replace"></i>
                                    <i id="fabutton" class="fa fa-paper-plane plane fa-lg hidden"></i>
                                </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </section>
</section>
<?php
require_once HOME_TEMPLATE_PATH . 'templatefooter.php'; ?>
