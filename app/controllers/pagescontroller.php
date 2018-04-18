<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\PagesModel;
use PHPMVC\Models\StatusModel;
use PHPMVC\Lib\Helper;

class PagesController extends AbstractController{

    public function defaultAction(){
        $pages = PagesModel::getAll();
        //show parent name instead of id
        /*for($i=0; $i<count($pages); $i++){
            $pgObj = new PagesModel($pages[$i]->pageid);
            $pages[$i]->parent = $pgObj->friendlyname;
            if($pages[$i]->pageid == 0)
            $pages[$i]->parent = "None";
        }*/
      
        $this->_data['pages'] = $pages;
        $this->_view();
    }

    public function addAction(){

        if(isset($_POST['addpage'])){
            //validate then (could use inputfilter trait or js)
                            //testing w/ any data
            //ex:
            //$objUser->fname = $this->filterString($_POST['fname']);

            $friendlyname = $_POST['friendlyname']; 
            $physicalname = $_POST['physicalname'];
            $status_id = $_POST['status']; 

            if($_POST['optradio']==1){
                $parentid = $_POST['grouppicker'];
            }else{
                $parentid = $_POST['optradio'];
            }

            if($_POST['content']){
                $html = $_POST['editor1'];
            }

            PagesModel::addPage($friendlyname, $physicalname, $status_id, $parentid, $html);
        }


        $stat = StatusModel::getAll();
        $this->_data['status'] = $stat;

        $pages = PagesModel::getAll();
        $this->_data['pages'] = $pages;


        $this->_view();
    }
}