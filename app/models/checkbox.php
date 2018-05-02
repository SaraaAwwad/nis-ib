<?php
namespace PHPMVC\Models;

class Checkbox{
    private $html;
    public function __construct($attrObj){
        $this->html='<label class="col-sm-2 col-sm-2 control-label">'.$attrObj->attr_name.'</label>';

        $options= $attrObj->oid; //ids
        $values = $attrObj->values; //labels
        $list = "";

        foreach($options as $key=>$value){
            $this->html .= '<div class="col-sm-1"><input type="checkbox" name="'.$attrObj->sid.'" value="'.$value.'" />'.$values[$key].'</div>';
        }

    }
    public function getHTML(){
        return $this->html;
    }
}