<?php
namespace PHPMVC\Models;


abstract class FormModel
{
    public static function createElement($type){
        $classpath  = "PHPMVC\\Models\\".$type;
        if(class_exists($classpath)){
            $formElement=new $classpath();
            return $formElement->getHTML();
        }else{
          return false;
        }
    }
}