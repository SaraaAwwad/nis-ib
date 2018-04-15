<?php
namespace PHPMVC\Lib\Database;

 class DatabaseHandler{

    //Singleton design pattern

    static private $_db = null; // you have only one copy

    private function __construct() {} // private to disallow calling the class via new DBConn  
   
    private function __clone() {} // disallow cloning the class

    static public function getConnection(){ 
        
        if (self::$_db == null) { // No PDO exists yet, so make one and send it back.
          //di el pdo::
           /* try {
            self::$_db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
            } catch (PDOException $e) {
            // Use next line for debugging only, remove or comment out before going live.
             echo 'PDO says: ' . $e->getMessage() . '<br />';
      
            //die('<h1>Sorry. The Database connection is temporarily unavailable.</h1>');
            }*/

            //di el sqli::
            self::$_db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            
            if(self::$_db->connect_error){
                die("Failed to connect" .$this->con->connect_error);
            }

          return self::$_db;
        } else { // There is already a PDO, so just send it back.
            return self::$_db;
        }
    }  

}