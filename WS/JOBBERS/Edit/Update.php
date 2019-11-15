<HTML>
<head>
	
<meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <link rel="/stylesheet" href="Test_App/index.php/scroll.css">
<title>Distributor Maintenance</title>
<?PHP 

   require_once("../../../DB/dbcon.php");

if(isset($_GET['ID'])){
	$input = $_GET['ID'];
}
$ID=base64_url_decode($input);
//Now you can use this query to see how many rows you are dealing with
//Edit $result as your query
$SqlData = sqlsrv_query($con,"	SELECT * FROM DSRDistributor WHERE ID='$ID'");
while($row = sqlsrv_fetch_array($SqlData)){
	$DistributorID = $row['DistributorID'];
	$DistributorName = $row['DistributorName'];
	$Address = $row['Address'];
	$Province = $row['Province'];
	$Area = $row['Area'];
	$ASM = $row['ASM'];
	$TSM = $row['TSM'];
  
}


if(isset($_POST['submit'])){
	$DistributorID = $_POST['DistributorID'];
	$DistributorName = $_POST['DistributorName'];
	$Address = $_POST['Address'];
	$Province = $_POST['Province'];
	$Area = $_POST['Area'];
	$ASM = $_POST['ASM'];
	$TSM = $_POST['TSM'];
	$ID = $_POST['ID'];
	$q = "JOBBERS_MOD~UPDATEJOBBERS~".$DistributorID."~".$DistributorName."~".$Address."~".$Province."~".$Area."~".$ASM."~".$TSM."~".$ID;
	
header("Location: ../PROCEDURE/?msg=".base64_url_encode($q));

}

?>

<div class="container">
<H3><legend>Update Jobber</legend></H3>
	<form action="?" method="post" style="font-size:11">
			<input type="hidden" class="form-control" placeholder="EmailID" value="<?php echo $ID?>" name="ID" />
		<label>DISTRIBUTOR ID</label>
		<input type="text" class="form-control" placeholder="DistributorID" value="<?php echo $DistributorID?>" name="DistributorID" /><br>
		
		<label>DISTRIBUTOR NAME</label>
		<input type="text" class="form-control" placeholder="DistributorName" value="<?php echo $DistributorName?>" name="DistributorName" /><br>
		
		<label>ADDRESS</label>
		<input type="text" class="form-control" placeholder="Address" value="<?php echo $Address?>" name="Address" /><br>
		
		<label>PROVINCE</label>
		<input type="text" class="form-control" placeholder="Province" value="<?php echo $Province?>" name="Province" /><br>
		
		<label>AREA</label>
		<input type="text" class="form-control" placeholder="Area" value="<?php echo $Area?>" name="Area" /><br>

		
		<label>ASM</label>
		<input type="text" class="form-control" placeholder="ASM" value="<?php echo $ASM?>" name="ASM" /><br>
		
		<label>TSM</label>
		<input type="text" class="form-control" placeholder="TSM" value="<?php echo $TSM?>" name="TSM" /><br>
		
		<a href="../" class="btn btn-danger"  style="margin-left:5px;float:right">Cancel</a>
		<button type="submit" class="btn btn-primary" name="submit" id="sumbit"  style="float:right"/>Update</button>
		
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