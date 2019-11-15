<?php
	require_once("../../DB/dbcon.php");

	$query = sqlsrv_query($con, "SELECT * FROM dsrSKU
		WHERE stat = 'Active' ORDER BY ID ASC");

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