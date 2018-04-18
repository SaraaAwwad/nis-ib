<?php
namespace PHPMVC\Lib\Database;

 class DatabaseHandler{
    const DATABASE_DRIVER_POD       = 1;
    const DATABASE_DRIVER_MYSQLI    = 2;

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
    
    public static function factory()
    {
        $driver = DATABASE_CONN_DRIVER;
        if ($driver == self::DATABASE_DRIVER_POD) {
            return PDODatabaseHandler::getInstance();
        } elseif ($driver == self::DATABASE_DRIVER_MYSQLI) {
            return MySQLiDatabaseHandler::getInstance();
        }
    }

    static public function removeConnection(){
        self::$_db == null;
    }
    
    /*static public function executesql($sql){
        if($this->con->query($sql) == TRUE){
            //$result = mysqli_query($this->con, $sql);
            return true;
        }else{
            return false;
        }
    }

    static public function executesql2($sql){
        if($this->con->query($sql) == TRUE){
            return $result = mysqli_query($this->con,$sql);
        }else{
            return false;
        }
    }

    static public function insertsql($sql){
        if($this->con->query($sql) == TRUE){
        return mysqli_insert_id($this->con);
        }else{
            return false;
        }
    }

    static public function query($query) {
        $result = mysqli_query($this->con,$query);
        return $result;
    }

    static public function selectsql($sql){
        if($result = mysqli_query($this->con, $sql))
        return $result;
        else
        return false;
    }

    static public function selectsql2($sql){
        if($result = mysqli_query($this->con, $sql))
          {$num = mysqli_num_rows ( $result );
         return $num;}
        else
        {return false;}
    }*/

    /*function disconnect(){
        return $this->con->close();
    }*/

    function test_input($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
    }

}