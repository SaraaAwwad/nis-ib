<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;
class TemplateModel
{
    private function addTable($arr , $properties)
    {

        return ' <div class="form-group">
                   <label class="col-sm-2 col-sm-2 control-label">'.$properties.'</label>
                   <div class="col-sm-8">
                   <input name="friendlyname" type="text" class="form-control" required>
                   </div></div>';
    }

}