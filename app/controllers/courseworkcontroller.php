<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\CourseWorkEntityModel;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Helper;
use PHPMVC\Models\CourseWorkAttrModel;

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

            //to add to the cw attr model (Attr)
            $name = $_POST["name"];
            $type = $_POST["type"]; // to be changed if its fk id

            foreach($name as $key => $value){
                $attr = $this->filterString($value);
                $ty = $this->filterString($type[$key]);
                $AttId = CourseWorkAttrModel::add($attr, $ty); 

                //add in the m2m table
                $cwEntityObj->addSelected($AttId, $ReqId);
            }

            //$this->redirect("/user");
        }
        
        $this->_data["preAttr"] = CourseWorkAttrModel::getAll(); 
        $this->_view();
    }

}