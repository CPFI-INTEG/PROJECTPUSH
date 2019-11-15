<?php 

class LibDAO{
	public static function loginAuthenticator($Username, $password){
		try{
			include("../DB/dbcon.php");
			//$sql="select * from dbo.V_TIR_UserAccount where bdm_Username= '".$Username."' and Password= '".$Password."'";
			$sql="exec display_user '".$Username."','".$password."'";
			//ECHO $sql;
			$stmt=sqlsrv_query($con,$sql);							
		
			if ($stmt) {
				$rows = sqlsrv_has_rows($stmt);
				if($rows!=true){
					error_log("Error in Login");
					return false;
				} 
				else{
					$Result=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);
					$_SESSION=$Result;
					//var_dump($Result);
					sqlsrv_free_stmt($stmt);
					error_log("Successfully retrieve");
					return true;
				}				
			}
		}
		catch(Exception $e)
		{
			print_r(sqlsrv_errors(),true);
		}
	}
}