<?PHP 
require_once("../../../DB/dbcon.php");

if(isset($_GET['msg'])){
	$input = $_GET['msg'];
}

$msg = base64_url_decode($input);

$created_id= 9223372036854;
$outSql = "{CALL sp_returnRawMsgID(?,?)}";
$stmt = sqlsrv_prepare($con, $outSql, 
                      array( 
                        array(&$msg, SQLSRV_PARAM_IN),
                        array(&$created_id, SQLSRV_PARAM_OUT, null, SQLSRV_SQLTYPE_BIGINT)
			));

sqlsrv_execute($stmt);
sqlsrv_next_result($stmt);   // <--- Eto yung solusyon guys :)
echo "$created_id\n"; 


sqlsrv_free_stmt($stmt);  
sqlsrv_close($con);

//decode
function base64_url_decode($input){
	return base64_decode(strtr($input, '-_,', '+/='));		
}
?>