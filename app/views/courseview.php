<?php
namespace PHPMVC\Views;

class CourseView{

    public function newCourseWorkType($type){
        return "<option value='INTEGER'>INT</option><option value='VARCHAR'>VARCHAR</option><option value='DATE'>DATE</option>";
    }
}