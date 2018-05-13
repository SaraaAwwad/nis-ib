<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

abstract class ExtrafeesModel extends AbstractModel implements IpayModel{

    protected $ipay;

    function __construct(IpayModel $ipay)
    {
      $this->ipay = $ipay;
    }
  
    abstract function cost();
    
}

