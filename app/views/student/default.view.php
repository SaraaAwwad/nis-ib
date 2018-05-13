<?php
    require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
    require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
    require_once HOME_TEMPLATE_PATH . 'header.php';
    require_once HOME_TEMPLATE_PATH . 'nav.php';
    require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
?>

  <script src="../../../public/assets/js/staff.js"></script>
  <h3><i class="fa fa-angle-right"></i> View Students</h3>
  <section class="tabcontent">
      <input type="search" class="searchtab light-table-filter" results="2" name="s" data-table="order-table" placeholder="Search.." />
      <table class="order-table">
      <thead>
        <tr>
          <th>ID</th>
          <th class="hidden-phone">Full Name</th>
          <th>Gender</th>
          <th>DOB</th>
          <th>Telephone</th>
          <th>Username</th>
          <th>Email</th>
          <th>Grade</th>
          <th></i> Status</th>
          <th>Guardian's Name</th>
          <th>Phone</th>
          <th>Email</th>
          <th>Action</th>
        </tr>

<?php
//3ndi variable el students 3shan func el extract in abstract controller 

if(isset($students)){
    foreach($students as $st){
echo '  <tr>
        <td>'.$st->id.'</td>
        <td>'.$st->fname.' '.$st->lname.'</td>
        <td>'.$st->gender.'</td>
        <td>'.$st->DOB.'</td>
        <td>'.$st->phone.'</td>
        <td>'.$st->username.'</td>
        <td>'.$st->email.'</td>
        <td>'.$st->grade_name.' Grade</td>
        <td><span class="label label-info label-mini">'.$st->code.'</span></td>
        <td>'.$st->parent_fname.' '.$st->parent_lname.'</td>
        <td>'.$st->parent_phone.'</td>
        <td>'.$st->parent_email.'</td>
        <td  colspan="2">
            <a class="btn btn-success btn-xs" href="\student\edit\\'.$st->id.'"><i class="fa fa-pencil-square-o"></i></a>
            <a class="btn btn-success btn-xs" href="\student\activate\\'.$st->id.'"><i class="fa fa-unlock"></i></a>
        </td>
        </tr>';
 
 }
   echo '</table>'; 
}?>

<section class="tabcontent">    
<div class="row">
<div class="col-lg-12 main-chart">
<a class="buttonlink btn btn-theme02 left" href="/student/upgrade"><i class="fa fa-plus"></i>Upgrade Students</a>
</div>
</div>
</section>

<?php
require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
require_once HOME_TEMPLATE_PATH . 'templatefooter.php';
?>