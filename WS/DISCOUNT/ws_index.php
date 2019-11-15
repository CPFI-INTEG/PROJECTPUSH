<?php
require_once("../../DB/dbcon.php");

$search = false;
if(isset($_GET['search'])){
$search = $_GET['search'];
}


$q = "SELECT DISTINCT Value FROM Discount_Master_Table";
	$run = sqlsrv_query($con, $q);
	while($row=sqlsrv_fetch_array($run, SQLSRV_FETCH_ASSOC)){
		$data[] = $row;
	}

	if(!empty($data)){
		echo json_encode($data);
	}else{
		//empty
	}
?>