<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\UserTypesModel;
use PHPMVC\Models\StatusModel;
use PHPMVC\Lib\Helper;

class UserTypesController extends AbstractController{
    use Helper;

    public function defaultAction(){
        $usertypes = UserTypesModel::getAll();
        $this->_data['usertypes'] = $usertypes;
        $this->_view();
    }

    public function addAction(){

        if(isset($_POST['addusertype'])){
            //validate then (could use inputfilter trait or js)
                            //testing w/ any data
            //ex:
            //$objUser->fname = $this->filterString($_POST['fname']);

            $title = $_POST['title']; 
            $status_id = $_POST['status'];                 
            if(UserTypesModel::addUserType($title, $status_id)){
                $this->redirect('\usertypes');
            }else{
                //error messages
            }
        }

        $stat = StatusModel::getAll();
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
}