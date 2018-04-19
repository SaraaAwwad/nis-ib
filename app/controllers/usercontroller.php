<?php
namespace PHPMVC\Controllers;

use PHPMVC\LIB\InputFilter;

class UserController extends AbstractController
{
    use InputFilter;

    public function defaultAction()
    {
        $this->_view();
    }

}