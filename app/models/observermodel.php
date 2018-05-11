<?php
namespace PHPMVC\Models;

interface ObserverModel
{
    function notify( $observable);
}

?>