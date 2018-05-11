<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\MailerModel;
use PHPMVC\Models\CreateModel;

class UserController extends AbstractController
{
    public function defaultAction()
    {
        $this->_view();
    }

    public function CityAction()  
   {  
      //set selected country id from POST 
      $id_country = $_POST['id'];
      $this->_data['datas']= AddressModel::getCity($id_country);  
      $output = null;  
      foreach ($this->_data['datas'] as $row)  
      {   
         $output .= "<option value='".$row->id."'>".$row->address."</option>";  
      }  
      echo $output;
   }  
  
}