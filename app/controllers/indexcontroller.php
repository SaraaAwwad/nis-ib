<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\UserModel;
use PHPMVC\Models\ErrorModel;
use PHPMVC\Lib\Helper;

class IndexController extends AbstractController{

    use Helper;

    public function defaultAction(){
       $this->_view();
    }

    public function loginAction(){
       
        if (isset($_POST['loginbtn'])){
            $em = $_POST["username"];
            $psw =$_POST["password"];

           if(UserModel::login($em, $psw)){
                $this->redirect('\user');
           }else{	
                $err = UserModel::ERR_LOGIN;
                $_SESSION["message"][] = ErrorModel::getError($err);
           }

           if(isset($_SESSION["message"])){
            $this->message = $_SESSION["message"];
            }
        }

        $this->_view();
    }

    public function logoutAction(){
    	session_destroy();
	    $this->redirect('\index');	
    }

}