<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;

class AddressModel {
    public $id;
    public $address;
    public $add_id;

    public function __construct($id=""){
        if($id != ""){
            $this->getInfo($id);
        }
    }

    public function getInfo($id){
        $sql = "SELECT * FROM address Where id = '$id' ";
        $db = DatabaseHandler::getConnection();
        $addressinfo = mysqli_query($db,$sql);
        if($addressinfo){
            $row = mysqli_fetch_array($addressinfo);
            $this->id = $row['id'];
            $this->address = $row['address'];
            $this->add_id = $row['add_id']; 
        }
    }

    Static function getCountry(){
        $db = DatabaseHandler::getConnection();
        $sql = "SELECT * FROM address WHERE address in ('Egypt','egypt')";
        $result = mysqli_query($db,$sql);
        $Types= array();
        $i=0;
        while ($row = mysqli_fetch_assoc($result)){
            $AddressObj = new AddressModel($row['id']);
            $Types[$i] = $AddressObj; 
            $i++;
        }
        return $Types;
    }

    Static function getCity($cityid){
        $db = DatabaseHandler::getConnection();
        $sql = "SELECT * FROM address WHERE add_id = '" . $cityid . "'";
        $result = mysqli_query($db,$sql);
        $Types= array();
        $i=0;
        while ($row = mysqli_fetch_assoc($result)){
            $AddressObj = new AddressModel($row['id']);
            $Types[$i] = $AddressObj; 
            $i++;
        }
        return $Types;
    }



}