<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\ParentModel;
use PHPMVC\Models\StudentModel;
use PHPMVC\Models\LevelModel;
use PHPMVC\Models\StatusModel;
use PHPMVC\Models\AddressModel;
use PHPMVC\Models\UserTypesModel;
use PHPMVC\Models\SclGradeModel;
use PHPMVC\Models\StudentLevelModel;
use PHPMVC\Lib\Helper;
use PHPMVC\Lib\FileUpload;
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

        $Levels = LevelModel::getAll();
        $this->_data['Levels'] = $Levels;
        $Address = AddressModel::getCountry();
        $this->_data['country'] = $Address;
        $stat = StatusModel::getAll();
        $this->_data['status'] = $stat;
        $grade = SclGradeModel::getAll();
        $this->_data['grade'] = $grade;


        if(isset($_POST['addStudent'])){

            if(!empty($_POST['parentsearch'])) {
                $objParent = ParentModel::getByUsername($_POST['parentsearch']);

                // $stud = new StudentModel();
                // $stud->fname = $_POST['fnamein'];
                // $stud->lname = $_POST['lnamein'];
                // $stud->DOB = $_POST['datein'];
                // $stud->gender = $_POST['radioin'];
                // $stud->phone = $_POST['numberin'];
                // $stud->status = $_POST['statusinput'];
                // $stud->add_id_fk = $_POST['street'];
                // $stud->email = $_POST['emailin'] . $stud->concatenate;
                // $stud->pwd = $_POST['passwordin'];
                // $stud->username = $_POST['usernamein'];
                // $stud->type_id = 1;

                // $stud->img = 'hi';
                // $stud->user_id_fk = $objParent->id;
                // $stud->save();

                // $stlevel = new StudentLevelModel();
                // $stlevel->scl_level_id_fk = $_POST['level'];
                // $stlevel->scl_grade_id_fk = $_POST['gradein'];
                // $stlevel->user_id_fk = $stud->id;
                // $stlevel->save();


            }else
                { //New parent
                    $objParent = new ParentModel();
                    
                    $objParent->fname = $_POST['parentfname'];
                    $objParent->lname = $_POST['parentlname'];
                    $objParent->phone = $_POST['parentnumber'];
                    $objParent->DOB = $_POST['parentdate'];
                    $objParent->gender = $_POST['parentradio'];
                    $objParent->add_id_fk = $_POST['street'];
                    $objParent->email = $_POST['parentemail'] . $objParent->concatenate;
                    $objParent->pwd = $_POST['parentpassword'];
                    $objParent->username = $_POST['parentusername'];
                    $objParent->user_id_fk = 0;
//                    if (isset($_FILES['parentimage']["name"])) {
//                        $uploader = new FileUpload($_FILES['parentimage']);
//                        $uploader->upload();
//                        $objParent->img = $uploader->getFileName();
//                    }
                    $objParent->img = 'hi';
                    $objParent->type_id = UserTypesModel::getParentId();
                    $objParent->user_id_fk = 0;
                    $objParent->status = 1;
                    $objParent->add();
                }

                $stud = new StudentModel();
                $stud->fname = $_POST['fnamein'];
                $stud->lname = $_POST['lnamein'];
                $stud->DOB = $_POST['datein'];
                $stud->gender = $_POST['radioin'];
                $stud->phone = $_POST['numberin'];
                $stud->status = $_POST['statusinput'];
                $stud->add_id_fk = $_POST['street'];
                $stud->email = $_POST['emailin'] . $stud->concatenate;
                $stud->pwd = $_POST['passwordin'];
                $stud->username = $_POST['usernamein'];
                $stud->type_id = 1;

//                if (isset($_FILES["imageinput"]["name"])) {
//                $uploader = new FileUpload($_FILES['imageinput']);
//                $uploader->upload();
//                $stud->img = $uploader->getFileName();
//                }

                $stud->img = 'hi';
                //????
                $stud->user_id_fk = $objParent->id;
                $stud->save();

//                //student Level
                $stlevel = new StudentLevelModel();
                $stlevel->scl_level_id_fk = $_POST['level'];
                $stlevel->scl_grade_id_fk = $_POST['gradein'];
                $stlevel->user_id_fk = $stud->id;
                $stlevel->save();


        }
        
        //exit();
        $this->_view();

    }

    public function deleteAction(){
        if(isset($this->_params[0])){
            $id = filter_var($this->_params[0], FILTER_SANITIZE_NUMBER_INT); 
            $stud = StudentModel::getByPK($id);

            if($stud == false){
                $this->redirect("/student");
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