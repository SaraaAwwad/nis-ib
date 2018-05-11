<?php
namespace PHPMVC\Models;

interface ObservableModel
{
    function attach($observer);
    function detach($observer);
}

?>