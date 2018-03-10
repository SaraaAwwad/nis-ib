<?php
    require_once("\..\db\database.php");
    require_once("pages.php");
    class UserType{
        public $id;
        public $title;
        public $UserPages = array();
    
        public function __construct($id=""){
            $this->dbobj = new dbconnect;
            if($id != ""){
                $this->getInfo($id);
            }
        }
    
        public function getInfo($id){
            $sql = "SELECT * FROM user_type Where ID = '$id' ";
            $userinfo = $this->dbobj->selectsql($sql);
            if($userinfo){
                $row = mysqli_fetch_array($userinfo);
                $this->id = $row['id'];
                $this->title = $row['title'];
            }
            $this->getUserPages();
        }
        
        public function getUserPages(){
            $sql = "SELECT id from user_type_pages WHERE typeid_fk = '$this->id' order by ordervalue ";
            $result = $this->dbobj->selectsql($sql);
            $i=0;
            while ($row = mysqli_fetch_assoc($result)){
                $this->UserPages[$i] = new Pages($row['id']);
                $i++;
            }
        }
    

        Static function insertUserPages($id, $pageid, $ordervalue){
            $dbobj = new dbconnect;
            $sql = "INSERT INTO user_type_pages (typeid_fk, pageid_fk, ordervalue) VALUES ('$id', '$pageid', '$ordervalue')";
            $dbobj->executesql($sql);
        }
    
        Static function delUserPages($id){
            $dbobj= new dbconnect;
            $sql2 = "DELETE FROM user_type_pages WHERE typeid_fk ='$id'";
            $dbobj->executesql($sql2);
        }
        Static function getAllUserTypes(){
            $dbobj= new dbconnect;
            $sql = "SELECT * FROM user_type";
            $result = $dbobj->selectsql($sql);
            $Types= array();
            $i=0;
            while ($row = mysqli_fetch_assoc($result)){
                $UserTypeObj = new UserType($row['id']);
                $Types[$i] = $UserTypeObj;
                $i++;
            }
            return $Types;
        }
    }
?>