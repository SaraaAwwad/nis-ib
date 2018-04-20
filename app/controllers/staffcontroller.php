<?php
namespace PHPMVC\Controllers;

use PHPMVC\Models\StaffModel;
use PHPMVC\Models\AddressModel;
use PHPMVC\Models\StatusModel;
use PHPMVC\Models\UserTypesModel;
use PHPMVC\Models\CurrencyModel;

use PHPMVC\LIB\InputFilter;

class StaffController extends AbstractController
{
    use InputFilter;

    public function defaultAction()
    {
        $this->_data['users'] = StaffModel::getUsers();
        $this->_view();
    }

    public function addAction()
    {   
        $this->_data['country'] = AddressModel::getCountry();
        $this->_data['status'] = StatusModel::getAll();
        $this->_data['usertype'] = UserTypesModel::getUsers();
        $this->_data['currencies'] = CurrencyModel::getAll();

    	if(isset($_POST['submit']))
    	{
            $user = new StaffModel();
            $user->fname = $this->filterString($_POST['fnameinput']);
            $user->lname = $this->filterString($_POST['lnameinput']);
            $user->phone = $this->filterInt($_POST['numberinput']);
            $user->DOB = $this->filterInt($_POST['dateinput']);
            $user->gender = $this->filterString($_POST['radioinput']);
            $user->type_id = $this->filterInt($_POST['professioninput']);
            $user->add_id_fk = $this->filterInt($_POST['street']);
            $user->user_id_fk = $this->filterInt(0);
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



  
}