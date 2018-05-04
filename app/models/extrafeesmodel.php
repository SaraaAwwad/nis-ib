<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

abstract class ExtrafeesModel extends AbstractModel implements IpayModel
{
//reference to the object that will be created from one of the basic classes
    protected $ref_obj;
    protected $amount;

    public function __construct($ref)
    {
        $this->ref_obj = $ref;
    }

    abstract function addPayment();


}

