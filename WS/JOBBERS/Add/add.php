<HTML>
<head>
	
<meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <link rel="/stylesheet" href="Test_App/index.php/scroll.css">
<title>Distributor Maintenance</title>
  <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../../assets/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
<?PHP 

   require_once("../../../DB/dbcon.php");



//Now you can use this query to see how many rows you are dealing with
//Edit $result as your query

if(isset($_POST['submit'])){
		$DistributorID = $_POST['DistributorID'];
	$DistributorName = $_POST['DistributorName'];
	$Address = $_POST['Address'];
	$Province = $_POST['Province'];
	$Area = $_POST['Area'];
	$ASM = $_POST['ASM'];
	$TSM = $_POST['TSM'];
		$q = "JOBBERS_MOD~ADDJOBBERS~".$DistributorID."~".$DistributorName."~".$Address."~".$Province."~".$Area."~".$ASM."~".$TSM;

header("Location: ../PROCEDURE/?msg=".base64_url_encode($q));
	//$queryr ="UPDATE dsrTable SET PushSeller='".$q."' where CustCode='".$CustCode."'";
	//$sql = sqlsrv_query($con, $queryr);

}

?>

<div class="container">
<H3><legend>Add Jobber</legend></H3>
	<form action="?" method="post" style="font-size:11">
		<label>DISTRIBUTOR ID</label>
		<input type="text" class="form-control" placeholder="DistributorID"  name="DistributorID" /><br>
		
		<label>DISTRIBUTOR NAME</label>
		<input type="text" class="form-control" placeholder="DistributorName"  name="DistributorName" /><br>
		
		<label>ADDRESS</label>
		<input type="text" class="form-control" placeholder="Address"  name="Address" /><br>
		
		<label>PROVINCE</label>
		<input type="text" class="form-control" placeholder="Province"  name="Province" /><br>
		
		<label>AREA</label>
		<input type="text" class="form-control" placeholder="Area" name="Area" /><br>

		
		<label>ASM</label>
		<input type="text" class="form-control" placeholder="ASM"  name="ASM" /><br>
		
		<label>TSM</label>
		<input type="text" class="form-control" placeholder="TSM"  name="TSM" /><br>
		
		
		<a href="../" class="btn btn-danger"  style="float:right">Cancel</a>
		<button type="submit" class="btn btn-primary" name="submit" id="sumbit"  style="float:right"/>Add</button>
		
	</form>
</head>
<?php
//encode
function base64_url_encode($q){
return strtr(base64_encode($q), '+/=', '-_,');
}

//decode
function base64_url_decode($input){
return base64_decode(strtr($input, '-_,', '+/='));	
}
?>
</HTML>