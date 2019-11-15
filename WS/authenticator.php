
<?php

	if(session_status() != PHP_SESSION_ACTIVE) {
	    session_start();
	}
	require_once("../WS/helper.php");
include("../DB/dbcon.php");
	$Username = $_POST['Username'];
	$password = $_POST['Password'];
	

	

	$Handler= new libHandler();

	
		if(!empty($Username) && !empty($password)){
			$result = $Handler->loginAuthenticator($Username, $password);
			if ($result) {
						
				
				echo "<script>window.location.href='../WS/DASHBOARD/'</script>";	
			    //$nameofuser = $_SESSION['nameofuser'];
			    //include("../Data/AuditTrail.php");
			    //$strDesc='Logging in ' . $nameofuser;
			    //SaveAudit($strDesc,"1");

		/*		
	require_once("../DB/dbcon.php");

	if(session_status() != PHP_SESSION_ACTIVE) {
      session_start();
    }
	//$ID=str_replace("'","",$_SESSION['id']);
	$Username1=str_replace("'","",$_SESSION['Username']);
	$Name=str_replace("'","",$_SESSION['Name']);
	$Ds=$_SESSION['Distributor'];
	 

	if(($ID)!="")
	{
		$SqlAudit="insert into UserLogs (Dsecription,Username,Name,Distributor)Values('Login Succefully!','".$Username1."','".$Name."','".$Ds."')";
	}
	

	//echo $SqlAudit;
	$stmtAudit=sqlsrv_prepare($con,$SqlAudit);
	sqlsrv_execute($stmtAudit);
	sqlsrv_free_stmt($stmtAudit);
	//session_destroy();






/*
				$sql="insert into UserLogs (Dsecription,Username,Name,Distributor)Values('Login Succefully!','".$_SESSION['Username']."','".$_SESSION['Name']."','".$_SESSION['Distributor']."')";
				$stmt=sqlsrv_query($con,$sql);	
				sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);
				sqlsrv_free_stmt($stmt);
*/			} else {
					echo "<script>alert('Invalid Username or Password!');window.location.href='../WS/index.php'</script>";
			}
		}else{
				echo "<script>alert('Invalid Username or Password!');window.location.href='../WS/index.php'</script>";
		}
	

?>
