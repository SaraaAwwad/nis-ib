<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

interface IpayModel
{

    public function addPayment();
    public function viewPayment();
}

?>