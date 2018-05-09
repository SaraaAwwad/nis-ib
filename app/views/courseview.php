<?php
namespace PHPMVC\Views;

class CourseView{

    public function newCourseWorkType($type){
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

    public function viewCourseWork($coursework){
        foreach($coursework as $cw){
            $entity = $cw->req;
            echo'  <div class="row">
            <div class="col-lg-9 main-chart">
                <h3> '.$entity->requirement_name.' ('.$cw->name.')</h3> 
                <h4>'.$cw->date.'</h4>
            </div>
            </div>';

           echo'<div class="row mt">
            <div class="col-lg-12">
            <div class="form-panel"> 
            <div class="form-horizontal style-form">
            ';

            foreach($entity->attr as $t){
                echo '<div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">'.$t->attr_name.':</label><div class="col-sm-10 col-sm-10">';

                foreach($t->options as $opt){
                    echo $opt.' ';
                }
                echo '</div></div>';
            }
            
            echo '</div></div></div></div><hr>';
        }
            
    
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