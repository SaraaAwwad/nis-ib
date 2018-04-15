<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\UserModel;
use PHPMVC\Lib\Helper;

class UserController extends AbstractController{

    public function defaultAction(){
        $user = UserModel::getByPK($_SESSION["userID"]);
        $this->_data['user'] = $user;
        $this->_view();
    }
}