<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\UserModel;
use PHPMVC\Lib\Helper;

class IndexController extends AbstractController{

    use Helper;

    public function defaultAction(){
       $this->_view();
    }

    public function loginAction(){
       
        if (isset($_POST['loginbtn'])){
            //validation and sqli injection
            $em = $_POST["username"];
            $psw =$_POST["password"];
           if(UserModel::login($em, $psw)){
                $this->redirect('\user');
           }else{			
           }
        }

        $this->_view();
    }

    public function logoutAction(){
    	session_destroy();
	    $this->redirect('\index');	
    }

}