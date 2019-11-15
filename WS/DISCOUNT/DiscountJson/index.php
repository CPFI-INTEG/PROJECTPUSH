<?php
	require_once("../../../DB/dbcon.php");

	

	
	$q = "SELECT Distinct Value FROM Discount_master_Table order by Value Asc ";
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
