<?php
    require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
    require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
    require_once HOME_TEMPLATE_PATH . 'header.php';
    require_once HOME_TEMPLATE_PATH . 'nav.php';
    require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
?>

  <h3><i class="fa fa-angle-right"></i> View Students</h3>
  <section class="tabcontent">
    <a class="buttonlink btn btn-theme04 left" href="add_student.php"><i class="fa fa-plus"></i> Add Student</a>
    <input type="search" class="light-table-filter" results="2" name="s" data-table="order-table" placeholder="Search.." />
    <table class="order-table">
      <thead>
        <tr>
          <th>ID</th>
          <th class="hidden-phone">First Name</th>
          <th class="hidden-phone">Last Name</th>
          <th>Gender</th>
          <th>DOB</th>
          <th>Telephone</th>
          <th>Username</th>
          <th>Email</th>
          <th><i class=" fa fa-edit"></i> Status</th>
          <th>Action</th>
        </tr>
<?php
//3ndi variable el students 3shan func el extract in abstract controller 

if(isset($students)){
    foreach($students as $st){
echo '  <tr>
        <td>'.$st->id.'</td>
        <td>'.$st->fname.'</td>
        <td>'.$st->lname.'</a></td>
        <td>'.$st->gender.'</td>
        <td>'.$st->DOB.'</td>
        <td>'.$st->phone.'</td>
        <td>'.$st->username.'</td>
        <td>'.$st->email.'</td>
        <td>'.$st->status.'</td>
        <td> <a href="student\edit\\'.$st->id.'">Edit</a></td>
        </tr>';
 
 }
   echo '</table>'; 
}else{
    echo 'Sorry, No Students';
}

require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
require_once HOME_TEMPLATE_PATH . 'templatefooter.php';
?>