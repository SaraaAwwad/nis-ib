<?php
namespace PHPMVC\Views;

class StatusView{

    public function getAllStatus($status){
        echo'<select name="status" class="form-control semester" >
        <option value="" disabled >Select Status</option>';
        
            foreach($status as $st){
                echo '<option value='.$st->id.'>'.$st->code.'</option>';
            }
        echo'    </select>';
    } 

}