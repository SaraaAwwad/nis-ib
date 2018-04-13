<?php
namespace PHPMVC\Controllers;

class AbstractController{

    protected $_controller;
    protected $_action;
    protected $params;

    //3shan a3mlha pass lel view men el model
    protected $_data = [];

    public function notFoundAction(){
        $this->_view();
    }

    public function setController($controllerName){
        $this->_controller = $controllerName;
    }

    public function setAction($actionName){
        $this->_action = $actionName;
    }

    public function setParams($paramsName){
        $this->_params = $paramsName;
    }

    protected function _view(){
       
        if($this->_action == \PHPMVC\LIB\FrontController::NOT_FOUND_ACTION){
           //mafeesh action, wareelo not found view
            require_once VIEWS_PATH . 'notfound' . DS . 'notfound.view.php';
        }else{
            $view = VIEWS_PATH . $this->_controller . DS . $this->_action . '.view.php';
            if(file_exists($view)){
                //leha view
                extract($this->_data);
                require_once TEMPLATE_PATH . 'templateheaderstart.php';
                require_once TEMPLATE_PATH . 'templateheaderend.php';
              //  require_once TEMPLATE_PATH . 'wrapperstart.php';
                require_once TEMPLATE_PATH . 'header.php';
              //  require_once TEMPLATE_PATH . 'nav.php';
                require_once $view;
                //require_once TEMPLATE_PATH . 'wrapperend.php';
                require_once TEMPLATE_PATH . 'templatefooter.php';
                
            }else{
                //el action mawgood bas lesa malhash view
                require_once VIEWS_PATH . 'notfound' . DS . 'noview.view.php';                
            }
        }
    }
}