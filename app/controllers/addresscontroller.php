<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\AddressModel;

class AddressController extends AbstractController
{
   
    public function addAction(){

        $types = AddressModel::getAll();
        $this->_data['address'] = $types;
        $this->_view();
    }

  
}