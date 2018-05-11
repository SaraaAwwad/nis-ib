<?php
namespace PHPMVC\Views;

class SemesterView{

    public function getAllSemester($semester){
        echo'<select name="semester" class="form-control semester" required>
        <option value="" disabled selected>Select Semester</option>';

            foreach($semester as $st){
                echo '<option value='.$st->id.'>'.$st->season_name .' - '.$st->year.'</option>';
            }
        echo'    </select>';
    } 

}