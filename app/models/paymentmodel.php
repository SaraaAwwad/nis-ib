<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

abstract class PaymentModel extends AbstractModel implements IpayModel
{
//reference to the object that will be created from one of the basic classes
protected $ref_obj;

public function __construct(IpayModel $ref)
{
    $this->ref_obj = $ref;
}

abstract function addPayment();
abstract function viewPayment();

}

?>