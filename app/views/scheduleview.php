<?php
namespace PHPMVC\Views;

class ScheduleView{

    public function schedulePDF(){

    } 

    public function editSched($class, $semester, $status, $sched){
        
        echo '<div class="row mt info">
              <div class="col-lg-12">
                  <div class="form-panel">
                      <form class="form-horizontal style-form" method="post">
                        
                          <legend>Schedule Info</legend>

                         <div class="form-group">                               
                              <label class="col-sm-2 col-sm-2 control-label">Class</label>
                              <div class="col-sm-8">
                                <select name="class" class="form-control class">
                                    <option value="" disabled>Select Class</option>
                                    
                                    ';
                                        foreach($class as $classname){
                                            if($classname->id == $sched->class_id_fk){
                                                echo '<option selected value='.$classname->id.'>'.$classname->name.'</option>';                                                    
                                            }else{
                                                echo '<option value='.$classname->id.'>'.$classname->name.'</option>';                                                
                                            }
                                        }
                                echo'
                                </select>
                              </div>
                          </div>

                          <div class="form-group">                               
                              <label class="col-sm-2 col-sm-2 control-label">Semester</label>
                              <div class="col-sm-8">
                                <select name="semester" class="form-control semester" >
                                    <option value="" disabled>Select Semester</option>
                                    '; 
                                        foreach($semester as $st){
                                            if($st->id == $sched->semester_id_fk){
                                                echo '<option selected value='.$st->id.'>'.$st->season_name .' - '.$st->year.'</option>';                                                
                                            }else{
                                            echo '<option value='.$st->id.'>'.$st->season_name .' - '.$st->year.'</option>';                                                
                                            }
                                        }
                                  echo  '
                                </select>
                              </div>
                          </div>

                          <div class="form-group">                               
                              <label class="col-sm-2 col-sm-2 control-label">Status</label>
                              <div class="col-sm-8">
                                <select name="status" class="form-control semester" >
                                    <option value="" disabled>Select Status</option>
                                    ';
                                        foreach($status as $st){
                                           if($st->id == $sched->status_id_fk){
                                            echo '<option selected value='.$st->id.'>'.$st->code.'</option>';
                                           }else{
                                            echo '<option value='.$st->id.'>'.$st->code.'</option>';                                               
                                           }
                                        }
                                   echo '
                                </select>
                              </div>
                          </div>
                        
                        </fieldset>
                        <input type="submit" class="addSched" name="editSched" id="main">
                      </form>
                  </div>
              </div>      
            </div> ';

    }
}