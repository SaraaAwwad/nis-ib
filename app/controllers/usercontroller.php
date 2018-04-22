<?php
namespace PHPMVC\Controllers;

class UserController extends AbstractController
{
    public function defaultAction()
    {
        $this->_view();
    }

}