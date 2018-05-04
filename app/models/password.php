<?php
namespace PHPMVC\Models;

class Password{
    private $html;
    public function __construct($attrObj){
        $this->html= '<label class="col-sm-2 col-sm-2 control-label">'.$attrObj->attr_name.'</label>';
        $this->html.='<div class="col-sm-4"><input type="password" class="form-control" name="'.$attrObj->sid.'"/></div>';
    }
    public function getHTML(){
        return $this->html;
    }
}