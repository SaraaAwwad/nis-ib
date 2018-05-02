<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\ParentModel;
use PHPMVC\Models\PaymentmethodModel;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Helper;
use PHPMVC\Models\PaymentselectedattrModel;

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
        $this->_data['methods'] = PaymentmethodModel::getAll();
        if(isset($_POST['action']))
        {
            if($_POST['action'] == 'getAttributes'){
                $m = $_POST['methodd'];
                $paymentSelectedObj = new PaymentselectedattrModel();
                $paymentSelectedObj->getAttr($m);
                alert("hi");

                $output = array(
                    'SelectedAttr' => $paymentSelectedObj,
                    'Attributes' => $paymentSelectedObj->attrObj
                );
                var_dump($output);
                echo json_encode($output);
                return;
            }
        }

        $this->_view();
    }


}

?>