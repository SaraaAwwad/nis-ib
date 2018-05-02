<?php
namespace PHPMVC\Views;

class CourseView{

    public function newCourseWorkType($type){
     //   return "<option value='text'>text</option><option value='date'>date</option><option value='password'>password</option><option value='number'>number</option>";
   
        foreach($type as $t){
            echo '<option value='.$t->id.'>'.$t->type.'</option>';
        }   
    }

    public function preCourseWorkAttr($pre){
        foreach($pre as $p){
            echo '<option value='.$p->id.'>'.$p->attr_name." - (". $p->type.')</option>.';
        }
    }

    public function getAllReq($req){
        echo '<label class="col-sm-1 col-sm-1 control-label">Requirement</label>    <div class="col-sm-3">';
        echo '<select name="req" class="form-control Req" id="Req" required>
        <option value="" disabled selected > Select</option>';
        foreach($req as $r){
            echo '<option value="'.$r->id.'">'.$r->requirement_name.'</option>';
        }
        echo '</select></div>';
    }

    public function addCourseWork(){

    }

    public function title(){
      echo'  <div class="row">
        <div class="col-lg-9 main-chart">
            <h1> Add A New CourseWork </h1>
            <hr>
		</div>
	    </div>';	
    }
}