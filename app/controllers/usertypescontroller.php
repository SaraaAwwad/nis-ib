<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\UserTypesModel;
use PHPMVC\Models\PagesModel;
use PHPMVC\Models\StatusModel;
use PHPMVC\Lib\Helper;
use PHPMVC\Models\ErrorModel;

class UserTypesController extends AbstractController{
    use Helper;

    public function defaultAction(){
        $usertypes = UserTypesModel::getAll();
        $this->_data['usertypes'] = $usertypes;
        $this->_view();
    }

    public function addAction(){

        if(isset($_POST['addusertype'])){

            $title = $_POST['title']; 
            $status_id = $_POST['status'];   

            if(UserTypesModel::addUserType($title, $status_id)){
                $err = UserTypesModel::ADD_SUCCESS;
                $_SESSION["message"][] = ErrorModel::getError($err);
                $this->redirect('\usertypes');
                
            }else{
                $err = UserTypesModel::ERR_EXIST;
                $_SESSION["message"][] = ErrorModel::getError($err);
            }
        }

        $stat = StatusModel::getAll();
        if(isset($_SESSION["message"])){
            $this->message = $_SESSION["message"];
        }
        $this->_data['status'] = $stat;
        $this->_view();
    }

    public function editAction(){
        if(isset($this->_params[0])){
            $id = filter_var($this->_params[0], FILTER_SANITIZE_NUMBER_INT); 

            $ut = new UserTypesModel($id);
            $this->_data['usertype'] = $ut;

            $stat = StatusModel::getAll();
            $this->_data['status'] = $stat;

            if(isset($_POST['updateusertype'])){
                    
                $title = $_POST['title']; 
                $status_id = $_POST['statusid']; 

                if($ut->update($title, $status_id)){
                    $this->redirect('\usertypes');
                }else{
                    $this->redirect('\user');
                }
            }
            $this->_view();
        }
    }

    public function managepagesAction(){
        if(isset($this->_params[0])){
            $id = filter_var($this->_params[0], FILTER_SANITIZE_NUMBER_INT); 
            $userTypesObj = new UserTypesModel($id);

            if(isset($_POST['addpermission'])){
                //delete all
                $userTypesObj->deleteAllPermissions();
                //add new permissions
                $i=1;
                foreach($_POST['content'] as $selected){
                    $userTypesObj->insertUserPages($selected, $i);
                    $i++; 
                }    

                $this->redirect('\usertypes');
            }

          
            $userPages = $userTypesObj->pages;            
            $pagesObjArr = PagesModel::getAll();
            $this->_data['userTypeName'] = $userTypesObj->title;
            $this->_data['allPages'] = $pagesObjArr;
            $this->_data['userPages'] = $userPages; 
            $this->_view();
        }else{
            $this->redirect('\usertypes');
        }
    }
}
