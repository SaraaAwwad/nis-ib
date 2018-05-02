<?php
namespace PHPMVC\Models;

class selectbox{
    private $html;
    public function __construct($attributes=array()){
      /*  if(count($attributes)<1){
            throw new Exception ('Invalid number of attributes');
        }
        $this->html='<select class="form-control"';
        $options="";
        foreach($attributes as $attribute=>$value){
            if($attribute!='options'){
                $this->html.=$attribute.'="'.$value.'" ';
            }
            else{
                foreach($value as $values=>$label){
                    $options.='<option value="'.$values.'">'.$label.'</option>';
                }
            }
        }
        
        $this->html=preg_replace("/'? $/",'">',$this->html);
        $this->html.=$options.'</select>';
    */}
    public function getHTML(){
        return "this->html";
    }
}

class textinput{
    private $html;
    public function __construct($attributes=array()){
        if(count($attributes)<1){
            throw new Exception ('Invalidnumberofattributes');
        }
        $this->html='<input type="text" class="form-control" ';
        foreach($attributes as $attribute=>$value){
            $this->html.=$attribute.'="'.$value.'" ';
        }
        $this->html.='/>';
    }
    public function getHTML(){
        return $this->html;
    }
}
// class paragraph
class paragraph{
    private $html;
    public function __construct($attributes=array()){
        if(count($attributes)<1){
            throw new Exception ('Invalidnumberofattributes');
        }
        $this->html='<p class="form-control">';
        foreach($attributes as $attribute=>$value){
            $this->html.=$value;
        }
        $this->html.='</p>';
    }
    public function getHTML(){
        return $this->html;
    }
}
// class header
class header{
    
    private $html;
    public function __construct($attributes=array()){
        if(count($attributes)<1){
            throw new Exception ('Invalidnumberofattributes');
        }
        $this->html='<h3>';
        foreach($attributes as $attribute=>$value){
            $this->html.=$value;
        }
        $this->html.='</h3>';
    }
    public function getHTML(){
        return $this->html;
    }
}
// class dateinput
class dateinput{
    private $html;
    public function __construct($attributes=array()){
        if(count($attributes)<1){
            throw new Exception ('Invalid number of attributes');
        }
        $this->html='<input type="date" class="form-control"';
        foreach($attributes as $attribute=>$value){
            $this->html.=$attribute.'="'.$value.'" ';
        }
        $this->html.='/>';
    }
    public function getHTML(){
        return $this->html;
    }
}
// class passwordinput
class passwordinput{
    private $html;
    public function __construct($attributes=array()){
        if(count($attributes)<1){
            throw new Exception ('Invalid number of attributes');
        }
        $this->html='<input type="password" class="form-control" ';
        foreach($attributes as $attribute=>$value){
            $this->html.=$attribute.'="'.$value.'" ';
        }
        $this->html.='/>';
    }
    public function getHTML(){
        return $this->html;
    }
}
// class hiddeninput
class hiddeninput{
    private $html;
    public function __construct($attributes=array()){
        if(count($attributes)<1){
            throw new Exception ('Invalid number of attributes');
        }
        $this->html='<input type="hidden" ';
        foreach($attributes as $attribute=>$value){
            $this->html.=$attribute.'="'.$value.'" ';
        }
        $this->html.='/>';
    }
    public function getHTML(){
        return $this->html;
    }
}
// class fileinput
class fileinput{
    private $html;
    public function __construct($attributes=array()){
        if(count($attributes)<1){
            throw new Exception ('Invalid number of attributes');
        }
        $this->html='<input type="file" ';
        foreach($attributes as $attribute=>$value){
            $this->html.=$attribute.'="'.$value.'" ';
        }
        $this->html.='/>';
    }
    public function getHTML(){
        return $this->html;
    }
}
// class imageinput
class imageinput{
    private $html;
    public function __construct($attributes=array()){
        if(count($attributes)<1){
            throw new Exception ('Invalid number of attributes');
        }
        $this->html='<input type="image" ';
        foreach($attributes as $attribute=>$value){
            $this->html.=$attribute.'="'.$value.'" ';
        }
        $this->html.='/>';
    }
    public function getHTML(){
        return $this->html;
    }
}
// class radiobutton
class radiobutton{
    private $html;
    public function __construct($attributes=array()){
        if(count($attributes)<1){
            throw new Exception ('Invalid number of attributes');
        }
        $this->html='<input type="radio" ';
        foreach($attributes as $attribute=>$value){
            $this->html.=$attribute.'="'.$value.'" ';
        }
        $this->html.='/>';
    }
    public function getHTML(){
        return $this->html;
    }
}
// class checkbox
class checkbox{
    private $html;
    public function __construct($attributes=array()){
        if(count($attributes)<1){
            throw new Exception ('Invalid number of attributes');
        }
        $this->html='<input type="checkbox" ';
        foreach($attributes as $attribute=>$value){
            $this->html.=$attribute.'="'.$value.'" ';
        }
        $this->html.='/>';
    }
    public function getHTML(){
        return $this->html;
    }
}
// class button
class button{
    private $html;
    public function __construct($attributes=array()){
        if(count($attributes)<1){
            throw new Exception ('Invalid number of attributes');
        }
        $this->html='<input type="button" ';
        foreach($attributes as $attribute=>$value){
            $this->html.=$attribute.'="'.$value.'" ';
        }
        $this->html.='/>';
    }
    public function getHTML(){
        return $this->html;
    }
}
// class submitbutton
class submitbutton{
    private $html;
    public function __construct($attributes=array()){
        if(count($attributes)<1){
            throw new Exception ('Invalid number of attributes');
        }
        $this->html='<input type="submit" class="form-control"';
        foreach($attributes as $attribute=>$value){
            $this->html.=$attribute.'="'.$value.'" ';
        }
        $this->html.='/>';
    }
    public function getHTML(){
        return $this->html;
    }
}
// class resetbutton
class resetbutton{
    private $html;
    public function __construct($attributes=array()){
        if(count($attributes)<1){
            throw new Exception ('Invalid number of attributes');
        }
        $this->html='<input type="reset" ';
        foreach($attributes as $attribute=>$value){
            $this->html.=$attribute.'="'.$value.'" ';
        }
        $this->html.='/>';
    }
    public function getHTML(){
        return $this->html;
    }
}
// class textarea
class textarea{
    private $html;
    public function __construct($attributes=array()){
        if(count($attributes)<1){
            throw new Exception ('Invalid number of attributes');
        }
        $this->html='<textarea class="form-control" ';
        $textvalue;
        foreach($attributes as $attribute=>$value){
            ($attribute!='value')?$this->html.=$attribute.'="'.$value.'" ':$textvalue=$value;
        }
         $this->html=preg_replace("/'? $/",'"> ',$this->html);
        $this->html.=$textvalue.'</textarea>';
    }
    public function getHTML(){
        return $this->html;
    }
}