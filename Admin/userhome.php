<?php 
session_start(); 
/*if(!isset($_SESSION["userID"])){
    echo 'sorry you cant view this page'; 
    exit();
}
else{
    $userID = $_SESSION["userID"];
    $userObj = new User($userID);

    for ($i=0;$i<count($userObj->UserTypeObj->UserPages);$i++)
    {
       /* if ($userObj->UserTypeObj->UserPages[$i]->Linkaddress!="")
        {
        echo 	"<br><a href=".$UseObject->UserType_obj->ArrayOfPages[$i]->Linkaddress.">".$UseObject->UserType_obj->ArrayOfPages[$i]->FreindlyName."</a>";
        
        }
        else
        {
            echo "<br><a href=displayArticleController.php?ID=".$UseObject->UserType_obj->ArrayOfPages[$i]->ID.">".$UseObject->UserType_obj->ArrayOfPages[$i]->FreindlyName."</a>";
            
        }
        echo 'hello';
    }
}*/
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-daterangepicker/daterangepicker.css" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
  </head>

  <body>

  <section id="container" >
      <!-- TOP BAR CONTENT & NOTIFICATIONS-->
      <!--header start-->
      <?php include_once("header.php"); ?>
      <!--header end-->
      
      <!--MAIN SIDEBAR MENU-->
      <!--sidebar start-->
      <?php include_once("side.php"); ?>
      <!--sidebar end-->
      
      <!-- MAIN CONTENT-->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
            
    <div class="form-panel">
            <div class="row mt">
              <div class="col-lg-12">
                          
            <form name="assign" method="POST" action="" class="form-horizontal style-form">
            <legend>Assign Pages</legend>
            <select name="Pages[]" id ="fromopt" style="color: red; width: 200px; height: 150px;" multiple>
            <?php 
                for ($i=0; $i< count($allPages); $i++){
                    echo '<option value="'.$allPages[$i]->id.'" >'.$allPages[$i]->friendlyname.'</option>';
                }
            ?>

            
    </select>
    <button type="button" id="from"> << </button>    
    <button type="button" id="to"> >> </button>
    <select id="toopt" name="SelectedPages[]" style="color: red; width: 200px; height: 150px;" multiple>    </select>
    <br/>
    </div>
   </div>
    
    <div class="row mt">
    <div class="col-lg-12">
        <select name="usertype" id ="type">
            <?php 
                for ($i=0; $i< count($allTypes); $i++){
                    echo '<option value="'.$allTypes[$i]->id.'" >'.$allTypes[$i]->title.'</option>';
                }
            ?>
        </select>
    
        <input type="submit" value="Submit" name="submit">
    </div>


</div>
</div>
</form>
</section>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


  <!-- js placed at the end of the document so the pages load faster -->
  <script src="assets/js/jquery.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
  <script src="assets/js/jquery.scrollTo.min.js"></script>
  <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


  <!--common script for all pages-->
  <script src="assets/js/common-scripts.js"></script>
  <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>
  <script src="assets/js/bootstrap-switch.js"></script>
  <script src="assets/js/jquery.tagsinput.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap-daterangepicker/date.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
  <script src="assets/js/form-component.js"></script>

</body>
</html>

