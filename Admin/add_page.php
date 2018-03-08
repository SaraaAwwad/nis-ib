<?php
require_once("../classes/pages.php");

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
      <?php include_once("side.php"); ?>
      <!--sidebar end-->
      <!-- ************ MAIN CONTENT **************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
            <h3><i class="fa fa-angle-right"></i> Add Page:</h3>
                  <?php
      if(isset($_POST['add'])){

        $fn =  $_POST['friname'];
        $pn =  $_POST['physname'];
        $stat = $_POST['statuspicker'];
        $content = $_POST['editor1']; 

        //choose   
        switch($_POST['optradio']) {
        case "exist":
            $value = $_POST['grouppicker'];
            break;
        case "notexist":
            $value = 0;
            break;
    	}

        $result =  Pages::insertPage($fn , $pn, $content, $value, $stat);
        if($result)
        {
          $msg='<div class="alert alert-success">Thank You! I will be in touch</div>';
          echo $msg;
        }else{

          $msg='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later</div>';
          echo $msg;

        }
      }?>
            <div class="row mt">
                
                 <form action="" method="POST"  enctype="multipart/form-data">
               <div class="col-lg-12">
                 <label class="form-group col-md-1"><B>Friendly Name: </B></label>
                  <div class="col-sm-3">
                        <input type="text" class="form-control" name="friname" id="friname">
                  </div>
                  <label class="form-group col-md-1"><B>Physical Name: </B></label>
                  <div class="col-sm-3">
                        <input type="text" class="form-control" name="physname" id="physname">
                  </div>

                  <label class="form-group col-md-1"><B>Status: </B></label>
                  <select class="selectpicker" name="statuspicker">
                  <option value ="1">Publish</option>
                  <option value = "0">Hide</option>
                  </select>

                 </div>

                  <div class="col-lg-12">
                  	<label class="form-group col-md-1"><B>Category:</B></label>
                   	<label class="radio-inline">
      					<input type="radio" name="optradio" value="exist" >Add to an Existing Group:
		      			
		      				<?php 
		      					$pages = Pages::getAllGroupPages(); 
		      					echo '<select class="selectpicker" name="grouppicker">';
		      					for ($i=0; $i<count($pages); $i++){
		      						echo '<option value="'.$pages[$i]->id.'">'.$pages[$i]->friendlyname.'</option>' ;
		      					}
		      					echo '  </select>';
		      				?>
		               
    				</label>
    				<label class="radio-inline">
      					<input type="radio" name="optradio" value="notexist" checked="checked" >Add to a New Group
    				</label>

                  </div>
                  	<div class="row"></div>
                  <br />
                  <div class="col-lg-12">
                     <textarea name="editor1">Initial value</textarea>
                     <script type="text/javascript">
                        CKEDITOR.replace( 'editor1' );
                     </script>
                     <input type="submit" name="add" id="saverest" value="Add"/>
                  </div>
               </form>

             </div>
                </div>
            </div>
            
        </section><! --/wrapper -->
      </section>

  

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
