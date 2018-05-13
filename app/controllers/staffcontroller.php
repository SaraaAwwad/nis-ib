<?php
namespace PHPMVC\Controllers;

use PHPMVC\Models\StaffModel;
use PHPMVC\Models\SalaryModel;
use PHPMVC\Models\TelephoneModel;
use PHPMVC\Lib\Helper;
use PHPMVC\Lib\FileUpload;
use PHPMVC\Models\AddressModel;
use PHPMVC\Models\StatusModel;
use PHPMVC\Models\UserModel;
use PHPMVC\Models\UserTypesModel;
use PHPMVC\Models\CurrencyModel;


use PHPMVC\LIB\InputFilter;

class StaffController extends AbstractController
{
    use InputFilter;
    use Helper;

    public function defaultAction()
    {
        $this->_data['users'] = StaffModel::getUsers();
        $this->_data['telephones'] = TelephoneModel::getAll();
        $this->_view();
    }

    public function addAction()
    {   
        $this->_data['country'] = AddressModel::getCountry();
        $this->_data['status'] = StatusModel::getAll();
        $this->_data['usertype'] = UserTypesModel::getUsers();
        $this->_data['currencies'] = CurrencyModel::getAll();

    	if(isset($_POST['add']))
        {
            $user = new StaffModel();
            $user->type_id = $this->filterInt($_POST['professioninput']);
            $user->fname = $this->filterString($_POST['fnameinput']);
            $user->lname = $this->filterString($_POST['lnameinput']);
            $user->gender = $this->filterString($_POST['radioinput']);
            $user->DOB = $_POST['dateinput'];
            $user->username = $this->filterString($_POST['usernameinput']);
            $user->cryptPassword($_POST['passwordinput']);
            $user->email = $this->filterString($_POST['emailinput'] . $_POST['extension']);
            $user->status = $this->filterInt($_POST['statusinput']);
            $user->user_id_fk = $this->filterInt(0);
            $user->add_id_fk = $this->filterInt($_POST['street']);
            $number = count($_POST['numberinput']);

            //Multiple Numbers Manipulation
            if($number > 1 )
            {
                for($i=0; $i<$number;$i++)
                   {
                    if($i == 0 )
                    {
                        $first = $_POST['numberinput'][$i];
                        $user->phone = $this->filterInt($first);
                    } else{
                      $second = $_POST['numberinput'][$i]; } } }
            else if($number == 1)
            {
                for($i=0; $i<$number;$i++)
                {$first = $_POST['numberinput'][$i];
                $user->phone = $this->filterInt($first); } }

            //Image Manipulation
            if (isset($_FILES["imageinput"]["name"])) {
                $uploader = new FileUpload($_FILES['imageinput']);
                $uploader->upload();
                $user->img = $uploader->getFileName();
            }

            if($user->save()) {
                $salary = new SalaryModel();
                $salary->user_id_fk = $user->id;
                $salary->amount = $this->filterInt($_POST['salaryinput']);
                $salary->currency_id = $this->filterInt($_POST['currencyinput']);
                $salary->save();

                if($number > 1 ){
                $telephone = new TelephoneModel();
                $telephone->user_id_fk = $user->id;
                $telephone->number = $this->filterInt($second);
                $telephone->save(); }
            }
           $this->redirect('/staff/default');

    	}
        $this->_view();
    }

    public function editAction()
    {
        if (isset($this->_params[0])) {
            $id = $this->filterInt($this->_params[0]);
            $user = UserModel::getByPK($id);
            if ($user === false) {
                $this->redirect('/staff/default');
            }
            $salary = SalaryModel::getByUser($id);
            $this->_data['users'] = $user;
            $this->_data['salary'] = $salary;
            $this->_data['country'] = AddressModel::getCountry();
            $this->_data['status'] = StatusModel::getAll();
            $this->_data['usertype'] = UserTypesModel::getUsers();
            $this->_data['currencies'] = CurrencyModel::getAll();

            if (isset($_POST['edit'])) {
                $user->type_id = $this->filterInt($_POST['professioninput']);
                $user->fname = $this->filterString($_POST['fnameinput']);
                $user->lname = $this->filterString($_POST['lnameinput']);
                $user->gender = $this->filterString($_POST['radioinput']);
                $user->DOB = $_POST['dateinput'];
                $user->username = $this->filterString($_POST['usernameinput']);
                $user->email = $this->filterString($_POST['emailinput']);
                $user->status = $this->filterInt($_POST['statusinput']);
                $user->user_id_fk = $this->filterInt(0);
                $user->add_id_fk = $this->filterInt($_POST['street']);
                $user->phone = $this->filterInt($_POST['numberinput']);
                if (isset($_FILES["imageinput"]["name"])) {
                    $uploader = new FileUpload($_FILES['imageinput']);
                    $uploader->upload();
                    $user->img = $uploader->getFileName();
                }
                $user->save();

                $salary->amount = $this->filterInt($_POST['salaryinput']);
                $salary->currency_id = $this->filterInt($_POST['currencyinput']);
                $salary->save();


                $this->redirect('/staff/default');
            }
            $this->_view();
        }
    }

     public function activateAction()
    {
        $this->_data['status'] = StatusModel::getAll();
        $id = $this->filterInt($this->_params[0]);
        $user = StaffModel::getByPK($id);

        if($user === false)
        { $this->redirect('/staff/default'); }
        $this->_data['users'] = $user;
        if(isset($_POST['activate']))
        { $user->status = $this->filterInt($_POST['statusinput']);
          $user->save();
          $this->redirect('/staff/default');
        }

        $this->_view();
    }


}