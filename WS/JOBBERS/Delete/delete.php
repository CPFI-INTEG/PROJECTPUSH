<?php 
   require_once("../../../DB/dbcon.php");
if(isset($_GET['ID'])){
	$ID=$_GET['ID'];
}

$q = "JOBBERS_MOD~DELETEJOBBERS~".$ID;
header("Location: ../PROCEDURE/?msg=".base64_url_encode($q));


//encode
function base64_url_encode($q){
	return strtr(base64_encode($q), '+/=', '-_,');
}

?>