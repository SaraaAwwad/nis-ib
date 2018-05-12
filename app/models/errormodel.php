<?php
namespace PHPMVC\Models;

class ErrorModel extends AbstractModel{

    public static function getError($error_code){
        $query = "SELECT * from error_messages where error_code = :error_code";
        $stmt = self::prepareStmt($query);
        $stmt->bindParam(":error_code", $error_code);

        $error_text = "";
        
        if($stmt->execute()){
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            $error_text = $row["error_text"];
        }

        return $error_text;
    }

}