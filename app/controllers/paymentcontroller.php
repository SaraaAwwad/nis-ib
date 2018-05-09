<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\DecoratorModel;
use PHPMVC\Models\DecoratorpricesModel;
use PHPMVC\Models\ParentModel;
use PHPMVC\Models\PaymentmethodModel;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Helper;
use PHPMVC\Models\PaymentModel;
use PHPMVC\Models\PaymentselectedattrModel;
use PHPMVC\Models\PaymentvalueModel;
use PHPMVC\Models\StudentLevelModel;
use PHPMVC\Models\StudentModel;
use PHPMVC\Models\SemesterModel;
use PHPMVC\Models\SemesterPricesModel;
use PHPMVC\Models\FormModel;
use PHPMVC\Models\PaymentdetailsModel;

class PaymentController extends AbstractController
{
    use InputFilter;
    use Helper;

    public function defaultAction()
    {

        $this->_data['children'] = ParentModel::getChildren();
        $this->_view();

    }

    public function addAction()
    {
        //EAV
        $this->_data['methods'] = PaymentmethodModel::getAll();

        $child_id = $this->filterInt($this->_params[0]);
        $child = new StudentModel($child_id);
        $this->_data['st'] = $child;

        $grade = $child->gradeObj->id;
        $this->_data['decorator'] = DecoratorpricesModel::getPriceByGrade($grade);
        $this->_data['semester'] = SemesterModel::getSemesters();

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
            $paymentObj->currency_id_fk = 1;
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

}

?>