<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\UserModel;
use PHPMVC\Lib\Helper;

class IndexController extends AbstractController{

    public function defaultAction(){
       $this->_view();
    }
    public function loginAction(){
       
        if (isset($_POST['loginbtn'])){
            $em = $_POST["username"];
            $psw =$_POST["password"];
        
           if(UserModel::login($em, $psw)){
               echo 'login';
           }else{
                   echo 'user doesnt exist';				
           }
        }

        $this->_view();
    }
}