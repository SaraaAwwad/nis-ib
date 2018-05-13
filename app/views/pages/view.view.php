<?php
    require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
    require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
    require_once HOME_TEMPLATE_PATH . 'header.php';
    require_once HOME_TEMPLATE_PATH . 'nav.php';
    require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
    ?>
    <div class="row mt">
    <div class="col-lg-12">
        <div class="form-panel">
   <?php 
        if($page !=""){
               $html = $page->html;
                echo htmlspecialchars_decode(stripslashes($html));
        }
    ?>
    </div></div></div>    
    <?php
    require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
    require_once HOME_TEMPLATE_PATH . 'templatefooter.php';