<?php
namespace PHPMVC\Views;
class ExamView{
    public function editExam($grades, $semester, $status, $exams){

        echo '<div class="row">
        <div class="col-lg-9 main-chart">
            <h1>Add Exam Details</h1>
            <hr>
        </div>
    </div>

    <div class="row mt info">
        <div class="col-lg-12">
            <div class="form-panel">
                <form class="form-horizontal style-form" method="post">

                    <legend>Exam Info</legend>

                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Grade</label>
                        <div class="col-sm-4">
                            <select name="grade" id="grade" class="form-control class" required>
                                <option value="" selected="selected" disabled="disabled">Select Grade</option>
                                    ';
//                                foreach($grades as $grade){
//                                    echo '<option value='.$grade->id.'>'.$grade->grade_name.'</option>';
//                                }
        echo'
                       </select>
                        </div>

                        <label class="col-sm-2 col-sm-2 control-label">Course</label>
                        <div class="col-sm-4">
                            <select name="course" id="course" class="form-control class" required>
                                <option value="" selected="selected" disabled="disabled">Select Course</option>
                                    ';
//                        foreach($courses as $c){
//                         echo '<option value='.$c->id.'>'.$c->name.'</option>'; }
        echo  '</select>
                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-sm-2 col-sm-2 control-label">Day</label>
                        <div class="col-sm-4">
                            <select name="day" id="day" class="form-control semester" required>
                                <option value="" selected="selected" disabled="disabled">Select Day</option>
                                    ';
//                        foreach($days as $d){
//                            echo '<option value='.$d->id.'>'.$d->day.'</option>'; }
        echo '</select>
                        </div>


                        <select name="visible" id="visible" class="form-control semester" style="display:none;">
                        <option value="" disabled="disabled">Select Date</option>
                        </select>

                        <label class="col-sm-2 col-sm-2 control-label">Date</label>
                        <div class="col-sm-4">
                            <input id="date" type="text" name="dateinput" required>
                        </div>

                    </div>


                    <div class="form-group">

                        <label class="col-sm-2 col-sm-2 control-label">Slot</label>
                        <div class="col-sm-4">
                            <select name="slot" id="slot" class="form-control semester" required>
                                <option value="" selected="selected" disabled="disabled">Select Slot</option>';
//                            foreach($slots as $slot){
//                               echo '<option value='.$slot->id.'>'.$slot->slot_name.'</option>'; }
                               echo ' </select>
                        </div>

                        <label class="col-sm-2 col-sm-2 control-label">Room</label>
                        <div class="col-sm-4">
                            <select name="room" id="room" class="form-control semester" required>
                                <option value="" selected="selected" disabled="disabled">Select Room</option>
                            </select>
                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-sm-2 col-sm-2 control-label">Semester</label>
                        <div class="col-sm-4">
                            <select name="semester" id="semester" class="form-control semester" required>
                                <option value="" selected="selected" disabled="disabled">Select Semester</option>';
//                       foreach($semester as $semester){
//                        echo '<option value='.$semester->id.'>'.$semester->season_name.' - '.$semester->year.'</option>'; }
                        echo '</select>
                        </div>

                        <label class="col-sm-2 col-sm-2 control-label">Status</label>
                        <div class="col-sm-4">
                            <select name="status" id="status" class="form-control semester" required>
                                <option value="" selected="selected" disabled="disabled">Select Status</option>';
//                       foreach($status as $stmt){
//                            echo '<option value='.$stmt->id.'>'.$stmt->code.'</option>'; }
                            echo '</select>
                        </div>

                    </div>


                    </fieldset>
                    <input type="submit" name="addDetail" id="main">
                    <a href="/exam/default" id="cancel">Cancel</a>
                </form>
            </div>
        </div>
    </div>';
    }
}