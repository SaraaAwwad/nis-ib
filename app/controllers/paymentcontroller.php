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
        //$sem = new SemesterModel(1);
        //$sem->getFeesbyGrade(2);
        //var_dump($sem);

        if (isset($_POST['addPayment'])) {
        
            //get selected price
           // $sel =  $_POST['concrete'];
           //var_dump($sel);
           //exit();

            $concreteSem = new SemesterModel(1);
            $concreteSem->getFeesbyGrade(2);
            $firstDec = new DecoratorpricesModel($concreteSem, 1);
            echo " costs ";
            echo $firstDec->cost();
            exit();

           /* $paymentVal = new PaymentvalueModel();
            $paymentVal->paymentObj = new PaymentModel();
            $paymentVal->paymentObj->user_id_fk = $child_id;
            $paymentVal->paymentObj->method_id = 2; // Bank
            $paymentVal->paymentObj->currency_id = 2; //L.E
            $paymentVal->paymentObj->semester_id_fk = 1; //Semester
            //get total price

            $selected = $_POST['myCheck'];

            //id of decorator
            foreach ($selected as $s) {
               // $extra = new ExtrafeesModel($paymentVal);

                $decoratorPriceObj = new DecoratorpricesModel($paymentVal,$s);

                $decoratorPriceObj->price = $decoratorPriceObj->addPayment();

            }
            var_dump($decoratorPriceObj);

            exit();
            if ($paymentVal->InsertPayment()) {
                $this->redirect('/payment/default');
            } else {
                echo 'fatal error';
            }
            var_dump($paymentVal);
*/
            //PaymentdetailsModel::insertDetail($child_id,$s,$decoratorObj->price);

        }

        if(isset($_POST['action'])){
            if($_POST['action'] == 'getSemesterPrice'){
                $semid = $_POST['semester'];
                $sem = new SemesterModel($semid);
                $sem->getFeesbyGrade($grade);
                echo json_encode($sem);
                return;
            }
        }

    $this->_view();

    }

}

?>