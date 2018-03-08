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
		$pageinfo = $this->db_obj->selectsql($sql);
		if($pageinfo){
			$row = mysqli_fetch_array($pageinfo);
			$this->id = $row['id'];
			$this->friendlyname = $row['friendlyname'];
			$this->physicalname = $row['physicalname'];
			$this->html = $row['HTML'];
			$this->pageid = $row['pageid'];
			$this->status = $row['status'];
		}

	}

	public function insertPage($frname , $phyname , $html , $stat){

		$sql = " INSERT INTO pages (friendlyname, physicalname, HTML, pageid, status)
			     VALUES ('$frname', '$phyname', '$html', '0', $stat)"; 
	   
	    $stmt = $this->db_obj->executesql($sql);
	    return $stmt;

	}

	public function updatePage($frname , $phyname , $html , $stat)
	{
		$sql = " UPDATE pages
		         SET  friendlyname = '$frname', physicalname= '$phyname' , 
		         HTML = '$html' , status = $stat , pageid = 0
                 WHERE id = 16";
             
        $stmt = $this->db_obj->executesql($sql);
        return $stmt;

	}

	Static function listPages()
	{
		$db = new dbconnect;
		$sql = " SELECT * FROM pages "; 
		$stmt = $db->executesql2($sql);
		$i=0;
		$pagesArr = array();
		while ($row = mysqli_fetch_assoc($stmt)){

			$pageObj = new pages($row['id']);
			$pageObj->friendlyname = $row['friendlyname'];
			$pageObj->physicalname = $row['physicalname'];
			$pageObj->html = $row['HTML'];
			$pageObj->pageid = $row['pageid'];
			$pageObj->status = $row['status'];
			$pagesArr[$i]= $pageObj;
		$i++;
		}
		return $pagesArr;
	}

	public function __get( $key )
    {
        return $this->$key;
    }

    public function __set( $key, $value )
    {
        $this->key = $value;
    }






}
?>