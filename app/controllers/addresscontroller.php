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

    public function viewAction()  
   {  
      $id_country = $_POST['id'];
      $this->_data['datas']= AddressModel::getCity($id_country); 
      $output = '<option value="">Select '.$_POST["cityName"].'</option>'; 
      foreach ($this->_data['datas'] as $row)  
      {   
         $output .= "<option value='".$row->id."'>".$row->address."</option>";  
      } 
      echo $output;

   }  

  
}