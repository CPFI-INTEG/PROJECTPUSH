<?php
	  include("../../../DB/dbcon.php");  
	  if(session_status() != PHP_SESSION_ACTIVE) {
      	session_start();
      	 $Username=$_SESSION['Username'];
   
  	  }
/**
  	  $BDMName=$_SESSION['Name']; // THIS IS THE FIELD OF BDM NAME
	  $UserType=$_SESSION['UserType']; // THIS IS THE FIELD OF BDM NAME
	  $BDM_USERNAME=$_SESSION['BDM_USERNAME']; // THIS IS THE FIELD OF BDM NAME
	  $channel=$_SESSION['channel']; // THIS IS THE FIELD OF BDM NAME
	  $BusinessUnit=$_SESSION['BU']; // THIS IS THE FIELD OF BDM NAME
	  */
	//  $HoldBatch=$BDM_USERNAME.date('Ym') ;

	  //TO REPLACE THE LAST UPLOADED DATA
	 /** $queryDelete = "dELETE FROM Upload_Products WHERE UploadName='".$UploadName."'";          
	  $stmtDelete=sqlsrv_prepare($con,$queryDelete);
	  sqlsrv_execute($stmtDelete);
	  sqlsrv_free_stmt($stmtDelete);
*/

	  //INSERT DATA TO FIRST TABLE
	  $sqlUpload1="insert into Upload_Products(ItemCode,ProdDesc,ProdCat,UOMCode,Conversion,UnitPrice,Stat,ShortItemCode,Name,UploadName)SELECT ItemCode,ProdDesc,ProdCat,UOMCode,Conversion,UnitPrice,Stat,ShortItemCode,Name,UploadName from Upload_Products_Temporary where UploadName='".$Username."' and stat='ACTIVE'";
	  
	  $stmtUpload=sqlsrv_prepare($con,$sqlUpload1);
      sqlsrv_execute($stmtUpload);
      sqlsrv_free_stmt($stmtUpload);

	  //INSERT DATA TO FINAL TAABLE
	  $sqlUpload2="insert into DSRSku(ItemCode,ProdDesc,ProdCat,UOMCode,Conversion,UnitPrice,Stat,ShortItemCode,LastUpdated)SELECT ItemCode,ProdDesc,ProdCat,UOMCode,Conversion,UnitPrice,Stat,ShortItemCode,LastUpdated from Upload_Products_Temporary where UploadName='".$Username."' and stat='ACTIVE'";
	  
	  $stmtUpload=sqlsrv_prepare($con,$sqlUpload2);
      sqlsrv_execute($stmtUpload);
      sqlsrv_free_stmt($stmtUpload);

 $queryDelete = "dELETE FROM Upload_Products_Temporary WHERE UploadName='".$Username."'";          
          $stmtDelete=sqlsrv_prepare($con,$queryDelete);
          sqlsrv_execute($stmtDelete);
          sqlsrv_free_stmt($stmtDelete);

echo "<script>window.open('http://dev.push.cpfiportal.com/WS/PRODUCTS/index.php','_self')</script>";
	 
	//  echo "<script language='javascript' type='text/javascript'>window.open(WS/PRODUCTS/index.php','_self')</script>';

?>