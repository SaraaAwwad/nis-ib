<?php
require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
require_once HOME_TEMPLATE_PATH . 'header.php';
require_once HOME_TEMPLATE_PATH . 'nav.php';

?>

    <section id="container" >
        <section id="main-content">
            <section class="wrapper">
                <h2>Inbox <i class="fa fa-envelope-o"></i></h2>

                <section class="tabcontent">
                    <inbox>
                        <inbox-list>
                            <?php if (is_array($notifications) || is_object($notifications)){
                            foreach($notifications as $notifi){ ?>
                            <message-item class="unread">
                                <header>
                                    <div class="sender-info">
                                        <span class="subject"><?php echo $notifi->title; ?></span>
                                        <span class="from"><?php echo $notifi->fname . ' ' .$notifi->lname; ?></span>
                                    </div>
                                    <span class="time"><?php echo $notifi->created_at; ?></span>
                                </header>
                                <main id="mainp">
                                    <p><?php echo $notifi->body; ?></p>
                                </main>
                            </message-item>
                            <?php }} ?>
                        </inbox-list>
                    </inbox>
                </section>
            </section>
        </section>
    </section>
<?php
require_once HOME_TEMPLATE_PATH . 'templatefooter.php';
