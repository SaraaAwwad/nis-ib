<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\StudentModel;
use PHPMVC\Models\LevelModel;
use PHPMVC\Models\StatusModel;
use PHPMVC\Models\AddressModel;
use PHPMVC\Models\UserTypesModel;
use PHPMVC\Lib\Helper;
use PHPMVC\Lib\InputFilter;

class StudentController extends AbstractController{

    use InputFilter;
    use Helper;

    public function defaultAction(){
        
        $this->_data['students'] = StudentModel::getAll();
        // $this->_data['country'] = AddressModel::getCountry();
        // $this->_data['status'] = StatusModel::getAll();
        // $this->_data['usertype'] = UserTypesModel::getUsers();
        $this->_data['usertype'] = UserTypesModel::getUsers();
        $this->_view();
    }

    public function addAction(){

        // $Usertype = UserTypesModel::getAll();
        // $this->_data['usertype'] = $Usertype;

        // $this->_data['usertype'] = UserTypesModel::getUsers();

        if(isset($_POST['addstudent'])){
            //validate then (could use inputfilter trait or js)
                            //testing w/ any data
            //ex:
            //$objUser->fname = $this->filterString($_POST['fname']);
                //$levels = Level::getAllLevel();
                //$this->_data['levels'] = $levels;
               
                $stud = new StudentModel();
                $stud->fname = $_POST['fnamein'];
                $stud->lname = $_POST['lnamein'];
                $stud->phone = $_POST['numberin'];
                $stud->DOB = $_POST['datein'];
                $stud->gender = $_POST['radioin'];
                $stud->address_id_fk = $_POST['street'];
                $stud->email = $_POST['emailin'];
                $stud->status = $_POST['statusinput'];
                $stud->pwd = $_POST['passwordin'];
                $stud->username = $_POST['usernamein'];
                $stud->img = $_POST['imagein'];
                $stud->user_id_fk = 0;
                
                if (StudentModel::insertInDB($stud)){
                    $this->redirect("\student");
                }else{
                    
                }
        }
        

        $Levels = LevelModel::getAll();
        $this->_data['Levels'] = $Levels;
        
        $Address = AddressModel::getCountry();
        $this->_data['country'] = $Address;

        $stat = StatusModel::getAll();
        $this->_data['status'] = $stat;
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