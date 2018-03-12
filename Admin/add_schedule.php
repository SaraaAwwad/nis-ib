<?php
require_once("../classes/weekdays.php");
require_once("../classes/slot.php");
require_once("../classes/room.php");

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
            <h3><i class="fa fa-angle-right"></i> Add To Schedule</h3>
            
            <!-- BASIC FORM ELELEMNTS -->
            <div class="row mt">
              <div class="col-lg-12">
                  <div class="form-panel">
                      <form class="form-horizontal style-form" method="get">
                        
                          <legend>Date Information</legend>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Section</label>
                              <div class="col-sm-10">
                                  <input class="form-control" id="disabledInput" type="text" disabled>
                              </div>
                          </div>
                          <div class="form-group"  id ="new">

                              <label class="col-sm-2 col-sm-2 control-label">Day</label>
                              <div class="weekDays-selector">
                               <select class="selectpicker" name="dayspicker">

                              	<?php

                                $result = array();
                                $result = Weekdays::getWeekdays();
                                for($i=0; $i<count($result); $i++){ 
                                	 echo ' <option value ='.$result[$i]->id.'>'.$result[$i]->day_name.'</option>';
                                	
                                }
                                ?>
                                </select>

                              </div>
                              <br/>
                              <label class="col-sm-2 col-sm-2 control-label">Slot</label>
                              <div class="slot-selector">
                              <select>
                              	<?php
                                $result = array();
                                $result = slot::getSlots();
                                for($i=0; $i<count($result); $i++){ 
                                 echo ' <option value ='.$result[$i]->slotName.'>'.$result[$i]->startTime.' - '.$result[$i]->endTime.'</option>';
                                	
                                }
                                ?>
                              </select>
                         	  </div>
                         	  <br/>
                         	  <label class="col-sm-2 col-sm-2 control-label">Room Number</label>
                              <div class="room-selector">
                              <select>
                              	<?php
                                $result = array();
                                $result = Room::getRoom();
                                for($i=0; $i<count($result); $i++){ 
                                 echo ' <option value ='.$result[$i]->id.'>'.$result[$i]->roomName.' </option>';
                                	
                                }
                                ?>
                              </select>
                          </div>
                    		   
                          <a class="btn btn-primary pull-right" class="pull-left"  id="adding"><i class="fa fa-plus"></i> Add </a>
                          </div>
                          <legend>Register Students</legend>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Students</label>
                              <select multiple>
                              <option></option>
                              </select>
                          </div>

                          <input type="submit" id="main">
                      </form>
                  </div>
              </div><!-- col-lg-12-->       
            </div><!-- /row -->
            
       
            
    </section><!--/wrapper -->
    </section><!-- /MAIN CONTENT -->
  </section>

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
  <script>
    $(function(){  
  $('input[type="time"][value="now"]').each(function(){    
    var d = new Date(),        
        h = d.getHours(),
        m = d.getMinutes();
    if(h < 10) h = '0' + h; 
    if(m < 10) m = '0' + m; 
    $(this).attr({
      'value': h + ':' + m
    });
  });
});

	$("#adding").click(function(){
		
		 $("#new").append("<hr/><div class=\"form-group-center\" id =\"new\"><label class=\"col-sm-2 col-sm-2 control-label\">Day</label><div class=\"weekDays-selector\"><select class=\"selectpicker\" name=\"dayspicker\"></select></div><br/><label class=\"col-sm-2 col-sm-2 control-label\">Slot</label><div class=\"slot-selector\"><select></select></div><br/><label class=\"col-sm-2 col-sm-2 control-label\">Room Number</label><div class=\"room-selector\"><select></select></div>");
    
	});
  </script>
  </body>
</html>
