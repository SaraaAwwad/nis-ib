<?php
	require_once("\..\db\database.php");

    class Registeration {
        public function __construct($id=""){
            if($id != ""){
               // parent::__construct($id);
                $this->getInfo2($id);
            }
        }

    }
    
    ?>
