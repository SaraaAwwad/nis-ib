<?php
	require_once("..\db\database.php");

class Pages{

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
			$this->id = $row['id'];
			$this->friendlyname = $row['friendlyname'];
			$this->physicalname = $row['physicalname'];
			$this->HTML = $row['HTML'];
		//	$this->pageid = $row['Category'];
			$this->status = $row['status'];
		}

	}

	Static function insertPage($frname , $phyname , $html){
		#static ya amira.. 
		$this->db_obj= new dbconnect();
		$sql = " INSERT INTO pages (friendlyname, physicalname, HTML, pageid, status)
			     VALUES ('$frname', '$phyname', '$html', '0', '0')"; 
	   
	    $stmt = $this->db_obj->executesql($sql);
	    if($stmt){
			return true;
	    }else{
			return false;
		}

	}

	Static function getAllPages(){
		$dbobj= new dbconnect;
		$sql = "SELECT * FROM pages";
		$result = $dbobj->selectsql($sql);
		$PagesArr= array();
		$i=0;
		while ($row = mysqli_fetch_assoc($result)){
			$PagesObj = new Pages($row['id']);
			$PagesArr[$i] = $PagesObj;
			$i++;
		}
		return $PagesArr;
	}

	Static function getAllPagesGroups(){
		$dbobj= new dbconnect;
		$sql = "SELECT * FROM pages WHERE pageid=0";
		$result = $dbobj->selectsql($sql);
		$PagesArr= array();
		$i=0;
		while ($row = mysqli_fetch_assoc($result)){
			$PagesObj = new Pages($row['id']);
			$PagesArr[$i] = $PagesObj;
			$i++;
		}
		return $PagesArr;
	}
}
?>