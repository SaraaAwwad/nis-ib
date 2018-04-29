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
}