<?php
    use PHPMVC\Views\ScheduleView;
    require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
?>  
    <script type="text/javascript" src="<?=PDF?>jspdf.debug.js"></script>
<?php
    require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
    require_once HOME_TEMPLATE_PATH . 'header.php';
    require_once HOME_TEMPLATE_PATH . 'nav.php';
    require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
   
    $schedView = new ScheduleView();
    $schedView->scheduleStudent($sched);
?>

<?php
    require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
    require_once HOME_TEMPLATE_PATH . 'templatefooter.php';