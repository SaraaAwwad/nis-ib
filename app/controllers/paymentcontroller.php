<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\CurrencyModel;
use PHPMVC\Models\DecoratorModel;
use PHPMVC\Models\DecoratorpricesModel;
use PHPMVC\Models\ParentModel;
use PHPMVC\Models\PaymentmethodModel;
use PHPMVC\Models\PaymentModel;
<<<<<<< HEAD
use PHPMVC\Models\PaymentselectedattrModel;
use PHPMVC\Models\PaymentstatusModel;
=======
use PHPMVC\Models\PaymentAttrModel;
>>>>>>> 8d29226263d0a40a3317e2f18def03d3a58e532a
use PHPMVC\Models\PaymentvalueModel;
use PHPMVC\Models\StudentLevelModel;
use PHPMVC\Models\StudentModel;
use PHPMVC\Models\SemesterModel;
use PHPMVC\Models\SemesterPricesModel;
use PHPMVC\Models\FormModel;
use PHPMVC\Models\PaymentdetailsModel;
<<<<<<< HEAD
use PHPMVC\Models\UserTypesModel;
=======
use PHPMVC\Models\TypeModel;

use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Helper;

>>>>>>> 8d29226263d0a40a3317e2f18def03d3a58e532a

class PaymentController extends AbstractController
{
    use InputFilter;
    use Helper;

    public function defaultAction()
    {
        $this->_data['children'] = ParentModel::getChildren();
        $this->_view();

    }

<<<<<<< HEAD
    public function adminAction()
    {
        $this->_data['payment'] = PaymentModel::getAllStudentsPayments();
        $this->_data['pending'] = PaymentstatusModel::pending;

            $this->_view();

    }

    public function editAction()
    {
        if(isset($this->_params[0])){
            $id = filter_var($this->_params[0], FILTER_SANITIZE_NUMBER_INT);

            $paymentObj = new PaymentModel($id);
            $this->_data['payment']  =$paymentObj;
            $this->_data['status'] = PaymentstatusModel::getAll();

            if(isset($_POST['updatepaymentstatus'])){

                $status_id = $_POST['statusid'];

                if($paymentObj->updateStatus($status_id)){
                    $this->redirect('\payment\admin');
                }else{
                    //Error message
                }
            }
            $this->_view();
        }
    }

    public function addAction()
    {
=======
    public function addAction(){
>>>>>>> 8d29226263d0a40a3317e2f18def03d3a58e532a
        //EAV
        $this->_data['methods'] = PaymentmethodModel::getAll();

        $child_id = $this->filterInt($this->_params[0]);
        $child = new StudentModel($child_id);
        $this->_data['st'] = $child;

        $grade = $child->gradeObj->id;
        $this->_data['decorator'] = DecoratorpricesModel::getPriceByGrade($grade);
        $this->_data['semester'] = SemesterModel::getUnpaidSemester($child_id);
        $this->_data['currency'] = CurrencyModel::getAll();
        if (isset($_POST['addPayment'])) {

        //1st: getting total amount
            $semid = $_POST['semester'];
            $classes = new SemesterPricesModel($semid, $grade);
            
            $selected = $_POST['myCheck'];
            
            foreach ($selected as $s) {
                $classes = new DecoratorpricesModel($classes, $s);                
            }

            $total_amount = $classes->cost();
            
            $paymentObj = new PaymentModel("");
            $paymentObj->user_id_fk = $child_id;
            $paymentObj->amount = $total_amount;
            $paymentObj->method_id_fk = $_POST['method'];
            $paymentObj->semester_id_fk = $semid;
            $paymentObj->currency_id_fk = $_POST['currency'];
            $paymentObj->status_id_fk = PaymentstatusModel::pending;
            $paymentObj->add();

        //2nd insert payment details

            foreach ($selected as $s) {
                $paymentDetail = new PaymentdetailsModel("");
                $paymentDetail->payment_id_fk = $paymentObj->id;
                $decoratorObj = new DecoratorpricesModel("", $s);   
                $paymentDetail->decorator_id_fk = $decoratorObj->decorator_id_fk;
                $paymentDetail->amount = $decoratorObj->price;   
                $paymentDetail->add();       
            }

            //3rd eav values 
            
            $method = $_POST['method'];
            $pm = new PaymentmethodModel($method);
            $formArr  = $pm->attr;
            foreach($formArr as $f){
                if(isset($_POST[''.$f->sid.''])){
                    $value = $_POST[''.$f->sid.''];
                    PaymentValueModel::add($paymentObj, $f->sid, $value);
                }   
               }
            $this->redirect("/payment/");
        }

        if(isset($_POST['action'])){
            if($_POST['action'] == 'getSemesterPrice'){
                $semid = $_POST['semester'];
                $sem = new SemesterPricesModel($semid, $grade);
                echo json_encode($sem);
                return;
            }

            if($_POST["action"] == "getForm"){

                $req = $_POST['req'];
                $pay = new PaymentmethodModel($req);
                $formArr  = $pay->attr;
                $html=array();
                $i=0;
                foreach($formArr as $f){
                    $html[$i]= FormModel::createElement($f);
                    $i++;
                }

                echo json_encode($html);
                return;
            }
        }

        $this->_view();
    }

    public function addformAction(){
        if(isset($_POST["newmethod"])){

            $req = $this->filterString($_POST["method"]);
            $ReqId = PaymentMethodModel::add($req);
            $paymentEntityObj = new PaymentMethodModel($ReqId);

            if(isset($_POST["attr"])){
                $attr = $_POST["attr"];
                foreach($attr as $key => $value){
                    $paymentEntityObj->addSelected($value, $ReqId);
                }
            }

            $name = $_POST["name"];
            $emptytestarray = array_filter($name);

            if(!empty($emptytestarray)){

            $type = $_POST["type"]; 

            foreach($name as $key => $value){
                $attr = $this->filterString($value);
                $ty = $type[$key];
                $AttId = PaymentAttrModel::add($attr, $ty); 

                $paymentAttrObj = new PaymentAttrModel($AttId);
                //add in the m2m table
                $paymentEntityObj->addSelected($AttId, $ReqId);


               if(isset($_POST[$key."options"])){
                    
                    $s =$_POST[$key."options"];
                     
                    foreach($s as $keyopt => $valueopt){ 
                        $paymentAttrObj->addOption($valueopt);
                    }
                }
            }
            }
            $this->redirect("/payment/addform");
        }

        if(isset($_POST["action"])){
            if($_POST["action"] == "getType"){

                $val = $_POST['txt'];
                $type = TypeModel::getByName($val);
                
                $output = array(
                    'typeflag' => $type->option_flag
                );
                
                echo json_encode($output);
                return;
            }
        }

        $this->_data["preAttr"] = PaymentAttrModel::getAll(); 
        $this->_data["type"] = TypeModel::getAll();
        $this->_view();
    }

    public function invoiceAction(){

        $payment_id = filter_var($this->_params[0], FILTER_SANITIZE_NUMBER_INT);
        $paymentObj = new PaymentModel($payment_id);

        //Child and parent Info
        $this->_data['payment'] = $paymentObj;
        $child = new StudentModel($paymentObj->user_id_fk);
        $this->_data['child'] = $child;
        $this->_data['parent'] = ParentModel::getParentOf($paymentObj->user_id_fk);
        $this->_data['details'] = PaymentdetailsModel::getDetails($paymentObj->id);

        //Semester Price
        $child->getGrade();
        $this->_data['semesterPrice'] = new SemesterPricesModel($paymentObj->semesterObj->id, $child->gradeObj->id);

        /////view EAV payment



        $this->_view();

    }
}

?>