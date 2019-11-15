<HTML>
<head>
	
<?php include('../header.php');?>
<meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <link rel="/stylesheet" href="Test_App/index.php/scroll.css">

<fieldset style="			
background-color: ;margin-left:25px;float:center;">
<fieldset  style="background-color:white;float:center"><center>
<div><b>Discount Table</b></div></center>
				</fieldset>
				<div style="float:right;margin-right:20px">
					
					   <label>Search Discount</label>
<form method="Get" action="?">
<input type="search" name="Search" id="Search" placeholder="Search Discount">
<button type="submit" > <span class='glyphicon glyphicon-search '>Search</span></button>
</div>
<TITLE>
Discount Maintenance
</TITLE>

</head>
<?PHP 

   require_once("../../DB/dbcon.php");
 
    
 


//This checks to see if there is a page number, that the number is not 0, and that the number is actually a number. If not, it will set it to page number to 1.
$pagenum = false;
if ((!isset($_GET['pagenum'])) || (!is_numeric($_GET['pagenum'])) || ($_GET['pagenum'] < 1)) {
	$pagenum = 1; 
} else {
 $pagenum = $_GET['pagenum']; 
}

$search = false;
if(isset($_GET['Search'])){
    $search = $_GET['Search'];
}



$result = sqlsrv_query($con,"SELECT COUNT(*) FROM Discount_Master_table");

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
	$SqlData="SELECT TOP $page_rows * FROM Discount_Master_table WHERE (DiscountID LIKE '%".$search."%')
	AND id NOT IN (SELECT TOP $max id FROM Discount_Master_table WHERE DiscountID LIKE '%".$search."%' ORDER BY id ASC)
	ORDER BY id ASC";
/*$SqlData="select top $page_rows * from dsrCustomerFinal
	where Date not in (select top $max Date from dsrCustomerFinal order by Date asc)
	order by Date asc"; */
//$sp_products 'ba'

$stmtData=sqlsrv_query($con,$SqlData);



$strData="<br>";
$strData="<br>";
$strData="<a href='/WS/DISCOUNT/Add/add.php' class='btn btn-success' style='margin-left:8px;float:left'><span class='glyphicon glyphicon-plus'>ADD<br>DISCOUNT</span></a>";
$strData.="<table id='dtBasicExample' class='table table-bordered table-striped' width='10px' style='font-size:13'>";

$strData.="<thead>";
$strData.="<th>DiscountID</th>";
$strData.="<th>Description</th>";
$strData.="<th>Type</th>";
$strData.="<th>Value</th>";

$strData.="<th>ID</th>";
$strData.="<th>Action</th>";


$strData.= "</thead>";

while($row=sqlsrv_fetch_array($stmtData,SQLSRV_FETCH_ASSOC)){

	$ID= $row['ID'];
$strData.="<tr>";
$strData.="<td>" . $row['DiscountID'] . "</td>";
$strData.="<td>" . $row['Desc'] . "</td>";
$strData.="<td>" . $row['Type'] . "</td>";
$strData.="<td>" . $row['Value'] . "</td>";

$strData.="<td>" . $ID. "</td>";


$strData.="<td width='60px'>

	<a href='/WS/DISCOUNT/Delete/delete.php?ID=".$ID."' style='margin-left:8px''><span class='glyphicon glyphicon-trash'></span></a>
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
		echo"<li><a href='?pagenum=1&s=$search'>First</a></li>";
		$previous = $pagenum-1;
		echo"<li><a href='?pagenum=$previous&s=$search'>Previous</a></li>";
	}
echo "<li><a>Page $pagenum of $last</a></li>";
	if($pagenum==$last){
		echo"<li class='disabled'><a>Next</a></li>";
		echo"<li class='disabled'><a>Last</a></li>";
	}else{
		$next = $pagenum+1;
		echo"<li><a href='?pagenum=$next&s=$search'>Next</a></li>";
		echo"<li><a href='?pagenum=$last&s=$search'>Last</a></li>";
	}

	echo"</ul>";
 
?>

</div>

</fieldset>
</form>
<?php
//encode
function base64_url_encode($CustCode){
return strtr(base64_encode($CustCode), '+/=', '-_,');
}

//decode
function base64_url_decode($input){
return base64_decode(strtr($input, '-_,', '+/='));	
}
?>

<!-- jQuery 2.2.3 -->
<script src="WS/DISCOUNT/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="WS/DISCOUNT/https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>

<!-- jQuery 2.2.3 -->
<script src="WS/DISCOUNT/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="WS/DISCOUNT/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="WS/DISCOUNT/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="WS/DISCOUNT/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="WS/DISCOUNT/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="WS/DISCOUNT/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="WS/DISCOUNT/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="WS/DISCOUNT/dist/js/demo.js"></script>
<script src="WS/DISCOUNT/plugins/iCheck/icheck.min.js"></script>
</html>