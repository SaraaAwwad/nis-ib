<?php
namespace PHPMVC\Views;

class ClassView{

    public function editClass($status, $grade, $class){
        echo '<div class="row">
        <div class="col-lg-9 main-chart">
            <h1>Add A New Class</h1>
            <hr>
		</div>
	    </div>	

        <div class="row mt">
              <div class="col-lg-12">
                  <div class="form-panel">
                      <form class="form-horizontal style-form" method="post">
                        
                          <legend>Class Info</legend>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Class Name</label>
                              <div class="col-sm-8">
                                  <input name="name" type="text" class="form-control" value="'.$class->name.'" required>
                              </div>
                          </div>

                          <div class="form-group">                               
                              <label class="col-sm-2 col-sm-2 control-label">Status</label>
                              <div class="col-sm-8">
                                <select name="status" class="form-control" id="status">
                                    <option value="" disabled>Select Status</option>';
                                    
                                    foreach($status as $st){
                                        if($st->id == $class->status_id_fk){
                                            echo '.<option selected value='.$st->id.'>'.$st->code.'</option>.'; 
                                        }else{
                                            echo  '.<option value='.$st->id.'>'.$st->code.'</option>.';
                                        }
                                      
                                    }
                            echo '
                                </select>
                              </div>
                          </div>

                            <div class="form-group">                               
                              <label class="col-sm-2 col-sm-2 control-label">Grade</label>
                              <div class="col-sm-8">
                                <select name="grade" class="form-control">
                                    <option value="" disabled>Select Grade</option>'; 
                                        foreach($grade as $g){
                                            if($g->id == $class->grade_id_fk){
                                                echo '<option selected value='.$g->id.'>'.$g->grade_name.'</option>.';
                                            }else{
                                            echo '<option value='.$g->id.'>'.$g->grade_name.'</option>.';                                                
                                            }
                                        }
                                 echo   '
                                </select>
                              </div>
                            </div>

                        </fieldset>
                        <input type="submit" name="editclass" id="main">
                      </form>
                  </div>
              </div>      
            </div>';
    }
}