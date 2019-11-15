<HTML>
<head>
	<?php 
    if(session_status() != PHP_SESSION_ACTIVE) {
      session_start();
    }



    //check IF SYSTEM IS DOWN
      
   


    //Check If the User is Login or not
    //echo "username : " . $_SESSION['BDM_USERNAME'];
   // echo "password : " . $_SESSION['Password'];
    if(($_SESSION['UserType'])=='Distributor'){        
        header("location:http://dev.push.cpfiportal.com/WS/Dashboard");
    } 

   

  //  header("Location: https://spica.cpfi.com.ph"); /* Redirect browser */

 ?>
<?php include('../header.php');?>
<meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<fieldset style="			
background-color: ;margin-left:25px;float:center;">
<fieldset  style="background-color:white;float:center"><center>
<div><b>Distributor</b></div></center>
				</fieldset>
				<div style="float:right;margin-right:20px">
					
					   <label>Search Distributor</label>
<form method="Get" action="?">
<input type="search" name="Search" id="Search" placeholder="Search Name">
<button type="submit" class='btn btn-danger ' > <span class='glyphicon glyphicon-search '></span></button>
</div>
<TITLE>
Distributor
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



$result = sqlsrv_query($con,"SELECT COUNT(*) FROM DSRDistributor WHERE ID LIKE '%$search%' ");

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
	$SqlData="SELECT TOP $page_rows * FROM DSRDistributor WHERE DistributorName LIKE '%".$search."%' OR DistributorID LIKE '%".$search."%' OR ASM LIKE '%".$search."%' OR TSM LIKE '%".$search."%'
	AND ID NOT IN (SELECT TOP $max ID FROM DSRDistributor WHERE DistributorName LIKE '%".$search."%' OR DistributorID  LIKE '%".$search."%' OR ASM LIKE '%".$search."%' OR TSM LIKE '%".$search."%' ORDER BY ID ASC)
	ORDER BY ID ASC";
/*$SqlData="select top $page_rows * from dsrCustomerFinal
	where Date not in (select top $max Date from dsrCustomerFinal order by Date asc)
	order by Date asc"; */
//$sp_products 'ba'

$stmtData=sqlsrv_query($con,$SqlData);

	

$strData="<br>";
$strData="<br>";
$strData="<a href='/WS/Jobbers/Add/add.php' class='btn btn-success' style='margin-left:8px;float:left'><span class='glyphicon glyphicon-plus'>Add Distributor</span></a>";
$strData.="<table id='dtBasicExample' class='table  table-striped' style='font-size:11'>";

$strData.="<thead class='bg-info text-white'>";
$strData.="<th>Distributor ID</th>";
$strData.="<th>Distributor Name</th>";
$strData.="<th>Address</th>";
$strData.="<th>Province</th>";
$strData.="<th>Area</th>";
$strData.="<th>ASM</th>";
$strData.="<th>TSM</th>";
$strData.="<th>Action</th>";
$strData.= "</thead>";

while($row=sqlsrv_fetch_array($stmtData,SQLSRV_FETCH_ASSOC)){
$ID=$row['ID'];
$strData.="<tr>";
$strData.="<td>" . $row['DistributorID'] . "</td>";
$strData.="<td>" . $row['DistributorName'] . "</td>";
$strData.="<td>" . $row['Address'] . "</td>";
$strData.="<td>" . $row['Province'] . "</td>";
$strData.="<td>" . $row['Area'] . "</td>";
$strData.="<td>" . $row['ASM'] . "</td>";
$strData.="<td>" . $row['TSM'] . "</td>";

$strData.="<td width='60px'>
<a  href='/WS/Jobbers/Edit/Update.php?ID=".base64_url_encode($ID)."' style='float:'left' > <span class='glyphicon glyphicon-pencil ' ></span></a>

	<a href='/WS/Jobbers/Delete/delete.php?ID=".$ID."' style='margin-left:8px''><span class='glyphicon glyphicon-trash'></span></a>
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
function base64_url_encode($ID){
return strtr(base64_encode($ID), '+/=', '-_,');
}

//decode
function base64_url_decode($input){
return base64_decode(strtr($input, '-_,', '+/='));	
}
?>
</html>