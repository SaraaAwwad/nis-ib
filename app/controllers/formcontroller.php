<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\UserModel;
use PHPMVC\Lib\Helper;


class FormController extends AbstractController{

    use Helper;

    public function defaultAction(){
        $s ="selectbox";
        $html = \PHPMVC\Models\FormModel::createElement($s);


            var_dump($html);
            exit();        

        //   $this->_view();
    }

}