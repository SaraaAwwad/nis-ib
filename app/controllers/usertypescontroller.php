<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\UserTypesModel;
use PHPMVC\Lib\Helper;

class UserTypesController extends AbstractController{

    public function defaultAction(){
        $usertypes = UserTypesModel::getAllUserTypes();
        $this->_data['usertypes'] = $usertypes;
        $this->_view();
    }

    public function addAction(){
        
    }
}