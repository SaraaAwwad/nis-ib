<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\CourseWorkEntityModel;
use PHPMVC\Models\CourseWorkAttrModel;
use PHPMVC\Models\CourseWorkModel;
use PHPMVC\Models\CourseWorkValueModel;
use PHPMVC\Models\SemesterModel;

use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Helper;
use PHPMVC\Models\TypeModel;
use PHPMVC\Models\FormModel;

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
            $emptytestarray = array_filter($name);

            if(!empty($emptytestarray)){

            //$name = $_POST["name"];
            $type = $_POST["type"]; 

            foreach($name as $key => $value){
                $attr = $this->filterString($value);
                $ty = $type[$key];
                $AttId = CourseWorkAttrModel::add($attr, $ty); 

                $cwAttrObj = new CourseWorkAttrModel($AttId);
                //add in the m2m table
                $cwEntityObj->addSelected($AttId, $ReqId);


               if(isset($_POST[$key."options"])){
                    
                    $s =$_POST[$key."options"];
                     
                    foreach($s as $keyopt => $valueopt){ 
                        $cwAttrObj->addOption($valueopt);
                    }
                }
                
            }
            }
                $this->redirect("/coursework/add");
            
        }

        if(isset($_POST["action"])){
                    if($_POST["action"] == "getType"){

                        $val = $_POST['txt'];
                        $type = TypeModel::getByName($val);
                        
                        $output = array(
                            'typeflag' => $type->option_flag
                        );
                        
                        echo json_encode($output);
                        return;
                    }
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

                    $cwObj = new CourseWorkModel("");
                    $cwObj->course_id_fk = $id;
                    $cwObj->name = $_POST["cwName"];
                    $cwObj->date = date("Y/m/d");
                    $cwObj->req_id_fk = $_POST["req"];
                    $cwObj->semester_id_fk = $_POST["semester"];
                    
                   if($cwObj->add()){
                   
                        foreach($formArr as $f){
                         if(isset($_POST[''.$f->sid.''])){
                             $value = $_POST[''.$f->sid.''];
                            CourseWorkValueModel::add($cwObj, $f->sid, $value);
                         }   
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
                        $html=array();
                        $i=0;
                        foreach($formArr as $f){
                            $html[$i]= FormModel::createElement($f);
                            $i++;
                        }

                        echo json_encode($html);
                        return;
                    }
                }
                
                $this->_data['semester'] = SemesterModel::getSemesters();
                $this->_data["Req"] = CourseWorkEntityModel::getAll();
                $this->_view();
            }
        }
    }

    public function viewcwAction(){
        if(isset($this->_params[0]) && isset($this->_params[1])){
            $course_id = $this->filterInt($this->_params[0]);
            $sem_id = $this->filterInt($this->_params[1]);

            if($course_id!="" && $sem_id!=""){

                $coursework = CourseWorkModel::getAll($course_id, $sem_id);
                
                foreach($coursework as $c){
                
                    $entity = $c->req;
                    
                    $options;
                    $j=0;

                    foreach($entity->attr as $t){

                        //get all values for this cw with this sid
                        $value = CourseWorkValueModel::getAll($t->sid, $c->id);
                        $options = array();
                        $j=0;

                        if($value!=""){
                            if($t->flag == 1){
                                $opt=array();
                                $i=0;
                                foreach($value as $v){
                                    $opt[$i] = CourseWorkValueModel::getOpt($v->value);
                                    $i++;
                                }
                                $t->options = $opt;
                            }else{
                                $op=array();
                                $k=0;
                                foreach($value as $v){
                                   $op[$k]= $v->value;
                                   $k++;
                                }
                                $t->options = $op;
                           }
                        }    
                    }

                }
                
                $this->_data['coursework'] = $coursework;
                $this->_view();
            }
        }
    }
}