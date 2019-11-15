<?php
	  include("../../../DB/dbcon.php");  
	  if(session_status() != PHP_SESSION_ACTIVE) {
      	session_start();
  	  }

  $Distributor=$_SESSION['Distributor']; // THIS IS THE FIELD OF BDM NAME
    $Username=$_SESSION['Username'];
    $Name=$_SESSION['Name'];
 $JobberId=$_SESSION['DistID'];
     $usertype=$_SESSION['UserType'];

	  //TO REPLACE THE LAST UPLOADED DATA
	  $queryDelete = "dELETE FROM Upload_Products WHERE UploadName='".$Username."'";          
	  $stmtDelete=sqlsrv_prepare($con,$queryDelete);
	  sqlsrv_execute($stmtDelete);
	  sqlsrv_free_stmt($stmtDelete);

	  //INSERT DATA TO FINAL TAABLE
	  $sqlUpload="Insert into Upload_Products(ItemCode,ProdDesc,Category,ProdCat,UBA_CATEGORY,UOMCode,Conversion,UnitPrice,Stat,Name,UploadName)SELECT ItemCode,ProdDesc,Category,ProdCat,UBA_CATEGORY,UOMCode,Conversion,UnitPrice,Stat,Name,UploadName from dbo.Upload_Products_Temporary where  ItemCode  !=' ' OR ProdDesc !='' AND UploadName='".$Username."'
";
	  $stmtUpload=sqlsrv_prepare($con,$sqlUpload);
      sqlsrv_execute($stmtUpload);
      sqlsrv_free_stmt($stmtUpload);

      $sqlUpload="Insert into DsrSku(ItemCode,ProdDesc,Category,ProdCat,UBA_CATEGORY,UOMCode,Conversion,UnitPrice,Stat,ShortItemCode)SELECT ItemCode,ProdDesc,Category,ProdCat,UBA_CATEGORY,UOMCode,Conversion,UnitPrice,Stat,REPLICATE('0',5-LEN(RTRIM(ID))) + RTRIM(ID) from Upload_Products  where  ItemCode  !=' ' OR ProdDesc !='' AND UploadName='".$Username."'";
	  $stmtUpload=sqlsrv_prepare($con,$sqlUpload);
      sqlsrv_execute($stmtUpload);
      sqlsrv_free_stmt($stmtUpload);
echo '<script type="text/javascript">alert("SKU Upload Success",5000)</script>';

echo '<script>window.location = "http://dev.push.cpfiportal.com/WS/Products/"</script>'; 

	  /*//INSERT DATA TO LOGS TABLE "UPLOADED"
	  $sqlUpload="insert into TIP.TIR_UPLOAD_EXCEL_LOGS(DataID,PromoID,Amount,year,type,correctDivision,CorrectExpense,Remarks,corp_meat,corp_sardines,corp_dairy,corp_tuna,corp_hunts,corp_vitacoco,corp_rmb,statusAccomplished,HasValidation,bdm_bu,bdm_name,LastUpload) SELECT DataID,PromoID,Amount,year,type,correctDivision,CorrectExpense,Remarks,corp_meat,corp_sardines,corp_dairy,corp_tuna,corp_hunts,corp_vitacoco,corp_rmb,statusAccomplished,HasValidation,bdm_bu,bdm_name,LastUpload from TIP.TIR_TEMPORARY_UPLOAD_EXCEL where lastupload= '" .$HoldBatch. "'";
	  $stmtUpload=sqlsrv_prepare($con,$sqlUpload);
      sqlsrv_execute($stmtUpload);
      sqlsrv_free_stmt($stmtUpload);	
*/
      /*
      //INSERT TO SHOULD BE ENTRY
	  //,'" .$BDMName. "'
	  $sqlShould=" exec SP_ExcelTIR '" .$HoldBatch. "'";
	  $stmtShould=sqlsrv_prepare($con,$sqlShould);
      sqlsrv_execute($stmtShould);
      sqlsrv_free_stmt($stmtShould);


      // SAVE TO AUDIT TRAIL
      $_SESSION['id']="";
	  $_SESSION['AuditDesc']='Successfully upload Batch ID '. $HoldBatch;
 	  $_SESSION['ModuleName']="Excel Uploading of TIR Data";
  	  include("SaveAudit.php");
		*/



?>