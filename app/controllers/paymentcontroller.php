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
        $child->getGrade();
        $this->_data['st'] = $child;
        $grade_id = StudentLevelModel::getGradeID($child_id);
        $this->_data['decorator'] = DecoratorpricesModel::getPricesByGrade($grade_id->id);

        if (isset($_POST['addPayment'])) {

            //payment
            $paymentVal = new PaymentvalueModel();
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

            //PaymentdetailsModel::insertDetail($child_id,$s,$decoratorObj->price);

        }


$this->_view();

}

}

?>