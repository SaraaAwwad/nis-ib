<?php
namespace PHPMVC\Views;

class CourseView{

    public function newCourseWorkType($type){
        return "<option value='INTEGER'>INT</option><option value='VARCHAR'>VARCHAR</option><option value='DATE'>DATE</option>";
    }

    public function preCourseWorkAttr($pre){
        foreach($pre as $p){
            echo '<option value='.$p->id.'>'.$p->attr_name." - (". $p->type.')</option>.';
        }
    }

    public function getAllReq($req){
        echo '<label class="col-sm-1 col-sm-1 control-label">Requirement</label>    <div class="col-sm-3">';
        echo'<select name="req" class="form-control Req" id="Req" required>';
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