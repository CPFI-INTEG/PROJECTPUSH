<?PHP 
require_once("../../../DB/dbcon.php");

if(isset($_GET['msg'])){
	$msg = $_GET['msg'];
}

$created_id= 9223372036854;
$outSql = "{CALL sp_returnRawMsgID(?,?)}";
$stmt = sqlsrv_prepare($con, $outSql, 
                      array( 
                        array(&$msg, SQLSRV_PARAM_IN),
                        array(&$created_id, SQLSRV_PARAM_OUT, null, SQLSRV_SQLTYPE_BIGINT)
			));

sqlsrv_execute($stmt);
sqlsrv_next_result($stmt);   // <--- Eto yung solusyon guys :)

echo '<script type="text/javascript">alert("submitted successfully!",5000)</script>';

echo '<script>window.location = "http://dev.push.cpfiportal.com/WS/Signup/"</script>'; 

sqlsrv_free_stmt($stmt);  
sqlsrv_close($con);
?>

