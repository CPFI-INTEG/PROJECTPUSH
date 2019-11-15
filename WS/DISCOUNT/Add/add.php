<HTML>
<head>
	
<meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <link rel="/stylesheet" href="Test_App/index.php/scroll.css">
<title>Discount Maintenance</title>
<?PHP 

   require_once("../../../DB/dbcon.php");



//Now you can use this query to see how many rows you are dealing with
//Edit $result as your query

if(isset($_POST['submit'])){
		$DiscountID = $_POST['DiscountID'];
	$Desc = $_POST['Desc'];
	$Type = $_POST['Type'];
	$Value = $_POST['Value'];
	


	$select = sqlsrv_query($con, "exec sp_discount_table '$DiscountID','$Desc','$Type','$Value'");
	header("Location: /WS/DISCOUNT/");



}

?>

<div class="container">
<H3><legend>Add Discount</legend></H3>
	<form action="?" method="post" style="font-size:11">
		<label>DiscountID</label>
		<input type="text" class="form-control" placeholder="DiscountID" name="DiscountID" /><br>
		<label>Description</label>
		<input type="text" class="form-control" placeholder="Description" name="Desc" /><br>
		<label>Type</label>
		<select type="Select" class="form-control" placeholder="Type" name="Type"/><option>--Select Type--</option><option>P</option></select><br>
		<label>Value</label>
		<input type="text" class="form-control" placeholder="Value" name="Value" /><br>
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