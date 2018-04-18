<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\StudentModel;
use PHPMVC\Lib\Helper;
use PHPMVC\Lib\InputFilter;

class StudentController extends AbstractController{

    use InputFilter;
    use Helper;

    public function defaultAction(){
        //example of get all
        $arrOfObj = StudentModel::getAll();
        $this->_data['students'] = $arrOfObj;
        $this->_view();
    }

    public function addAction(){

        if(isset($_POST['add'])){
            //validate then (could use inputfilter trait or js)
                            //testing w/ any data
            //ex:
            //$objUser->fname = $this->filterString($_POST['fname']);
                $objUser = new StudentModel();
                $objUser->fname = $_POST['fname'];
                $objUser->lname = $_POST['lname'];
                $objUser->phone = $_POST['number'];
                $objUser->DOB = $_POST['date'];
                $objUser->gender = $_POST['radio'];
                $objUser->address_id_fk = 4;
                $objUser->email = $_POST['email'];
                $objUser->status = 1;
                $objUser->pwd = $_POST['password'];
                $objUser->username = $_POST['username'];
                $objUser->img = $_POST['image'];
                $objUser->user_id_fk = 6;
                
                if (StudentModel::insertInDB($objUser)){
                    $this->redirect("\student");
                }else{

                }
        }
        $this->_view();
    }

    public function deleteAction(){
        if(isset($this->_params[0])){
            $id = filter_var($this->_params[0], FILTER_SANITIZE_NUMBER_INT); 
            $stud = StudentModel::getByPK($id);

            if($stud == false){
                $this->redirect("\student");
            }

           // if($objUser()->updateActivation()){
                //$this->redirect("/student");
           // }
        }

    }

    public function editAction(){
        if(isset($this->_params[0])){
            $id = filter_var($this->_params[0], FILTER_SANITIZE_NUMBER_INT); 
            $stud = StudentModel::getByPK($id);

            if($stud == false){
                $this->redirect("\student");
            }
            
            //to send to view 
            $this->_data['student'] = $stud;

            if(isset($_POST['updatestudent'])){
                $objUser = new StudentModel($id);
                $objUser->fname = $_POST['fname'];
                $objUser->lname = $_POST['lname'];
                $objUser->phone = $_POST['number'];
                $objUser->DOB = $_POST['date'];
                $objUser->gender = $_POST['radio'];
                $objUser->address_id_fk = 4;
                $objUser->email = $_POST['email'];
                $objUser->status = 1;
                $objUser->password = $_POST['password'];
                $objUser->username = $_POST['username'];
                $objUser->img = $_POST['image'];
                $objUser->user_id_fk = 6;
                    
                if ($objUser->update()){
                    $this->redirect("/student");
                }else{

                }
            }
            $this->_view();
        }       
    }
}