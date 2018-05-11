<?php
    require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
    require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
    require_once HOME_TEMPLATE_PATH . 'header.php';
    require_once HOME_TEMPLATE_PATH . 'nav.php';
    require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
    use PHPMVC\Views\CourseView;
    use PHPMVC\Views\SemesterView;

    $cv = new CourseView();
    $s = new SemesterView();
    $cv->title();
?>
    
    <div class="row mt info">
        <div class="col-lg-12">
            <div class="form-panel">
                <form class="form-horizontal style-form" id="form" method="post">
                <div class="container">
                        
                        <div class="form-group ">                               
                            <?= $cv->getAllReq($Req); ?>

                            <label class="col-sm-1 col-sm-1 control-label">Title</label> 
                               <div class="col-sm-3">
                               <input name="cwName" type="text" class="form-control" required>
                               </div>

                               <label class="col-sm-1 col-sm-1 control-label">Semester</label> 
                               <div class="col-sm-3">
                                 <?= $s->getAllSemester($semester); ?>
                                 </div>
                            </div>
                    

                        <div id="dynamicform" class="row">
                        </div>
                </div>
                <input type="submit" name="submitdynamicform" id="main">
                </form>
            </div>
        </div>
    </div>



<script>  
 $(document).ready(function(){  
    var pathname = window.location.pathname;
    
    $("#Req").on('change',function(e){
        e.preventDefault();
        e.stopPropagation();

        $.ajax({  
                url:pathname,  
                method:'POST',  
                dataType:'json',
                data:{  
                    req: $("#Req").val(),
                    action:"getForm"
                },  
                success:function(data)  
                {  
                  $('#dynamicform').html('');

                  $.each(data, function (i, data) {
                    
                       $('<div class="form-group col-lg-12">'+                               
                        data+
                        '</div>').appendTo("#dynamicform");
                    });
                
                }, 
                error: function (jqXHR, exception) {
				        var msg = '';
				        if (jqXHR.status === 0) {
				            msg = 'Not connect.\n Verify Network.';
				        } else if (jqXHR.status == 404) {
				            msg = 'Requested page not found. [404]';
				        } else if (jqXHR.status == 500) {
				            msg = 'Internal Server Error [500].';
				        } else if (exception === 'parsererror') {
				            msg = 'Requested JSON parse failed.';
				        } else if (exception === 'timeout') {
				            msg = 'Time out error.';
				        } else if (exception === 'abort') {
				            msg = 'Ajax request aborted.';
				        } else {
				            msg = 'Uncaught Error.\n' + jqXHR.responseText;
				        }
				        alert(msg);
   				    },  
                });  
        });

    
 });

 </script>
<?php
    require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
    require_once HOME_TEMPLATE_PATH . 'templatefooter.php';