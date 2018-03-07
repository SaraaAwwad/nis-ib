<?php
require_once("../classes/pages.php");
$page = new pages;

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
    <title>Nefertari - Add Page</title>
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

  </head>

  <body>

 <section id="container" >
      <!-- ****************** TOP BAR CONTENT & NOTIFICATIONS **************** -->
      <!--header start-->
      <?php include_once("header.php"); ?>
      <!--header end-->
      
      <!-- ************* MAIN SIDEBAR MENU **************** -->
      <!--sidebar start-->
      <?php include_once("sidemenu.php"); ?>
      <!--sidebar end-->
      <!-- ************ MAIN CONTENT **************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
            <h3><i class="fa fa-angle-right"></i> Add Page:</h3>
            <div class="row mt">
                <div class="col-lg-12">
                 <form action="" method="POST"  enctype="multipart/form-data">
               
                 <label class="form-group col-md-1"><B>Friendly Name: </B></label>
                  <div class="col-sm-2">
                        <input type="text" class="form-control" name="friname" id="friname">
                  </div>
                  <label class="form-group col-md-1"><B>Physical Name: </B></label>
                  <div class="col-sm-2">
                        <input type="text" class="form-control" name="physname" id="physname">
                  </div>
                  <label class="form-group col-md-1"><B>Status: </B></label>
                  <select class="selectpicker" name="statuspicker">
                  <option value ="1">publish</option>
                  <option value = "0">hide</option>
                  </select>


                  <div>
                  <br />
                  <br />
                     <textarea name="editor1">Initial value</textarea>
                     <script type="text/javascript">
                        CKEDITOR.replace( 'editor1' );
                     </script>
                     <input type="submit" name="add" id="saverest" value="Add"/>
                  
               </form>

             </div>
                </div>
            </div>
            
        </section><! --/wrapper -->
      </section>
      <?php
      if(isset($_POST['add'])){

        $fn =  $_POST['friname'];
        $pn =  $_POST['physname'];
        $stat = $_POST['statuspicker'];
        $content = $_POST['editor1']; 
        $result =  $page->insertpage($fn , $pn, $content);
        if($result)
        {
          $msg='<div class="alert alert-success">Thank You! I will be in touch</div>';
          echo $msg;
        }else{

          $msg='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later</div>';
          echo $msg;

        }
      }?>
  

      <!--footer start-->
      <?php include_once("footer.php");?>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="assets/js/jquery.ui.touch-punch.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    

    <!--script for this page-->
    
  <script>
      
//custom select box
      $(function(){
          $('select.styled').customSelect();
      });              

  </script>

  </body>
</html>
