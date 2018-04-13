<?php
require_once("..\db\database.php");
$dbobj = new dbconnect;
$output = '';
$sql = "SELECT * FROM address WHERE add_id = '".$_POST["cityId"]."' ORDER BY address";
$result = $dbobj->executesql2($sql);
$output = '<option value="">Select '.$_POST["cityName"].'</option>';
while($row = mysqli_fetch_array($result))
{
	$output .= '<option value="'.$row["id"].'">'.$row["address"].'</option>';
}

echo $output;
?>