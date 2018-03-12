<?php
    require_once("..\db\database.php");
    require_once("layout.php");

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
		$userinfo = $this->db_obj->selectsql($sql);
		if($userinfo){
			$row = mysqli_fetch_array($userinfo);
			$this->id = $row['id'];
			$this->friendlyname = $row['friendlyname'];
			$this->physicalname = $row['physicalname'];
			$this->html = $row['HTML'];
		//	$this->pageid = $row['Category'];
			$this->status = $row['status'];
			}

		}


	public function updatePage($frname , $phyname , $html , $stat)
	{	
		$pid = $this->id;
		$id = $this->id;
		$sql = " UPDATE pages
		         SET  friendlyname = '$frname', physicalname= '$phyname' , 
		         HTML = '$html' , status = $stat , pageid = $pid
                 WHERE id = $id";
             
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
			$pagesArr[$i]= $pageObj;
		$i++;
		}
		return $pagesArr;
		
	}
	Static function insertPage($frname , $phyname , $html, $pageid, $status){
		//make validation(no repeated physical name, name.. )
		$db_obj= new dbconnect();
		$sql = " INSERT INTO pages (friendlyname, physicalname, HTML, pageid, status,layout_id_fk)
			     VALUES ('$frname', '$phyname', '$html', '$pageid', '$status',1)"; 
	   
	    $stmt = $db_obj->executesql($sql);
	    if($stmt){
			return true;
	    }else{
			return false;
		}
	}

	public function __get( $key )
    {
        return $this->$key;
    }

    public function __set( $key, $value )
    {
        $this->key = $value;
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

	Static function getAllGroupPages(){
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

	public function viewPage($layoutObj,$pid){

		$dbobj= new dbconnect;
		$sql = "SELECT * FROM pages WHERE id = $pid";
		$stmt = $this->db_obj->selectsql($sql);
		$row = mysqli_fetch_assoc($stmt);
		$gethtml = $row['HTML'];
		$getlayout = $row['layout_id_fk'];
		$layout1 = $layoutObj->getContent($getlayout);
		$layout2 = $layoutObj->getChildContent($getlayout);
		$output = $layout1 . $gethtml .$layout2;  
        return $output;

	}
}
?>