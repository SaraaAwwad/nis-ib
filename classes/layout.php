<?php
    require_once("..\db\database.php");

class Layout{

	public $layout_id;
	public $layout_name;
	public $layout_content;
	private $db_obj;

	public function __construct($id=""){
		$this->db_obj= new dbconnect();
		if($id != ""){
			$this->getInfo($id);
		}
	}

	public function getInfo($layout_id){

		$sql = "SELECT * FROM layout Where id = '$id' ";
		$userinfo = $this->db_obj->selectsql($sql);
		if($userinfo){
			$row = mysqli_fetch_array($userinfo);
			$this->layout_id = $row['id'];
			$this->layout_name = $row['name'];
			$this->layout_content = $row['content'];
		}
	}

	public function getContent($id){

		$sql = "SELECT content FROM layout Where  id = '$id' ";
		$stmt = $this->db_obj->selectsql($sql);
		$row = mysqli_fetch_assoc($stmt);
		$content_info = $row['content'];
		return $content_info;

	}
	public function getChildContent($parentID){

		$sql = "SELECT content FROM layout Where parent_id = '$parentID' ";
		$stmt = $this->db_obj->selectsql($sql);
		$row = mysqli_fetch_assoc($stmt);
		$content_info = $row['content'];
		return $content_info;
	}


}
