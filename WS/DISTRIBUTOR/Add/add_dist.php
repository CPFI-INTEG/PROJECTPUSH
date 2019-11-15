<HTML>
<head>
	
<meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <link rel="/stylesheet" href="Test_App/index.php/scroll.css">
<title>Customer Maintenance</title>
<?PHP 
 include("../../linkPage.php");
   require_once("../../DB/dbcon.php");

if(isset($_POST['submit'])){
//$custcode= $_POST['custcode'];
		$custname = $_POST['custname'];
	$address = $_POST['address'];
	$contact = $_POST['contact'];
	$discount = $_POST['discount'];
	$payment = $_POST['payment'];
	$salesrep = $_POST['salesrep'];

	$status = $_POST['status'];
	$ATTRIB1 = $_POST['ATTRIB1'];
	$ATTRIB2 = $_POST['ATTRIB2'];
	$ATTRIB3= $_POST['ATTRIB3'];
	$ATTRIB4 = $_POST['ATTRIB4'];
	$ATTRIB5 = $_POST['ATTRIB5'];
	$ATTRIB6 = $_POST['ATTRIB6'];
	$isandroid = $_POST['android'];
	$q = "DISTRIBUTOR_MOD~ADDDISTRIBUTOR~"/**.$custcode."~"**/.$custname."~".$address."~".$contact."~".$discount."~".$payment."~".$salesrep."~".$status."~".$ATTRIB1."~".$ATTRIB2."~".$ATTRIB3."~".$ATTRIB4."~".$ATTRIB5."~".$ATTRIB6."~";

header("Location: ../PROCEDURE/?msg=".$q);
	//$queryr ="UPDATE dsrTable SET PushSeller='".$q."' where CustCode='".$CustCode."'";
	//$sql = sqlsrv_query($con, $queryr);

}

?>

<div class="container">
<H3><legend>Add Customer</legend></H3>
	<form action="?" method="post" style="font-size:11">
		
		<div class="input-group col-lg-5" style="width:250px;margin-right:20px;float:left">
		<!--
		<div class="input-group col-lg-5" style="width:250px;margin-right:20px;float:left">
			<span class="input-group-addon glyphicon glyphicon-info-sign"></span>
		<input type="text" class="form-control" placeholder="custcode" name="custcode" /></div>
		-->
		<div class="input-group col-lg-5" style="width:250px;margin-right:20px;float:left">
			<span class="input-group-addon material-icons"></span>
		<input type="text" class="form-control" placeholder="custname" name="custname" /></div>

<div class="input-group col-lg-5" style="width:250px;margin-right:20px;float:left">
			<span class="input-group-addon material-icons"></span>
		<input type="text" class="form-control" placeholder="address" name="address" /></div>	

		<div class="input-group col-lg-5" style="width:250px;margin-right:20px;float:left">
			<span class="input-group-addon material-icons"></span>
		<input type="text" class="form-control" placeholder="contact" name="contact" /></div>
		
		<div class="input-group col-lg-5" style="width:250px;margin-right:20px;float:left">
			<span class="input-group-addon material-icons"></span>
		<input type="text" class="form-control" placeholder="discount" name="discount" /></div>
		
		<div class="input-group col-lg-5" style="width:250px;margin-right:20px;float:left">
			<span class="input-group-addon material-icons"></span>
		<input type="text" class="form-control" placeholder="payment" name="payment" /></div><br>
		<label>SALES_REPRESENTATIVE</label>
		<input type="text" class="form-control" placeholder="salesrep" name="salesrep" 

/><br>
		<label>EMAIL</label>
		<input type="text" class="form-control" placeholder="status" name="status" /><br>
		<label>TSM</label>
		<input type="text" class="form-control" placeholder="ATTRIB1" name="ATTRIB1" /><br>
		<label>ASM</label>
		<input type="text" class="form-control" placeholder="ATTRIB2" name="ATTRIB2" /><br>
		<input type="text" class="form-control" placeholder="ATTRIB3" name="ATTRIB3" /><br>
		<input type="text" class="form-control" placeholder="ATTRIB4" name="ATTRIB4" /><br>
		<input type="text" class="form-control" placeholder="ATTRIB5" name="ATTRIB5" /><br>
		<input type="text" class="form-control" placeholder="ATTRIB6" name="ATTRIB6" /><br>
		
		<a href="../" class="btn btn-danger"  style="margin-left:5px;float:right">Cancel</a>
		<button type="submit" class="btn btn-primary" name="submit"  style="float:right"/>Add</button>
		
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



</script>
</HTML>