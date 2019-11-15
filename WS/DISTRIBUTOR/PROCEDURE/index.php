<title>Customer Maintenance</title>
<?php

require_once("../../../DB/dbcon.php");
$input=true;
if(isset($_GET['msg'])){
	$input = $_GET['msg'];
}
$input2=true;
if(isset($_GET['CustCode'])){
	$input2 = $_GET['CustCode'];
}

$isandroid=true;
if(isset($_GET['android'])){
	$isandroid = $_GET['android'];
}

if($isandroid!='yes')
{
$msg=base64_url_decode($input);
	
	
}else{
	$msg=$input;

	
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
echo "$created_id\n";
echo $msg;
?>
<?php
sqlsrv_free_stmt($stmt);  
sqlsrv_close($con);

//encode
function base64_url_encode($q){
return strtr(base64_encode($q), '+/=', '-_,');
}

//decode
function base64_url_decode($input){
return base64_decode(strtr($input, '-_,', '+/='));	
}


?>