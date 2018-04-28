<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\SclGradeModel;
use PHPMVC\Models\StatusModel;
use PHPMVC\Models\ParentModel;
use PHPMVC\Models\StudentLevelModel;

use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Helper;

class PaymentController extends AbstractController
{
    use InputFilter;
    use Helper;

    public function defaultAction()
    {
        $st = new StudentLevelModel(1);
        var_dump($st);
//        $st->getGrade('1');

//        $this->_data['children'] = ParentModel::getChildren();
//        $children[] = ParentModel::getChildren();
//        //var_dump($children);
//        $grades[] = StudentLevelModel::getGrades($children);
//        var_dump($grades);
//        if(!empty($children))
//        {
//
//
//            if(!empty($childrenID))
//            {
                //var_dump($childrenID);
                //$grades[] = StudentLevelModel::getArr($childrenID);
                //var_dump($grades);
                //var_dump($child);
//            }
//        }

      //  $child = ParentModel::getChildren();
       // $this->_data['grade'] = SclGradeModel::getByPK($child->scl_id_fk);
        $this->_view();
    }
}

?>