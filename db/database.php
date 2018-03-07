<?php
class dbconnect
{
    private $servername;
    private $username;
    private $password;
    private $db;
    private $con;

    function __construct(){

        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->db = "nefertari";
        $this->con = $this->Connect();
    }

    function connect(){
        $this->con = mysqli_connect($this->servername, $this->username, $this->password, $this->db);
        if($this->con->connect_error){
            die("Failed to connect" .$this->con->connect_error);
        }else{
            return $this->con;
        }
    }

     function executesql($sql){
        if($this->con->query($sql) == TRUE){
            //$result = mysqli_query($this->con, $sql);
            return true;
        }else{
           echo "Error: ". $this->con->error;
            return false;
        }
    }

    function executesql2($sql){
        if($this->con->query($sql) == TRUE){
            return $result = mysqli_query($this->con,$sql);
        }else{
           echo "Error: ". $this->con->error;
            return false;
        }
    }

    function insertsql($sql){
        if($this->con->query($sql) == TRUE){
        return mysqli_insert_id($this->con);
        }else{
            return false;
        }
    }

    function selectsql($sql){

        if($result = mysqli_query($this->con, $sql))
        return $result;
        else
        return false;
    }
       function selectsql2($sql){
        if($result = mysqli_query($this->con, $sql))
          {$num = mysqli_num_rows ( $result );
         return $num;}
        else
        {return false;}
    }

    function disconnect(){
        return $this->con->close();
    }

    function test_input($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
    }
}

?>