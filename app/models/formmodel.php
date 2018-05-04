<?php
namespace PHPMVC\Models;

class FormModel
{
    public static function createElement($attrObj){
        $type = $attrObj->type;
        $classpath  = "PHPMVC\\Models\\".$type;
        if(class_exists($classpath)){
            $formElement=new $classpath($attrObj);  
        }else{
            $input = "PHPMVC\\Models\\Input";
            $formElement = new $input($attrObj);
        }
        return $formElement->getHTML();
    }
}