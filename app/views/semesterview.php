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

    public function getAllCurrency($currency){
        echo'<select name="currency[]" class="form-control" required>
        <option value="" disabled selected>Select Currency</option>';
        
            foreach($currency as $c){
                echo '<option value='.$c->id.'>'.$c->code .'</option>';
            }
        echo'    </select>';
    }

}