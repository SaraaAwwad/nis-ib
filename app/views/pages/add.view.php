<?php
    require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
    require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
    require_once HOME_TEMPLATE_PATH . 'header.php';
    echo '<script type="text/javascript" src="'.CKEDITOR.'ckeditor.js"></script>';
    require_once HOME_TEMPLATE_PATH . 'nav.php';
    require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
?>

    <div class="row">
        <div class="col-lg-9 main-chart">
            <h1>Add A New Page</h1>
            <hr>
		</div>
	</div>	

        <div class="row mt">
              <div class="col-lg-12">
                  <div class="form-panel">
                      <form class="form-horizontal style-form" method="post">
                        
                          <legend>Page Info</legend>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Friendly Name: </label>
                              <div class="col-sm-8">
                                  <input name="friendlyname" type="text" class="form-control" required>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Physical Name: </label>
                              <div class="col-sm-8">
                                  <input name="physicalname" type="text" id="url" class="form-control" required>
                              </div>
                          </div>

                          <div class="form-group">                               
                              <label class="col-sm-2 col-sm-2 control-label">Status</label>
                              <div class="col-sm-8">
                                <select name="status" class="form-control" id="status">
                                    <option value="" disabled>Select Status</option>
                                    <?php 
                                        foreach($status as $st){
                                            echo '<option value='.$st->id.'>'.$st->code.'</option>';
                                        }
                                    ?>
                                </select>
                              </div>
                          </div>

                        
                        <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Category</label>
                            <label class="radio-inline">
                            <div class="col-lg-12">
                            <div class="col-lg-8">
                                <input type="radio" name="optradio" value="1" >Add to an Existing Group:
                                 <select class="selectpicker" name="grouppicker">
                                    <?php 
                                     foreach ($pages as $pt){
                                         echo '<option value="'.$pt->id.'">'.$pt->id.'- '.$pt->friendlyname.'</option>' ;
                                     }
                                     ?>
                                </select>
                            </label>
                            </div>
                            <div class="col-lg-4">
                            <label class="radio-inline">
                                <input type="radio" name="optradio" value="notexist" checked="checked" >Add to a New Group
                            </label>
                            </div>
                            </div>                            
                        </div>

                    <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Content</label>
                        <div class="col-sm-8">
                        <input type="checkbox" id="cb" name="content" checked>
                        <label for="cb">Add Content</label>
                        <textarea class="form-control" name="editor1" id ="editor1" style="display:none;">Initial value</textarea>
                        </div>
                     </div>

                     </fieldset>
                        <input type="submit" name="addpage" id="main">
                      </form>
                  </div>
              </div>      
            </div>

 <script>
     $(document).ready(function(data){
        CKEDITOR.replace( 'editor1', {height: "220px"});        
        $("#url").prop("readonly", true);
        $("#url").val("/pages/view/");

        $('#cb').change(function() {
        if(this.checked) {
            CKEDITOR.replace( 'editor1', {height: "220px"});           
            $("#url").prop("readonly", true);
            $("#url").val("/pages/view/");       
        }else{
            if(typeof CKEDITOR.instances['editor1'] != 'undefined') {
                CKEDITOR.instances['editor1'].updateElement();
                CKEDITOR.instances['editor1'].destroy();
            $('#editor1').hide();
            $("#url").prop("readonly", false);
            $("#url").val("");    
            } 
            
        }     
    });
});

</script>    
<?php
    require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
    require_once HOME_TEMPLATE_PATH . 'templatefooter.php';