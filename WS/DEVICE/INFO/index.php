<?php
require_once("../../../DB/dbcon.php");

$IMEI = false;
$password = false;
if(isset($_GET['IMEI'])){
$IMEI = $_GET['IMEI'];
}

$q = "Select * from push_device where IMEI_NUMBER='".$IMEI."'";
  $run = sqlsrv_query($con, $q);
  while($row=sqlsrv_fetch_array($run, SQLSRV_FETCH_ASSOC)){
    $data[] = $row;
   
  }

  if(!empty($data)){
    echo '[{"ressult1":"correct"}]';
  }else{
    //empty
    echo '[{"ressult1":"incorrect"}]';
    echo $_SERVER['REMOTE_HOST'];
  }
?>
