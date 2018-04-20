<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\UserModel;
use PHPMVC\Models\AddressModel;
use PHPMVC\LIB\InputFilter;

class UserController extends AbstractController
{
    use InputFilter;

   
    public function defaultAction()
    {
        $this->_data['users'] = UserModel::getUsers();
        $this->_view();
    }

    public function addAction()
    {   
        $this->_data['country'] = AddressModel::getCountry();

    	if(isset($_POST['submit']))
    	{
            $user = new UserModel();
            $user->fname = $this->filterString($_POST['fnameinput']);
            $user->lname = $this->filterString($_POST['lnameinput']);
            $user->phone = $this->filterInt($_POST['numberinput']);
            $user->DOB = $this->filterInt($_POST['dateinput']);
            $user->gender = $this->filterString($_POST['radioinput']);
            $user->type_id = $this->filterInt($_POST['professioninput']);
            $user->country = $this->filterInt($_POST['country']);
            $user->address_id_fk = $this->filterInt($_POST['street']);
            $user->area = $this->filterInt($_POST['area']);
            $user->city = $this->filterInt($_POST['city']);
            $user->email = $this->filterString($_POST['emailinput']);
            $user->status = $this->filterInt($_POST['statusinput']);
            $user->pwd = $this->filterInt($_POST['passwordinput']);   
            $user->username = $this->filterString($_POST['usernameinput']);
            $user->img = $this->filterString($_POST['imageinput']);
            $user->amount = $this->filterInt($_POST['salaryinput']);
            $user->currency = $this->filterString($_POST['currencyinput']);
    	}
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