<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class AddressModel{
    public $id;
    public $address;
    public $add_id;

    public function __construct($id=""){
        if($id != ""){
            $this->getInfo($id);
        }
    }

    public function getInfo($id){
        $db = DatabaseHandler::getConnection();
        $sql = "SELECT * FROM address Where id = '$id' ";
        $userinfo = $dbobj->selectsql($sql);
        if($userinfo){
            $row = mysqli_fetch_array($userinfo);
            $this->id = $row['id'];
            $this->address = $row['address'];
            $this->add_id = $row['add_id'];
        }
    }

    Static function InsertinDB($objUser)
    {
        $db = DatabaseHandler::getConnection();
        $sql = "INSERT INTO address (address, add_id)
        VALUES ('$objUser->address', '$objUser->add_id')";
        $dbobj->executesql2($sql);
    }

    function loadCountry(){
        $db = DatabaseHandler::getConnection();
        $sql = "SELECT * FROM address WHERE address in ('Egypt','egypt')";
        $countryinfo = mysqli_query($db,$sql);

        if($countryinfo){
            $row = mysqli_fetch_array($countryinfo);
            $this->id = $row['id'];
            $this->address = $row['address'];
            $this->add_id = $row['add_id'];
        }

       
    }
}