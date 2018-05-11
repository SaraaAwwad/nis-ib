<?php
    require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
    ?>
    <style>
    .divgroup{
        margin:25px;
        padding: 15px;
        background-color:#efeff5;
    }
    </style>
    <?php 
    require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
    require_once HOME_TEMPLATE_PATH . 'header.php';
    require_once HOME_TEMPLATE_PATH . 'nav.php';
    require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
    use PHPMVC\Views\CourseView;
    $cv = new CourseView();
?>

    <div class="row">
        <div class="col-lg-9 main-chart">
            <h1> Add A New CourseWork </h1>
            <hr>
		</div>
	</div>	


 <div class="row mt info">
              <div class="col-lg-12">
                  <div class="form-panel">
                      <form class="form-horizontal style-form" method="post" id="insert_form">
                        
                          <legend>Course Work Info</legend>

                         <div class="form-group">                               
                              <label class="col-sm-3 col-sm-3 control-label">Course Work Requirement</label>
                              <div class="col-sm-4">
                                  <input name="coursework" type="text" class="form-control" required>                                    
                              </div>
                        </div>

        <div class="form-group">
        <label class="col-sm-3 col-sm-3 control-label">Select From Existing Attributes</label>
        <div class="col-lg-9">
            <select class="form-control" style="height:100px;" name="attr[]" multiple>
                <option value="" disabled>(Optional)</option>            
                 <?= $cv->preCourseWorkAttr($preAttr); ?>
            </select>
        </div>
    </div>

                        <div class="form-group container" id="dynamic_field"> 

                             <div class="row mt optrow" id="row0">                            
                                <div class="col-lg-12">
                                  <label class="col-sm-1 col-sm-1 control-label">Label</label>
                                    <div class="col-sm-4">
                                        <input name="name[]" type="text" class="form-control" required>
                                    </div>

                                    <label class="col-sm-1 col-sm-1 control-label">Type</label>
                                    <div class="col-sm-4">
                                        <select name="type[]" id="0" class="form-control choice" required>
                                            <option value="" disabled>Select Type</option>
                                            <?= $cv->newCourseWorkType($type); ?>
                                        </select>
                                    </div>

                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-success btn-sm" id="add"> + Add More</button>                              
                                    </div>

                                     
                                </div>
                            </div>

                                    <div class="col-lg-12 divgroup" style="display:none;" id="div0" >
                                    </div>
                    
                        </div>
                      
                        </fieldset>
                        <input type="submit" name="newcoursework" id="main">
                      </form>
                  </div>
              </div>      
            </div>

<script>
$(document).ready(function(){  
    var pathname = window.location.pathname;     
    var htmloption = '';
    htmloption += "<?php echo $cv->newCourseWorkType($type);  ?>";
    var i=1;  
    var j=0;

      $('#add').click(function(){  
           
         $('#dynamic_field').append('<div class="row optrow" id="row'+i+'" > <div class="col-lg-12"> <label class="col-sm-1 col-sm-1 control-label">Label</label><div class="col-sm-4"><input name="name[]" placeholder="Enter Label" type="text" class="form-control" required>  </div>'+
         '<label class="col-sm-1 col-sm-1 control-label">Type</label><div class="col-sm-4">'
         +'<select name="type[]" id="'+i+'" class="form-control choice" required>'
         +htmloption+'</select></div>'+
         '<div class="col-sm-2"><button type="button" class="btn btn-danger btn_remove btn-sm optrmv" id="'+i+'"> X </button></div></div></div>');
        
        $('#dynamic_field').append('<div class="row divgroup"  style="display:none;" id="div'+i+'" >' +
        '</div>')

          i++;  

        $(".firstreq").prop('required',true);
        });

      $(document).on('click', '.optrmv', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
           $('#div'+button_id+'').remove();  
            var k = 0;
            i--;

            if(i==1){
                $(".firstreq").prop('required',false);
            }

            $(".optrow").each(function(){
                $(this).attr("id","row"+k);
                k++;
            });
            
            k=0;
            $(".choice").each(function(){
                $(this).attr("id",k);
                k++;
            });

            k=1;

            $(".optrmv").each(function(){
                $(this).attr("id",k);
                k++;
            });

            k=0;
           $(".divgroup").each(function() {
                $(this).attr("id","div"+k);
                k++;
            });

            k=0;
           $(".multigroup").each(function() {
                var id = $(this).parent().parent().attr('id'); //id here will be div(num)
                id = id.replace('div',''); //remove div
                $(this).attr("name",id+"options[]");
                k++;
            });

            $(".addopt").each(function() {
                var id = $(this).parent().parent().attr('id'); //id here will be div(num)
                id = id.replace('div',''); //remove div
                $(this).attr("id","add"+id);
                k++;
            });


      });

     $(document).on('change', '.choice', function(){
        var id = $(this).attr('id');
       
        var divId = "#div"+id;
        $(divId).html('');
    

        var val =  $(this).val(); 

        var txt = $(this).find("option:selected").text();
        
       // var typeid;
        
        $.ajax({  
                url:pathname,  
                method:'POST',  
                dataType:'json',
                data:{  
                    txt: txt,
                    action:"getType"
                },  
                success:function(data)  
                {  
                    typeid = data.typeflag;
                   addopt(typeid, id, divId);
                },  
                });  

     });

     function addopt(typeid, id, divId){
        if(typeid == 1){
            $(divId).css('display', 'block');
         
            $(divId).append('<div><button type="button" class="btn btn-success btn-sm addopt" id="add'+i+'"> Add option </button></div>'
            +'<div><label class="col-sm-1 col-sm-1 control-label">Option </label>'
            +'<input name="'+id+'options[]" placeholder="Enter Option" type="text" class="form-control multigroup" required></div>');

            $(divId).append('<div><label class="col-sm-1 col-sm-1 control-label">Option </label>'
            +'<input name="'+id+'options[]" placeholder="Enter Option" type="text" class=" form-control multigroup" required></div>');

        }else{
            $(divId).css('display', 'none');
        }
     }

     $(document).on('click', '.addopt', function(){
        var pid = $(this).parent().parent().attr('id'); //here is div-id
        var divId ="#"+ pid;
        var optid = pid.replace('div','');
        $(divId).append('<div id="col'+j+'"><label class="col-sm-1 col-sm-1 style="display:inline;" control-label">Option</label>'
            +' <input name="'+optid+'options[]" placeholder="Enter Option" type="text" style="display:inline;" class="form-control multigroup" required>'+
            '<button type="button" class="btn btn-danger btn_remove btn-sm insidermv"  style="display:inline;" id="'+j+'"> X </button></div>');
            j++;
     });

     $(document).on('click', '.insidermv', function(){
       
        var col_id = $(this).attr('id');
        $("#col"+col_id+'').remove();

     });

 });
 </script>
<?php
    require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
    require_once HOME_TEMPLATE_PATH . 'templatefooter.php';