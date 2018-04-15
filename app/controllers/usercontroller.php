<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\UserModel;
use PHPMVC\Lib\Helper;

class UserController extends AbstractController{

    public function defaultAction(){
        $this->_view();
    }
}