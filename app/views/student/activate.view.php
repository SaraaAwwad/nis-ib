<?php
require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
require_once HOME_TEMPLATE_PATH . 'header.php';
require_once HOME_TEMPLATE_PATH . 'nav.php';
?>
    <section id="container" >
        <section id="main-content">
            <section class="wrapper">
                <h3><i class="fa fa-angle-right"></i> Change Status</h3>

                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <form class="form-horizontal style-form" method="post">
                                <fieldset>
                                    <legend><?php echo $users->fname . ' ' . $users->lname; ?>'s Status:</legend>
                                    <div class="form-group">
                                        <div class="col-sm-10">
                                            <?php foreach($status as $status){ ?>
                                                <label class="containerradio"><?php echo $status->code; ?>
                                                    <input type="radio" checked="checked" value="<?php echo $status->id; ?>" name="statusinput" required>
                                                    <span class="checkmark"></span>
                                                </label>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </fieldset>
                                <input type="submit" name="activate" id="main">
                                <a href="/student/default" id="cancel">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </section>

<?php
require_once HOME_TEMPLATE_PATH . 'templatefooter.php';
