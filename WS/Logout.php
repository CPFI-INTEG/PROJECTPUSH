<?php 
	include("../DB/dbcon.php");
	if(session_status() != PHP_SESSION_ACTIVE) {
	    session_start();
	}

 	$Username = $_SESSION['Username'];  

 	$Distributor = $_SESSION['Distributor'];    
    $strDesc='Logout in ' . $Username;
    
	$usertype_Desc = $_SESSION['UserType'];
	$sqlAudit="insert into UserLogs(Description,Username,Name,Distributor) values('" . $strDesc . "','" . $Username . "','" . $Username . "','" . $Distributor . "')";

	$stmt=sqlsrv_prepare($con,$sqlAudit);
	sqlsrv_execute($stmt);
	sqlsrv_free_stmt($stmt);
	
	
	session_destroy();
	header("location:/WS/index.php");

	
 ?>