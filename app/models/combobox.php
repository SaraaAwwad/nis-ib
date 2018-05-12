<?php
namespace PHPMVC\Models;
use PHPMVC\Models\iElementModel;

class Combobox implements ielementmodel{
    private $html;
    public function __construct($attrObj){
        $this->html= '<label class="col-sm-2 col-sm-2 control-label">'.$attrObj->attr_name.'</label>';
        $this->html.='<div class="col-sm-4"><select class="form-control" name="'.$attrObj->sid.'" >';
        $options= $attrObj->oid;
        $values = $attrObj->values;

        $list = "";
        foreach($options as $key=>$value){
           $list .= '<option value = "'.$value.'" >'.$values[$key].'</option>';
        }
        
        $this->html.=$list.'</select></div>';
    }
    public function load(){
        return $this->html;
    }
}