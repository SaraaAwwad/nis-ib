<?php
namespace PHPMVC\Models;

class ErrorModel extends AbstractModel{

    public static function getError($error_code){
        $query = "SELECT * from error_messages INNER JOIN error_type ON error_messages.error_type_id_fk = error_type.id
        where error_code = :error_code";

        $stmt = self::prepareStmt($query);
        $stmt->bindParam(":error_code", $error_code);

        $error_text = "";
        $header = "";
        $footer = "";

        if($stmt->execute()){
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            $error_text = $row["error_text"];
            $header = $row["header"];
            $footer = $row["footer"];
        }
        $error_format = $header . $error_text . $footer;

        return $error_format;
    }

}