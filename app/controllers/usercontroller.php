<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\UserModel;

class UserController extends AbstractController
{
   
    public function defaultAction()
    {
        $this->_data['users'] = UserModel::getUsers();
        $this->_view();
    }

    public function addAction()
    {
    	if(isset($_POST('submit')))
    	{
    		var_dump($_POST);
    	}
        $this->_view();
    }


  
}