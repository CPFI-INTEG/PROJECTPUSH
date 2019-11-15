<?php
require_once("../../DB/dbcon.php");

$email = false;
$password = false;
if(isset($_GET['email'])){
$email = $_GET['email'];
}
if(isset($_GET['password'])){
$password = $_GET['password'];
}

$q = "exec user_auth '".$email."','".$password."',''";
	$run = sqlsrv_query($con, $q);
	while($row=sqlsrv_fetch_array($run, SQLSRV_FETCH_ASSOC)){
		$data[] = $row;
	}

	if(!empty($data)){
		echo '[{"result":"correct"}]';
	}else{
		//empty
		echo '[{"result":"incorrect"}]';
	}
?>
