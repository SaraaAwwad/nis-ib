<?php
namespace PHPMVC\Controllers;

use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Helper;

class CourseWorkController extends AbstractController
{
    use InputFilter;
    use Helper;

    public function addAction(){
        if(isset($_POST['action'])){
            if($_POST['action']=="newCourseWork"){

            }
        }
        $this->_view();
    }

}