<HTML>
<head>
	
<meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <link rel="/stylesheet" href="Test_App/index.php/scroll.css">
<title>User Maintenance</title>
<?PHP 
 include("../../linkPage.php");
   require_once("../../../DB/dbcon.php");



//Now you can use this query to see how many rows you are dealing with
//Edit $result as your query

if(isset($_POST['submit'])){
		$EmailID = $_POST['EmailID'];
	$Routesalesman = $_POST['Routesalesman'];
	$JobberID = $_POST['JobberID'];
	$JobberName = $_POST['JobberName'];
	$Address = $_POST['Address'];
	$TSM = $_POST['TSM'];
	$ASM = $_POST['ASM'];
	$RS_CODE = $_POST['RS_CODE'];
	$isActive = $_POST['isActive'];

		$q = "USERS_MOD~ADDUSERS~".$EmailID."~".$Routesalesman."~".$JobberID."~".$JobberName."~".$Address."~".$TSM."~".$ASM."~".$RS_CODE;

header("Location: ../PROCEDURE/?msg=".base64_url_encode($q));
	//$queryr ="UPDATE dsrTable SET PushSeller='".$q."' where CustCode='".$CustCode."'";
	//$sql = sqlsrv_query($con, $queryr);

}

?>

<div class="container">
<H3><legend>Add User</legend></H3>
	<form action="?" method="post" style="font-size:11">
		<input type="text" class="form-control" placeholder="EmailID" name="EmailID" /><br>
		<label>Routesalesman</label>
		<input type="text" class="form-control" placeholder="Routesalesman" name="Routesalesman" /><br>
		<label>JobberID</label>
		<input type="text" class="form-control" placeholder="JobberID" name="JobberID" /><br>
		<label>JobberName</label>
		<input type="text" class="form-control" placeholder="JobberName"  name="JobberName" /><br>
		<label>Address</label>
		<input type="text" class="form-control" placeholder="Address"  name="Address" /><br>
		<label>TSM</label>
		<input type="text" class="form-control" placeholder="TSM" name="TSM" /><br>
		<label>ASM</label>
		<input type="text" class="form-control" placeholder="ASM" name="ASM" /><br>
		<label>RS Code</label>
		<?php 
$date =date('Ymdis');
?>
		<input type="hidden" class="form-control" placeholder="RS_CODE" value='<?php echo $date?>'' name="RS_CODE" id="RS_CODE"  /><br>
		
		<a href="../" class="btn btn-danger"  style="margin-left:5px;float:right">Cancel</a>
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