<?php
namespace PHPMVC\Models;
use PHPMVC\Models\iElementModel;

class FormModel{
    private $element;

    public function setElement(iElementModel $elementType)
    {
        $this->element = $elementType;
    }

    public function loadElement()
    {
        return $this->element->load();
    }
}

?>
