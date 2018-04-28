<?php
namespace PHPMVC\Lib\Database;

 class DatabaseHandler{

    //Singleton design pattern

    static private $_db = null; 

    private function __construct() {}
   
    private function __clone() {} 

    static public function getConnection(){ 
        
        if (self::$_db == null) {
            try {
            self::$_db = new \PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING,
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            ));
            } catch (\PDOException $e) {
            die('<h1>Sorry. The Database connection is temporarily unavailable.</h1>');
            }

           /* self::$_db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);          
            if(self::$_db->connect_error){
                die("Failed to connect" .$this->con->connect_error);
            }*/

          return self::$_db;
        } else {
            return self::$_db;
        }
    }
    
    public static function factory()
    {
        if (self::$_db == null) {
            try {
                self::$_db = new \PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
            } catch (\PDOException $e) {
                die('<h1>Sorry. The Database connection is temporarily unavailable.</h1>');
            }
          return self::$_db;
        } else {
            return self::$_db;
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

}