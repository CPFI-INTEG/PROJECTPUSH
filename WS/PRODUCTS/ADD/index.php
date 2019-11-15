<HTML>
<head>
<TITLE>
Add an Item
</TITLE>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../../assets/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
</head>

<?PHP 
require_once("../../../DB/dbcon.php");
 include("../../linkPage.php");
if(isset($_POST['submit'])){
	$ItemCode = $_POST['ItemCode'];
	$ProdDesc = $_POST['ProdDesc'];
	$Category = $_POST['Category'];
	$ProdCat = $_POST['ProdCat'];
		$UBA_CATEGORY = $_POST['UBA_CATEGORY'];
	$UOMCode = $_POST['UOMCode'];
	$Conversion = $_POST['Conversion'];
	$UnitPrice = $_POST['UnitPrice'];

	$q = "PRODUCTS_MOD~ADDITEM~".$ItemCode."~".$ProdDesc."~".$Category."~".$ProdCat."~".$UBA_CATEGORY."~".$UOMCode."~".$Conversion."~".$UnitPrice."~Active";
	header("Location: ../PROCEDURE/?msg=".base64_url_encode($q));
}

//encode
function base64_url_encode($q){
	return strtr(base64_encode($q), '+/=', '-_,');
}
?>
<br><br>
<body style="background-color:lightgrey">
<div class="container" style="background-color:white;margin-top:13px">
<div class="container">
<h3 class="box-body">Add Product</h3>
	<form action="?" method="post" class="form-horizontal">
		<div >
     <div class="col-xs-6">

		<div class="form-group row">
		<label class="col-sm-3 control-label">Item Code</label>
		<div class="col-sm-7">
		<input type="text" class="form-control" placeholder="Item Code" name="ItemCode" required />
		</div></div>

		<div class="form-group row">
		<label class="col-sm-3 control-label">Product Description</label>
		<div class="col-sm-7">
		<input type="text" class="form-control" placeholder="Product Description" name="ProdDesc" required />
		</div></div>

		<div class="form-group row">
		<label class="col-sm-3 control-label">Product Brand</label>
		<div class="col-sm-7">
		<input type="text" class="form-control" placeholder="Product Brand" name="Brand" required />
		</div></div>

		<div class="form-group row">
		<label class="col-sm-3 control-label">Product Category</label>
		<div class="col-sm-7">
		<input type="text" class="form-control" placeholder="Product Category" name="ProdCat" required />
		</div></div></div></div>


		<div class="form-group row">
		<label class="col-sm-3 control-label">UBA Category</label>
		<div class="col-sm-7">
		<input type="text" class="form-control" placeholder="UBA Category" name="UBA_CATEGORY" required />
		</div></div>


		<div class="box-body">
     	<div class="col-xs-6">

		<div class="form-group row">
		<label class="col-sm-3 control-label">UOM Code</label>
		<div class="col-sm-7">
		<input type="text" class="form-control" placeholder="UOM Code" name="UOMCode" required />
		</div></div>

		<div class="form-group row">
		<label class="col-sm-3 control-label">Conversion</label>
		<div class="col-sm-7">
		<input type="text" class="form-control" placeholder="Conversion" name="Conversion" required />
		</div></div>

		<div class="form-group row">
		<label class="col-sm-3 control-label">Unit Price</label>
		<div class="col-sm-7">
		<input type="text" class="form-control" placeholder="Unit Price" name="UnitPrice" required />
		</div></div>

<div class="form-group row">
		<input type="submit" class="btn btn-primary pull-right" class=" col-sm-3" name="submit" value="Add" />
		<button type="reset" class="btn btn-danger pull-right"  class="col-sm-3"><a href="../">Cancel</a></button></div></div></div>
	</form>

</div>
</body>
</HTML>