<?php
use PHPMVC\Lib\Database\DatabaseHandler;

$output = '';
$sql = "SELECT * FROM address WHERE add_id = '".$_POST["cityId"]."' ORDER BY address";
$db = DatabaseHandler::getConnection();
$result = mysqli_query($db,$sql);
$output = '<option value="">Select '.$_POST["cityName"].'</option>';
while($row = mysqli_fetch_array($result))
{
	$output .= '<option value="'.$row["id"].'">'.$row["address"].'</option>';
}
echo $output;
?>