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
<div><b>Payment Table</b></div></center>
				</fieldset>
				<div style="float:right;margin-right:20px">
					
					   <label>Search Payment</label>
<form method="Get" action="?">
<input type="search" name="Search" id="Search" placeholder="Search Customer">
<button type="submit" > <span class='glyphicon glyphicon-search '>Search</span></button>
</div>
<TITLE>
Payment Maintenance
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



$result = sqlsrv_query($con,"SELECT COUNT(*) FROM Payment_Type WHERE PaymentType LIKE '%$search%' ");

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
	$SqlData="SELECT TOP $page_rows * FROM Payment_Type WHERE (PaymentType LIKE '%".$search."%')
	AND id NOT IN (SELECT TOP $max ID FROM Payment_Type WHERE PaymentType LIKE '%".$search."%' ORDER BY ID ASC)
	ORDER BY ID ASC";
/*$SqlData="select top $page_rows * from dsrCustomerFinal
	where Date not in (select top $max Date from dsrCustomerFinal order by Date asc)
	order by Date asc"; */
//$sp_products 'ba'

$stmtData=sqlsrv_query($con,$SqlData);

	
$strData="<br>";
$strData="<br>";
$strData="<a href='/WS/CUSTOMERS/Add/add.php' class='btn btn-success' style='margin-left:8px;float:left'><span class='glyphicon glyphicon-plus'>ADD Customer</span></a>";
$strData.="<table id='dtBasicExample' class='table table-bordered table-striped' width='10px' style='font-size:11.5'>";

$strData.="<thead>";
$strData.="<th>Payment ID</th>";
$strData.="<th>PaymentType</th>";
$strData.="<th>ID</th>";
$strData.="<th>Action</th>";
$strData.= "</thead>";

while($row=sqlsrv_fetch_array($stmtData,SQLSRV_FETCH_ASSOC)){

	$PaymentID= $row['PaymentID'];
$strData.="<tr>";
$strData.="<td>" . $row['PaymentID'] . "</td>";
$strData.="<td>" . $row['PaymentType'] . "</td>";
$strData.="<td>" . $row['ID'] . "</td>";
$strData.="<td width='60px'>
<a href='/WS/CUSTOMERS/Edit/Update.php?CustCode=".base64_url_encode($PaymentID)."' style='float:'left'> <span class='glyphicon glyphicon-pencil '></span></a>

	<a href='/WS/CUSTOMERS/Delete/delete.php?CustCode=".$PaymentID."' style='margin-left:8px''><span class='glyphicon glyphicon-trash'></span></a>
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
</html>