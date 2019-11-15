<?php 
   require_once("../../../DB/dbcon.php");
if(isset($_GET['ID'])){
	$ID=$_GET['ID'];
}

$q = "CUSTOMER_MOD~DELETECUSTOMER~".$ID;
$select = sqlsrv_query($con, "DELETE from Discount_Master_table where ID=$ID");
	header("Location: /WS/DISCOUNT/");
	


//encode
function base64_url_encode($q){
	return strtr(base64_encode($q), '+/=', '-_,');
}

?>