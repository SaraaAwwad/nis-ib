<?php
	require_once("..\db\database.php");

class pages{

	public $id;
	public $friendlyname;
	public $physicalname;
	public $html;
	public $pageid;
	public $status;
	public $publisher;

	private $db_obj;

	public function __construct($id=""){
		$this->db_obj= new dbconnect();
		if($id != ""){
			$this->getInfo($id);
		}
	}

	public function getInfo($id){

		$sql = "SELECT * FROM pages Where id = '$id' ";
		$userinfo = $this->dbobj->selectsql($sql);
		if($userinfo){
			$row = mysqli_fetch_array($userinfo);
			$this->ID = $row['ID'];
			$this->Name = $row['Name'];
			$this->Description = $row['Description'];
			$this->Image = $row['Image'];
			$this->Category = $row['Category'];
			$this->Status = $row['Status'];
			$this->RestID = $row['RestID'];
			$this->values = array();
		}

	}

	public function insertPage($frname , $phyname , $html){

		$sql = " INSERT INTO pages (friendlyname, physicalname, HTML, pageid, status)
			     VALUES ('$frname', '$phyname', '$html', '0', '0')"; 
	   
	    $stmt = $this->db_obj->executesql($sql);
	    if($stmt){
			
			return ture;

	    }else{
			return false;
		}

	}



}
?>