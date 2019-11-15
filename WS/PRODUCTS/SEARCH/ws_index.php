<?php
	require_once("../../../DB/dbcon.php");

	$s = false;
	if(isset($_GET['s'])){
		$s = $_GET['s'];
	}

	$query = sqlsrv_query($con, "SELECT * FROM dsrSKU
		WHERE stat = 'Active' AND 
		(ItemCode LIKE '%".$s."%' OR ProdDesc LIKE '%".$s."%' OR ProdCat LIKE '%".$s."%' OR
		UOMCode LIKE '%".$s."%' OR Conversion LIKE '%".$s."%' OR UnitPrice LIKE '%".$s."%')
		ORDER BY ID ASC");

	while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC)){
		$data[] = array(
						'ItemCode' => $row['ItemCode'], 
						'ProdDesc' => $row['ProdDesc'],
						'ProdCat' => $row['ProdCat'],
						'UOMCode' => $row['UOMCode'],
						'Conversion' => $row['Conversion'],
						'UnitPrice' => $row['UnitPrice']
						);
	
	}

	if(!empty($data)){
		echo json_encode($data);
	}else{
		//empty
	}
?>