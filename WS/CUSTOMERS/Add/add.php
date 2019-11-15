<HTML>
<head>
	
<meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <link rel="/stylesheet" href="Test_App/index.php/scroll.css">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../../assets/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
<title>Customer Maintenance</title>
<?PHP 
include("../../linkPage.php");
   require_once("../../../DB/dbcon.php");

$query = sqlsrv_query($con, "SELECT PaymentType FROM Payment_Type ORDER BY ID ASC");
$query2 = sqlsrv_query($con, "SELECT Value FROM Discount_Master_Table ORDER BY Value ASC");

//Now you can use this query to see how many rows you are dealing with
//Edit $result as your query

if(isset($_POST['submit'])){
		$CustCode = $_POST['custcode'];
	$CustName = $_POST['custname'];
	$Address = $_POST['address'];
	$Contact = $_POST['contact'];
	$Discount = $_POST['discount'];
	

	$Payment = $_POST['payment'];
	$SalesRep = $_POST['salesrep'];
	$ATTRIB1 = $_POST['ATTRIB1'];
	$ATTRIB2 = $_POST['ATTRIB2'];
	$ATTRIB3 = $_POST['ATTRIB3'];
	$ATTRIB4 = $_POST['ATTRIB4'];
	$ATTRIB5 = $_POST['ATTRIB5'];

	$ATTRIB6 = $_POST['ATTRIB6'];

	$q = "CUSTOMER_MOD~ADDCUSTOMER~".$CustName."~".$Address."~".$Contact."~".$Discount."~".$Payment."~".$SalesRep."~".$ATTRIB1."~".$ATTRIB2."~".$ATTRIB3."~".$ATTRIB4."~".$ATTRIB5."~".$ATTRIB6;

header("Location: ../PROCEDURE/?msg=".base64_url_encode($q));
	//$queryr ="UPDATE dsrCustomerFinal SET PushSeller='".$q."' where CustCode='".$CustCode."'";
	//$sql = sqlsrv_query($con, $queryr);

}

?>
<body style="background-color:lightgrey">
<div class="container" style="background-color:white;margin-top:15px">
<H3 class="box-title"><legend >Add Customer</legend></H3>
	<form action="?" method="post" style="font-size:13" class="form-horizontal">
	
	
		<div class="box-body">
     <div class="col-xs-6">
<!--
		<div class="form-group row">
		<label class="col-sm-3 control-label">CustCode</label>
		<div class="col-sm-7">
		<input type="text" class="form-control " placeholder="custcode" name="custcode" id="custcode" disable>
		</div></div>
	-->	
		
		<div class="form-group row">
		<label class="col-sm-3 control-label">CustName</label>
		<div class="col-sm-7">
		<input type="text" class="form-control " placeholder="custname" name="custname" id="custname">
		</div></div>
		
		
		<div class="form-group row">
		<label class="col-sm-3 control-label">Province</label>
		<div class="col-sm-7">
		<input type="text" class="form-control " placeholder="address" name="address" id="address">
		</div></div>
		

		<div class="form-group row">
		<label class="col-sm-3 control-label">Contact</label>
		<div class="col-sm-7">
		<input type="text" class="form-control " placeholder="contact" name="contact" id="contact">
		</div></div>
		

		<div class="form-group row">
		<label class="col-sm-3 control-label">Discount</label>
		<div class="col-sm-7">
		<input type="text" class="form-control " placeholder="discount" name="discount" id="discount">
		</div></div>
	
		
		<div class="form-group row">
		<label class="col-sm-3 control-label">Payment</label>
		<div class="col-sm-7">
		<input type="text" class="form-control " placeholder="payment" name="payment" id="payment">
		</div></div>

		<div class="form-group row">
		<label class="col-sm-3 control-label">Sales Representative</label>
		<div class="col-sm-7">
		<input type="text" class="form-control " placeholder="salesrep" name="salesrep" id="SalesRep">
		</div></div>
		</div></div>


		<div class="box-body">
    	 <div class="col-xs-6">



		

		<div class="form-group row">
		<label class="col-sm-3 control-label">ATTRIB 1</label>
		<div class="col-sm-7">
		<input type="text" class="form-control " placeholder="ATTRIB1" name="ATTRIB1" id="ATTRIB1">
		</div></div>

		<div class="form-group row">
		<label class="col-sm-3 control-label">ATTRIB 2</label>
		<div class="col-sm-7">
		<input type="text" class="form-control " placeholder="ATTRIB2" name="ATTRIB2" id="ATTRIB2">
		</div></div>

		<div class="form-group row">
		<label class="col-sm-3 control-label">ATTRIB 3</label>
		<div class="col-sm-7">
		<input type="text" class="form-control " placeholder="ATTRIB3" name="ATTRIB3" id="ATTRIB3">
		</div></div>

		<div class="form-group row">
		<label class="col-sm-3 control-label">ATTRRIB 4</label>
		<div class="col-sm-7">
		<input type="text" class="form-control " placeholder="ATTRIB4" name="ATTRIB4" id="ATTRIB4">
		</div></div>

		<div class="form-group row">
		<label class="col-sm-3 control-label">ATTRIB 5</label>
		<div class="col-sm-7">
		<input type="text" class="form-control " placeholder="ATTRIB5" name="ATTRIB5" id="ATTRIB5">
		</div></div>

		<div class="form-group row">
		<label class="col-sm-3 control-label">ATTRIB 6</label>
		<div class="col-sm-7">
		<input type="text" class="form-control " placeholder="ATTRIB6" name="ATTRIB6"  id="ATTRIB6">
		</div></div>

		</div></div>


			
	<div class="form-group row">
		
		<a href="../" class="btn btn-danger pull-right"  class="col-sm-3">Cancel</a>
		<button type="submit" class="btn btn-primary pull-right" class=" col-sm-3" name="submit" id="submit"  >Submit</button>
	</div>
	</div>		
	</div>
		</form>
	</body>
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