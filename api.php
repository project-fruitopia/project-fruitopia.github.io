<?php
require 'connection.php';

$response = array();
$sql = "select * from users";
$result = mysqli_query($con, $sql);
if($result){
	header("Content-Type: JSON");
	$i=0;
	while ($row = mysqli_fetch_assoc($result)){
		$response[$i]['id'] = $row ['id'];;
		$response[$i]['username'] = $row ['username'];
		$response[$i]['user_type'] = $row ['user_type'];
		$response[$i]['email'] = $row ['email'];
		$i++;
	}
	echo json_encode($response, JSON_PRETTY_PRINT);
}

?>