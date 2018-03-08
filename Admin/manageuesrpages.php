<?php
require_once("../classes/pages.php");
require_once("../classes/usertype.php");

$allPages = Pages::getAllPages();
$allTypes = UserType::getAllUserTypes();

?>