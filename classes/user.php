<?php
	require_once("\..\db\database.php");
	require_once("usertype.php");
	//session_start();
 class User{
	public $id;
    public $username;
    public $fname;
    public $lname;
    public $DOB;
    public $email;
    public $gender;
    public $img;
    public $telephone = array();
    public $address = array();
    public $status;
	public $dbobj;
	public $UserTypeObj;

	public function __construct($id=""){
		$this->dbobj= new dbconnect();
		if($id != ""){
			$this->getInfo($id);
		}
	}

	public function getInfo($id){
		$sql = "SELECT * FROM user Where id = '$id' ";
		$userinfo = $this->dbobj->selectsql($sql);
		if($userinfo){
			$row = mysqli_fetch_array($userinfo);
			$this->id = $row['id'];
			$this->fname = $row['fname'];
			$this->lname = $row['lname'];
			$this->img = $row['img'];
			$this->DOB = $row['DOB'];
			$this->status = $row['status'];
			$this->username = $row['username'];
			$this->gender = $row['gender'];
			$this->status = $row['status'];
			$this->UserTypeObj=new UserType($row["type_id"]);
		}
		$this->getUserAddress();
		$this->getUserTelephone();
		
	}

	private function getUserAddress(){
		#get each address and put it inside address array
		#store multiple address use 2d array
	}

	private function getUserTelephone(){
		#get multiple telephones and store inside telephone array
	}

	private function getUserType(){
	 	
	}

	Static function isExist($username){
		$dbobj = new dbconnect;
		$sql = "SELECT * FROM user Where username = '$username' ";
		$qresult = $dbobj->selectsql($sql);

		if($qresult->num_rows > 0){
			return $qresult;
		}else{
			return false;
		}
	}

	Static function Login($username, $password){
		$result = self::isExist($username);

		if ($result){
			$row = mysqli_fetch_array($result);

			//if(password_verify($pw, $row['pwd'])){
			if($password== $row['pwd']){
				session_start();
				$_SESSION["userID"] = $row['id'];
				//$_SESSION["userType"] = $row['type_id'];
				return true;
			}
		}
		return false;
	}

	public function updateInfo($listofupdates){
		
		/*$fn = $this->dbobj->test_input($fn);
		$ln = $this->dbobj->test_input($ln);
		$bld = $this->dbobj->test_input($bld);
		$st = $this->dbobj->test_input($st);
		$ar = $this->dbobj->test_input($ar);
		
		$sql = "UPDATE user SET FName= '$fn' ,LName='$ln',Area='$ar', Street= '$st', Building='$bld', PhoneNum='$phone' WHERE UID='$this->ID'";
		$res = $this->dbobj->executesql2($sql);

		if($res){
			$this->FirstName = $fn;
			$this->LastName = $ln;
			$this->Building = $bld;
			$this->Street = $st;
			$this->Area=$ar;
			$this->PhoneNum= $phone;
			return true;
		}else{
			return false;
		}*/
	}
	
	public function updatePw($oldpw, $newpw){
		#makes sure old password is correct 
		#updates new password

		//trim data first
		$old = $this->dbobj->test_input($oldpw);
		$new = $this->dbobj->test_input($newpw);
		$storePw = password_hash($new, PASSWORD_BCRYPT, array('cost'=>8));

		if(!password_verify($old, $this->Password)){
			return false;
		}

		$sql = "UPDATE user SET Password = '$storePw' WHERE UID='$this->ID' ";
		$res = $this->dbobj->executesql($sql);

		if($res){
			return true;
		}else{
			return false;
		}
			
	}

}
?>