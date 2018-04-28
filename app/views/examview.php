<?php
namespace PHPMVC\Views;

class ExamView{

    public function editExam($grade, $semester, $status, $exams){

        echo '<div class="row mt info">
              <div class="col-lg-12">
                  <div class="form-panel">
                      <form class="form-horizontal style-form" method="post">
                        
                          <legend>Exam Info</legend>

                         <div class="form-group">                               
                              <label class="col-sm-2 col-sm-2 control-label">Grade</label>
                              <div class="col-sm-8">
                                <select name="grade" class="form-control class">
                                    <option value="" disabled>Select Grade</option>
                                    ';
        foreach($grade as $gradename){
            if($gradename->id == $exams->grade_id_fk){
                echo '<option selected value='.$gradename->id.'>'.$gradename->grade_name.'</option>';
            }else{
                echo '<option value='.$gradename->id.'>'.$gradename->grade_name.'</option>';
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
        foreach($semester as $stmt){
            if($stmt->id == $exams->semester_id_fk){
                echo '<option selected value='.$stmt->id.'>'.$stmt->season_name .' - '.$stmt->year.'</option>';
            }else{
                echo '<option value='.$stmt->id.'>'.$stmt->season_name .' - '.$stmt->year.'</option>';
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
        foreach($status as $stat){
            if($stat->id == $exams->status_id_fk){
                echo '<option selected value='.$stat->id.'>'.$stat->code.'</option>';
            }else{
                echo '<option value='.$stat->id.'>'.$stat->code.'</option>';
            }
        }
        echo '
                                </select>
                              </div>
                          </div>
                        
                        </fieldset>
                          <input type="submit" name="editExam" id="main">
                          <a href="/exam/default" id="cancel">Cancel</a>
                      </form>
                  </div>
              </div>      
            </div> ';

    }
}