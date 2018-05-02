<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\CourseWorkEntityModel;
use PHPMVC\Models\CourseWorkAttrModel;
use PHPMVC\Models\CourseWorkModel;
use PHPMVC\Models\SemesterModel;


use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Helper;
use PHPMVC\Models\TypeModel;

class CourseWorkController extends AbstractController
{
    use InputFilter;
    use Helper;

    public function addAction(){

        if(isset($_POST["newcoursework"])){

            //to add to the cw req model (ُEntity)
            $req = $this->filterString($_POST["coursework"]);
            $ReqId = CourseWorkEntityModel::add($req);
            $cwEntityObj = new CourseWorkEntityModel($ReqId);

            if(isset($_POST["attr"])){
                $attr = $_POST["attr"];
                foreach($attr as $key => $value){
                    $cwEntityObj->addSelected($value, $ReqId);
                }
            }

            $name = $_POST["name"];
            $type = $_POST["type"]; 

            foreach($name as $key => $value){
                $attr = $this->filterString($value);
                $ty = $type[$key];
                $AttId = CourseWorkAttrModel::add($attr, $ty); 

                $cwAttrObj = new CourseWorkAttrModel($AttId);
                //add in the m2m table
                $cwEntityObj->addSelected($AttId, $ReqId);

          //      var_dump($key." (key)- ". $type[$key]. " (type) - ".$value." <br>");
          //      var_dump($key."options: <br>");

               if(isset($_POST[$key."options"])){
                    
                    $s =$_POST[$key."options"];
                     
                    foreach($s as $keyopt => $valueopt){ 
                        $cwAttrObj->addOption($valueopt);
                    }
                }
                
            }
            $this->redirect("/coursework/add");
        }
        
        $this->_data["type"] = TypeModel::getAll();
        $this->_data["preAttr"] = CourseWorkAttrModel::getAll(); 
        $this->_view();
    }

    public function addcwAction(){
        if(isset($this->_params[0])){
            $id = $this->filterInt($this->_params[0]);
            if($id!=""){
                //id of course 

                if(isset($_POST["submitdynamicform"])){
                    $req = $_POST['req'];
                    $cw = new CourseWorkEntityModel($req);
                    $formArr  = $cw->attr;

                    foreach($formArr as $f){
                        //values here 
                        var_dump($_POST[''.$f->id.'']);
                    }
                    exit();

                    $cwObj = new CourseWorkModel("");
                    $cwObj->course_id_fk = $id;
                    $cwObj->name = $_POST["cwName"];
                    $cwObj->date = date("Y/m/d");
                    $cwObj->req_id_fk = $_POST["req"];
                    $cwObj->semester_id_fk = $_POST["semester"];
                    
                   if($cwObj->add()){
                    //   $this->redirect("/course");
                        foreach($formArr as $f){
                            
                        }
                    }
                }

                //seleted from the ajax -->
                if(isset($_POST["action"]))
                {
                    if($_POST["action"] == "getForm"){

                        $req = $_POST['req'];
                        $cw = new CourseWorkEntityModel($req);
                        $formArr  = $cw->attr;
                        echo json_encode($formArr);
                        return;
                    }
                }
                
                $this->_data['semester'] = SemesterModel::getSemesters();
                $this->_data["Req"] = CourseWorkEntityModel::getAll();
                $this->_view();
            }

        }
       
    }
}