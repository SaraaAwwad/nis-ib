<?php
	require_once("..\db\database.php");
    require_once("user.php");
  //  require_once("Registeration.php");

class Parents extends User{
    
    public function __construct($id=""){
		if($id != ""){
            parent::__construct($id);
            //$this->getInfo2($id);
           // $this->registeration = new Registeration();
        }
    }

    public function sendMessage($subject, $body, $to, $isReply){
        //send msg to user
        
    }
    
}

?>