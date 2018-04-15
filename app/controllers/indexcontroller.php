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
            $em = $_POST["username"];
            $psw =$_POST["password"];
           if(UserModel::login($em, $psw)){
               $this->redirect('\user');
           }else{
            echo 'user doesnt exist';				
           }
        }

        $this->_view();
    }
}