<HTML>
<head>
<TITLE>
Product Maintenance
</TITLE>

<?php include('../header.php');?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<?PHP 
require_once("../../DB/dbcon.php");

$s = false;
if(isset($_GET['s'])){
	$s = $_GET['s'];
}

//This checks to see if there is a page number, that the number is not 0, and that the number is actually a number. If not, it will set it to page number to 1.
if ((!isset($_GET['pagenum'])) || (!is_numeric($_GET['pagenum'])) || ($_GET['pagenum'] < 1)) {
	$pagenum = 1; 
} else {
 $pagenum = $_GET['pagenum']; 
}

//Now you can use this query to see how many rows you are dealing with
//Edit $result as your query
$result = sqlsrv_query($con,"SELECT COUNT(*) FROM dsrsku");
$total_rows = sqlsrv_fetch_array($result);
$rows = $total_rows[0];

//This is the number of results displayed per page 
	$page_rows = 10; 

	//This tells us the page number of our last page 
	$last = ceil($rows/$page_rows);

	//Seeing if the current page we are on is the last
	if (($pagenum > $last) && ($last > 0)) {
	 $pagenum = $last; }

	//This sets the range to display in our query 
	$max = ($pagenum - 1) * $page_rows;

	//This is your query again, just spiced up a bit
	//mssql doesnt have that nice limit ability like mysql... so we use this to make it work...
	//the way the table is designed is, "id" is the unique id, and "name" is just a list of names i have in there.
	$result2 = sqlsrv_query($con,"SELECT TOP $page_rows * FROM dsrSKU
	where ID NOT IN (SELECT TOP $max ID FROM dsrSKU ORDER BY ID ASC)
	and stat = 'Active'
	ORDER BY ID ASC"); 

?>
<br><br>
<div class="container">

<div class="col-sm-4">
	<button class='btn btn-default'><a href='ADD/?'>Add an Item</a></button> 
	<button class='btn btn-default'><a href='/WS/PRODUCTS/Product_Excel_Table.php'>Item Excel</a></button>
</div>

<div class="col-sm-4">
</div>

<div class="col-sm-4">

	<form class="form-inline" method="GET" action="SEARCH/?">
		<input type="text" name="s" class="form-control" />
		
<button type="submit" class="btn btn-danger form-control"> <span class='glyphicon glyphicon-search '></span></button>
	</form>
</div>

<?php
$strData="";
$strData.="<table class='table  table-striped table-responsive' style='font-size:11;overflow-y:scroll'>";
	$strData.="<thead class='bg-info text-white'>";
		$strData.="<th>ItemCode</th>";
		$strData.="<th>Product Description</th>";
		$strData.="<th>Brand</th>";
		$strData.="<th>Product Category</th>";
		$strData.="<th>UBA Category</th>";
		$strData.="<th>UOMCode</th>";
		$strData.="<th>Conversion</th>";
		$strData.="<th>Unit Price</th>";
		$strData.="<th><center>Action</center></th>";
	$strData.= "</thead>";

	while($row=sqlsrv_fetch_array($result2,SQLSRV_FETCH_ASSOC)){
			$id = $row['ID'];
			$strData.="<tr>";
			$strData.="<td>" . $row['ItemCode'] . "</td>";
			$strData.="<td>" . $row['ProdDesc'] . "</td>";
				$strData.="<td>" . $row['Category'] . "</td>";
			$strData.="<td>" . $row['ProdCat'] . "</td>";

				$strData.="<td>" . $row['UBA_CATEGORY'] . "</td>";
			$strData.="<td>" . $row['UOMCode'] . "</td>";
			$strData.="<td>" . $row['Conversion'] . "</td>";
			$strData.="<td>" . $row['UnitPrice'] . "</td>";
			$strData.="<td>
						<button class='btn btn-default'><a href=UPDATE/?u=".base64_url_encode($id).">Update</a></button>
						<button class='btn btn-default'><a href=DELETE/?id=".$id.">Delete</a></button>
					   </td>";
		$strData.="</tr>";
	}
	$strData.="</table>";
	echo $strData;
	

	echo "<ul class='pagination'>";
	if($pagenum==1){
		echo"<li class='disabled'><a>First</a></li>";
		$previous = $pagenum-1;
		echo"<li class='disabled'><a>Previous</a></li>";
	}else{
		echo"<li><a href='?pagenum=1'>First</a></li>";
		$previous = $pagenum-1;
		echo"<li><a href='?pagenum=$previous'>Previous</a></li>";
	}
echo "<li><a>Page $pagenum of $last</a></li>";
	if($pagenum==$last){
		echo"<li class='disabled'><a>Next</a></li>";
		echo"<li class='disabled'><a>Last</a></li>";
	}else{
		$next = $pagenum+1;
		echo"<li><a href='?pagenum=$next'>Next</a></li>";
		echo"<li><a href='?pagenum=$last'>Last</a></li>";
	}

	echo"</ul>";
?>

</div>

</HTML>

<?php
	
	function base64_url_encode($id){
		return strtr(base64_encode($id), '+/=', '-_,');
	}

?>