<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\PagesModel;
use PHPMVC\Models\StatusModel;
use PHPMVC\Lib\Helper;

class PagesController extends AbstractController{
    use Helper;

    public function defaultAction(){
        $pages = PagesModel::getAll();
        $this->_data['pages'] = $pages;
        $this->_view();
    }

    public function addAction(){

        if(isset($_POST['addpage'])){

            $friendlyname = $_POST['friendlyname']; 
            $physicalname = $_POST['physicalname'];
            $status_id = $_POST['status']; 

            
            switch($_POST['optradio']) {
                case "exist":
                    $parentid = $_POST['grouppicker'];
                    break;
                case "notexist":
                    $parentid = 0;
                    break;
                }

            if(isset($_POST['content'])){
                $html = $_POST['editor1'];
            }else{
                $html="";
            }

           if(PagesModel::insertPage($friendlyname, $physicalname, $status_id, $parentid, $html)){
                $this->redirect('\pages');
           }else{
                //error cl
           }
        }


        $stat = StatusModel::getAll();
        $this->_data['status'] = $stat;

        $pages = PagesModel::getAll();
        $this->_data['pages'] = $pages;

        $this->_view();
    }

    public function editAction(){

    }

    public function manageAction(){
        $this->_view();
    }

    public function viewpermissionsAction(){
        if(isset($this->_params[0])){
            $id = filter_var($this->_params[0], FILTER_SANITIZE_NUMBER_INT); 
          
            $pagesObj = new PagesModel($id);
            $permissions = $pagesObj->getAllPermissions();
            $this->_data['permissions'] = $permissions; //change to draw the same user type table
            $this->_view();
        }else{
            $this->redirect('\pages');
        }

        
    }
}