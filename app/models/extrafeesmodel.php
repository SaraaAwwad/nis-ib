<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

abstract class ExtrafeesModel extends AbstractModel implements IpayModel{
    //reference to the object that will be created from one of the basic classes
    //protected $ref_obj;
    //eh dah?
    //protected $amount;

 /*   public function __construct($ref)
    {
        $this->ref_obj = $ref;
    }
*/
    //abstract function addPayment();

    protected $ipay;

    function __construct(IpayModel $ipay)
    {
      $this->ipay = $ipay;
    }
  
    abstract function cost();
    
}

