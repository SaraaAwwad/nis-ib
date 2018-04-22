<?php
namespace PHPMVC\Controllers;

use PHPMVC\Models\RegisterationModel;
use PHPMVC\Models\UserTypesModel;
use PHPMVC\Models\LevelModel;
use PHPMVC\Models\SclGradeModel;

use PHPMVC\LIB\InputFilter;

class RegisterationController extends AbstractController
{
    use InputFilter;

    public function defaultAction()
    {
        //$lvl = LevelModel::getAll();
        //$this->_data['levels'] = $lvl;
        $this->_data['details'] = RegisterationModel::getAll();
        $this->_view();
    }

    public function addAction()
    {
        $Levels = LevelModel::getAll();
        $this->_data['Levels'] = $Levels;

        $grade = SclGradeModel::getAll();
        $this->_data['grade'] = $grade;

        $this->_view();

    }
}
?>