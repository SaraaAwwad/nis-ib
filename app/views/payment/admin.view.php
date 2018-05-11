<?php
require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
require_once HOME_TEMPLATE_PATH . 'header.php';
require_once HOME_TEMPLATE_PATH . 'nav.php';
require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
?>

    <h3><i class="fa fa-angle-right"></i> View Payments</h3>
    <section class="tabcontent">
<!--        <input type="search" class="searchtab light-table-filter" name="search" data-table="order-table" placeholder="Search ..." />-->
        <table class="order-table">
            <thead>
            <tr>
                <th>ID</th>
                <th class="hidden-phone">Name</th>
                <th>Username</th>
                <th>Grade</th>
                <th>Semester</th>
                <th>Amount</th>
                <th>Currency</th>
                <th><i class=" fa fa-edit"></i> Status</th>
                <th>Action</th>
            </tr>

<?php

if(isset($payment)){
    foreach($payment as $pay){
        echo '  <tr>
        <td>'.$pay->id.'</td>
        <td>'.$pay->studentObj->fname.' '.$pay->studentObj->lname.'</td>
        <td>'.$pay->studentObj->username.'</a></td>
        <td>'.$pay->studentObj->gradeObj->grade_name.'</td>
        <td>'.$pay->semesterObj->season_name.'</td>    
        <td>'.$pay->amount.'</td> 
        <td>'.$pay->currency_val.'</td>';
        if($pay->status_id_fk == $pending) {
            echo '<td><span class="label label-warning label-mini">'.$pay->status_val.'</span></td>';
        }else{
            echo '<td><span class="label label-info label-mini">'.$pay->status_val.'</span></td>';
        }
        echo '<td  colspan="2">
            <a class="btn btn-success btn-xs" href="\payment\edit\\'.$pay->id.'"><i class="fa fa-pencil-square-o"></i></a>
            <a class="btn btn-primary btn-xs" href="\payment\invoice\\'.$pay->id.'"><i class="fa fa-eye"></i></a>
            </td>
        </td>
        </tr>';

    }
    echo '</table>';
}else{
    echo 'Sorry, No Payment found';
}

require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
require_once HOME_TEMPLATE_PATH . 'templatefooter.php';
?>