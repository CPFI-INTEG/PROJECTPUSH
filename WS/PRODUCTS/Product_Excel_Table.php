
<html>
<head><?php include("../header.php");?>
<meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <link rel="/stylesheet" href="Test_App/index.php/scroll.css">
</head>


<?php
  include("../../DB/dbcon.php");  
  if(session_status() != PHP_SESSION_ACTIVE) {
      session_start();
  }
  echo $Distributor;

  /**$UserType=$_SESSION['UserType']; // THIS IS THE FIELD OF BDM NAME
  $BDM_USERNAME=$_SESSION['BDM_USERNAME']; // THIS IS THE FIELD OF BDM NAME
  $channel=$_SESSION['channel']; // THIS IS THE FIELD OF BDM NAME
  $BusinessUnit=$_SESSION['BU']; // THIS IS THE FIELD OF BDM NAME
  $HoldBatch=$BDM_USERNAME.date('Ym') ;
  $BDMName=$_SESSION['Name']; // THIS IS THE FIELD OF BDM NAME
  //----------------------------------------------------------------------------------
*/
  date_default_timezone_set('Asia/Manila');


  //TO CHECK IF THE BDM HAS ALREADY UPLOAD A TIR DATA
  $strHasUploadedData="";
  $sqlHasData = "select top 1 ID from Upload_Products_Temporary UploadName='".$Username."'";          
  $stmtHasData=sqlsrv_query($con,$sqlHasData);
/*
  
  while($row=sqlsrv_fetch_array($stmtHasData,SQLSRV_FETCH_ASSOC)){
    $strHasUploadedData=$row['id'];
  }

  
*/



  // EXCEL FILE FUNCTION FOR UPLOADING DATA

  include dirname(__FILE__) . '/Classes/PHPExcel/IOFactory.php';


    if(isset($_FILES['file']['name'])){
        
      $file_name = $_FILES['file']['name'];
      $ext = pathinfo($file_name, PATHINFO_EXTENSION);
      
      //Checking the file extension
      if($ext == "xlsx"){

          
          $file_name = $_FILES['file']['tmp_name'];
          $inputFileName = $file_name;

        //  Read your Excel workbook
        try {
          $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
          $objReader = PHPExcel_IOFactory::createReader($inputFileType);
          $objPHPExcel = $objReader->load($inputFileName);
        } catch (Exception $e) {
          die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) 
          . '": ' . $e->getMessage());
        }

        //Table used to display the contents of the file
        
        
        //  Get worksheet dimensions
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

      //  echo $highestColumn;
        
        //if($highestColumn=='E'){
          //  Loop through each row of the worksheet in turn

         // echo $Username

          //TO REPLACE THE LAST UPLOADED DATA
          $queryDelete = "dELETE FROM Upload_Products_Temporary WHERE UploadName='".$Username."'";          
          $stmtDelete=sqlsrv_prepare($con,$queryDelete);
          sqlsrv_execute($stmtDelete);
          sqlsrv_free_stmt($stmtDelete);

          //To isnert data in database

          
          for ($row =7; $row <= $highestRow; $row++) {
            $itemcode=trim(iconv("UTF-8","ISO-8859-1",$sheet->getCell('A'.$row )->getValue())," \t\n\r\0\x0B\xA0");
            //  Read a row of data into an array
            $rowData = $sheet->rangeToArray('B' . $row . ':' . 'I' . $row, NULL, TRUE, FALSE);
            $strData="";
            foreach($rowData[0] as $k=>$v)
            $strData.="'".str_replace("'","''",$v)."'" . ",";
            $strData=str_replace("\t","",substr($strData,0,strlen($strData)-1));
            
            //ltrim(" ",$strData)

            // INSERT TO TEMPORARY TABLE
            $query = "insert into Upload_Products_Temporary(ItemCode,ProdDesc,Category,ProdCat,UBA_CATEGORY,UOMCode,Conversion,UnitPrice,Stat,Name,UploadName)  VALUES('".$itemcode."',".str_replace("t's","ts", $strData).",'".$Name."','".$Username."')";              
            $stmtUpload=sqlsrv_prepare($con,$query);
            sqlsrv_execute($stmtUpload);
            sqlsrv_free_stmt($stmtUpload);

        // ECHO $query;
          }
          
      
     //   }else{
     //     echo '<p style="color:red;">Invalid Data. Please check the format or Employee Informtion.</p>';   
     //   }
      }else{
        echo '<p style="color:red;">Please upload file with xlsx extension only</p>'; 
      } 
        
    }
?>


<body class="hold-transition skin-blue sidebar-mini" onload="myFunction()">
<div class="wrapper">

  <header class="main-header">

     

     <div class="box-footer">
        <input type=hidden value="<?php echo $strHasUploadedData ?>" id="HasDataUploaded" name="HasDataUploaded">
        <a href='Excel_Test1.php'><button type='submit' class='btn btn-primary btn-lg'>Download Excel File</button></a>
        <button type='submit' class='btn btn-primary pull-right btn-lg' onclick="HasData()">Upload Product Data</button>
     </div>

     
      

      <div class="row">

        <div class="col-xs-6"><br><br>
            <div class="box">
              <div class="box-body">
                <form enctype="multipart/form-data" action="Product_Excel_Table.php" method="post" >
                  
                    <table>
                      <tr>
                        <td width="10%"><input type='File' name="file" id="file" required accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"   class='btn btn-primary btn-sm' value='Upload Excel File '></td>
                        <td width="8%"><input class="btn btn-primary btn-sm  pull-right" type="submit" value="Read Data" /></td>                        
                        <td width="80%"></td>
                      <tr>
                    </table>
                    <!-- onchange="onLoadExcel()" -->
                </form><br>
              
                <table id="example1" class="table table-bordered table-striped table-responsive" style="font-size:11pt;width:1000px;height:400px">
                  <thead class='bg-info text-white'>
                    <tr>
                      <?php
                          $strHeader="<th>ItemCode</th>";
                          $strHeader.="<th>Product Description</th>";
                           $strHeader.="<th>Product Brand</th>";
                          $strHeader.="<th>Product Category</th>";
                           $strHeader.="<th>UBA Category</th>";
                          $strHeader.="<th>UOMCode</th>";
                          $strHeader.="<th>Conversion</th>";
                          $strHeader.="<th>Unit Price</th>";
                          $strHeader.="<th>Status</th>";
                          $strHeader.="<th>Short Item Code</th>";
                        echo $strHeader;
                      ?>
                    </tr>
                  </thead>

                  <tbody >

                    <?php
                        include("../../DB/dbcon.php");
                        $sql="select * from Upload_Products_Temporary where UploadName='".$Username."'";
                        $stmt=sqlsrv_query($con,$sql);

                        $strDisplay="";
                         while($row=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
                            $strDisplay.="<tr>";
                               $strDisplay.="<td>$row[ItemCode]</td>";
                               $strDisplay.="<td>$row[ProdDesc]</td>";
                                $strDisplay.="<td>$row[Category]</td>";
                               $strDisplay.="<td>$row[ProdCat]</td>";
                                $strDisplay.="<td>$row[UBA_CATEGORY]</td>";
                               $strDisplay.="<td>$row[UOMCode]</td>";
                               $strDisplay.="<td>$row[Conversion]</td>";
                              $strDisplay.="<td>$row[UnitPrice]</td>";
                               $strDisplay.="<td>$row[Stat]</td>";
                               $strDisplay.="<td>$row[ShortItemCode]</td>";
                            $strDisplay.="</tr>";
                        }
                        echo $strDisplay;
                    ?>
                  </tbody>


                    

                  
                  
                </table>
              </div>
            </div>
          </div>
      </div>
      <!-- /.row (main row) -->

    </section>



  </div>


  
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>


<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<script>
  $("button[name=Poke]").click(function(){
    //alert($(this).data("id"));  
      $.ajax({
          method: "POST",
          url: "UpdatePoke.php",
          data: {DataID:$(this).data("id")}
      }).done(function(msg){
          $("#ViewDetails").html(msg);
      });
  });
</script>


<script>
function myFunction(){
    var PendingNumber = document.getElementById('PendingNumber').value;
    var IsUpdate= document.getElementById('BoolUpdate').value;

      var x = document.getElementById('myDIV');
      if (x.style.display === 'none') { // to validate if theres pending item

          if(PendingNumber==""){
           //  alert(IsUpdate); 
           // if(IsUpdate=="true"){ // to validate if displaying of ALERT is okay na
           //  x.style.display = 'block';  
          //  }else{
              window.open('Function/UpdateSubmitted.php','_self') ;
          //  }
          }else{
            alert('Kindly complete all status per row.');
          }
      } else {
          x.style.display = 'none';
          if(IsUpdate=="true"){ // to validate if displaying of ALERT is okay na}
            x.style.display = 'block';  
          }
          
      }
    
}

</script>

<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>

<script>
  function onLoadExcel(){
    location.reload();
  }

  function HasData(){
    var HasDataUploaded=document.getElementById("HasDataUploaded").value;

    if(HasDataUploaded!=""){
        var Answer=confirm("Do you want to modify the uploaded data?");
        if(Answer){
            window.open('PROCEDURE/UploadExcelItem.php','_self');
        }
    }else{
      window.open('PROCEDURE/UploadExcelItem.php','_self');
    }
  }

</script>


</body>
</html>



