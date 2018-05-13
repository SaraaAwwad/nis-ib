<?php
namespace PHPMVC\Models;
use PHPMVC\Models\iElementModel;

class Number  implements ielementmodel{
    
    private $html;
    public function __construct($attrObj){
        $this->html.= '<label class="col-sm-2 col-sm-2 control-label">'.$attrObj->attr_name.'</label>';
        $this->html.='<div class="col-sm-4"><input type="number" class="form-control" name="'.$attrObj->sid.'"/></div>';
    }

    public function load(){
        return $this->html;
    }
}