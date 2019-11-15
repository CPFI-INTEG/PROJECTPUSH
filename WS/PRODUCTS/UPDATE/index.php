<HTML>
<head>
<TITLE>
Update Product
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
if(isset($_GET['u'])){
	$input = $_GET['u'];
}
	
$id = base64_url_decode($input);

$result = sqlsrv_query($con,"SELECT * FROM dsrsku WHERE id=$id");
while($row = sqlsrv_fetch_array($result)){
	$itemCode = $row['ItemCode'];
	$prodDesc = $row['ProdDesc'];

	$category = $row['Category'];
	$prodCat = $row['ProdCat'];
	$uba_cat = $row['UBA_CATEGORY'];
	$uom = $row['UOMCode'];
	$Conversion = $row['Conversion'];
	$unitPrice = $row['UnitPrice'];
}

if(isset($_POST['submit'])){
	$ItemCode = $_POST['ItemCode'];
	$id = $_POST['identif'];
	$ProdDesc = $_POST['ProdDesc'];

	$Category = $_POST['Category'];
	$ProdCat = $_POST['ProdCat'];
	$UBA_CATEGORY = $_POST['UBA_CATEGORY'];
	$UOMCode = $_POST['UOMCode'];
	$Conversion = $_POST['Conversion'];
	$UnitPrice = $_POST['UnitPrice'];

	$q = "PRODUCTS_MOD~UPDATEITEM~".$ItemCode."~".$ProdDesc."~".$Category."~".$ProdCat."~".$UOMCode."~".$Conversion."~".$UnitPrice."~".$UBA_CATEGORY."~".$id;
	header("Location: ../PROCEDURE/?msg=".base64_url_encode($q));
}
?>
<br><br>
<body style="background-color:lightgrey">
<div class="container" style="background-color:white;margin-top:13px">
<div class="container">
<h3 class="box-body">Add Product</h3>
	<form action="?" method="post" class="form-horizontal">
		<div >
     <div class="col-xs-6"><div class="form-group row">
		<label class="col-sm-3 control-label">ID</label>
		<div class="col-sm-7">
		<input type="text" class="form-control" value="<?php echo $id?>" name="identif" required />
		</div></div>

		<div class="form-group row">
		<label class="col-sm-3 control-label">Item Code</label>
		<div class="col-sm-7">
		<input type="text" class="form-control" value="<?php echo $itemCode?>" name="ItemCode" required />
		</div></div>


		<div class="form-group row">
		<label class="col-sm-3 control-label">Product Description</label>
		<div class="col-sm-7">
		<input type="text" class="form-control"   value="<?php echo $prodDesc?>" name="ProdDesc"  required />
		</div></div>

		<div class="form-group row">
		<label class="col-sm-3 control-label">Product Brand</label>
		<div class="col-sm-7">
		<input type="text" class="form-control"   value="<?php echo $category?>" name="Category"  required />
		</div></div>

		<div class="form-group row">
		<label class="col-sm-3 control-label">Product Category</label>
		<div class="col-sm-7">
		<input type="text" class="form-control" value="<?php echo $prodCat?>" name="ProdCat" required />
		</div></div></div></div>

		<div class="form-group row">
		<label class="col-sm-3 control-label">UBA Category</label>
		<div class="col-sm-7">
		<input type="text" class="form-control" value="<?php echo $uba_cat?>" name="UBA_CATEGORY" required />
		</div></div></div></div>

		<div class="box-body">
     	<div class="col-xs-6">

		<div class="form-group row">
		<label class="col-sm-3 control-label">UOM Code</label>
		<div class="col-sm-7">
		<input type="text" class="form-control" value="<?php echo $uom?>" name="UOMCode" required />
		</div></div>

		<div class="form-group row">
		<label class="col-sm-3 control-label">Conversion</label>
		<div class="col-sm-7">
		<input type="text" class="form-control" value="<?php echo $Conversion?>" name="Conversion" required />
		</div></div>

		<div class="form-group row">
		<label class="col-sm-3 control-label">Unit Price</label>
		<div class="col-sm-7">
		<input type="text" class="form-control" value="<?php echo $unitPrice?>" name="UnitPrice"required />
		</div></div>


		<div class="form-group row">
		<input type="submit" class="btn btn-primary pull-right" class=" col-sm-3" name="submit" value="Update" />
		<button  class="btn btn-danger pull-right"  class="col-sm-3"><a href="../">Cancel</a></button></div></div></div>
	</form>

</div>
</body>


</HTML>

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