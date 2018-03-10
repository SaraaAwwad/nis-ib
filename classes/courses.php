<?php
	require_once("\..\db\database.php");

    class Courses {
        public function __construct($id=""){
            if($id != ""){
               // parent::__construct($id);
                $this->getInfo2($id);
            }
        }

    }
     
    ?>
