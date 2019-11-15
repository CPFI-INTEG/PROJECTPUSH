<?php
  if(session_status() != PHP_SESSION_ACTIVE) {
    session_start();
  }

$Distributor=$_SESSION['Distributor']; // THIS IS THE FIELD OF BDM NAME
    $Username=$_SESSION['Username'];
    $Name=$_SESSION['Name'];
$JobberId=$_SESSION['DistID'];

     $usertype=$_SESSION['UserType'];
   

  //----------------------------------------------------------------------------------

/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2014 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt  LGPL
 * @version    1.8.0, 2014-03-02
 */

/** Error reporting */
error_reporting(E_ALL);


ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Asia/Manila');




if (PHP_SAPI == 'cli')
  die('This example should only be run from a Web Browser');

/** Include PHPExcel */

  include dirname(__FILE__) . '../Classes/PHPExcel/IOFactory.php';

  //CONNECTION TO DATABASE
  $con="";
  $ServerName="sql5019.site4now.net";
  $password='cpfi2015';
  $ConnectInfo=array("DATABASE"=>"db_9e5097_s3056_1","UID"=>"db_9e5097_s3056_1_admin","PWD"=>$password);
  $con=sqlsrv_connect($ServerName,$ConnectInfo);


  // SAVE TO AUDIT TRAIL
  $SqlAudit="insert into UserLogs(Description,Username,Name,Distributor) values('Successfully Download PUSH Excel file : ". gmdate('YMd').'.xlsx'." for  PUSH Product Report','".$Name."','".$Username."','".$Distributor."')";
  $stmtAudit=sqlsrv_prepare($con,$SqlAudit);
  sqlsrv_execute($stmtAudit);
  sqlsrv_free_stmt($stmtAudit);


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("PUSH PRODUCT")
               ->setLastModifiedBy("PUSH PRODUCT")
               ->setTitle("Office 2007 XLSX Test Document")
               ->setSubject("Office 2007 XLSX Test Document")
               ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
               ->setKeywords("office 2007 openxml php")
               ->setCategory("Test result file");

if(session_status() != PHP_SESSION_ACTIVE) {
  session_start();
}
   
$objPHPExcel->createSheet();


// Add some data to the second sheet, resembling some different data types
$objPHPExcel->setActiveSheetIndex(1)
      // HEADER
      ->setCellValue('A1', '')
      ->setCellValue('A2', 'Date & Time    : '.date('l jS \of F Y h:i:s A'))
     


      // CREDIT DATA
      ->setCellValue('A4', 'Date')
      ->setCellValue('B4', 'Receipt Number')
      ->setCellValue('C4', 'Receipt Type')
      ->setCellValue('D4', 'Gross Sales')
      ->setCellValue('E4', 'Discount')
      ->setCellValue('F4', 'Net Sales')
      ->setCellValue('G4', 'Total Collected')
      ->setCellValue('H4', 'Payment Type')
      ->setCellValue('I4', 'POS')
      ->setCellValue('J4', 'Cashier Name')
      ->setCellValue('K4', 'Customer Name')
      ->setCellValue('L4', 'Contact')
      ->setCellValue('M4', 'Qty')
      ->setCellValue('N4', 'Description')
      ->setCellValue('O4', 'Price')
      ->setCellValue('P4', 'Gross Sale Per SKU')
      ->setCellValue('Q4', 'Discount %')
      ->setCellValue('R4', 'Discount Per SKU')
      ->setCellValue('S4', 'Net Sale Per SKU')
      ->setCellValue('T4', 'ITEM Code')
      ->setCellValue('U4', 'Size')
      ->setCellValue('V4', 'QTY (KG)')      
      ->setCellValue('W4', 'CATEGORY')
      ->setCellValue('X4', 'OPERATION TYPE')
      ->setCellValue('Y4', 'AREA')
      ->setCellValue('Z4', 'NET SALES VAT EX')
      ->setCellValue('AA4', 'ITEM CATEGORY')
      ->setCellValue('AB4', 'DISTRIBUTOR');

if($usertype=='Distributor'){
 $sqlModal="select * from dbo.Vw_PUSHSALES where JobberID='".$JobberId."' AND usertype='".$usertype."'  AND JobberName='".$Distributor."' AND  Dim3 not in ('WITHDRAWAL')";
 }elseif ($usertype=='Admin') {
  $sqlModal="select * from dbo.Vw_PUSHSALES where Dim3 not in ('WITHDRAWAL') ";
}
      //echo $sqlModal;


      //where bdm_username='".$parentCode."' and company_Cd in (". $BusinessUnit .")  and IsStatusSubmitted='Pending' and reporting_period in (select max(reporting_period) from [TIP].[Vw_BDMUserTagging] where reporting_year in (select max(reporting_year) from [TIP].[Vw_BDMUserTagging] ) )
      $stmt=sqlsrv_query($con,$sqlModal);

      $x=5;
      $alphabet = range('A', 'AC');      

      while($row=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
      
       

        $objPHPExcel->getActiveSheet()->getStyle('A'.$x) 
          ->getNumberFormat()
          ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
       $objPHPExcel->getActiveSheet()->setCellValueExplicit ('A'.$x, $row['TS'],PHPExcel_Cell_DataType::TYPE_STRING);  
        $objPHPExcel->getActiveSheet()->setCellValue ('B'.$x,$row['WRID'],PHPExcel_Cell_DataType::TYPE_STRING);  
        $objPHPExcel->getActiveSheet()->setCellValue ('C'.$x,$row['Dim3']); 
        $objPHPExcel->getActiveSheet()->setCellValue ('D'.$x,$row['GrossSale']);  
        $objPHPExcel->getActiveSheet()->setCellValue ('E'.$x,$row['Discount']);  
        $objPHPExcel->getActiveSheet()->setCellValue ('F'.$x,$row['NetAmount']); 
        $objPHPExcel->getActiveSheet()->setCellValue ('G'.$x,$row['NetAmount']);
        $objPHPExcel->getActiveSheet()->setCellValue ('H'.$x,$row['Payment_Type']);
        $objPHPExcel->getActiveSheet()->setCellValue ('I'.$x,$row['Routesalesman']);
        $objPHPExcel->getActiveSheet()->setCellValue ('J'.$x,$row['JobberName']);
        $objPHPExcel->getActiveSheet()->setCellValue ('K'.$x,$row['Dim1']);
        $objPHPExcel->getActiveSheet()->setCellValue ('L'.$x,'');
        $objPHPExcel->getActiveSheet()->setCellValue ('M'.$x,$row['QTY']);
        $objPHPExcel->getActiveSheet()->setCellValue ('N'.$x,$row['SKUDesc']);
        $objPHPExcel->getActiveSheet()->setCellValue ('O'.$x,$row['UnitPrice']);
        $objPHPExcel->getActiveSheet()->setCellValue ('P'.$x,$row['Gross_Sale_Per_SKU']);
        $objPHPExcel->getActiveSheet()->setCellValue ('Q'.$x,$row['Dim6'].'%');
        $objPHPExcel->getActiveSheet()->setCellValue ('R'.$x,$row['Discount_Per_SKU']);
        $objPHPExcel->getActiveSheet()->setCellValue ('S'.$x,'=IF(C38="REFUND",""&P'.$x.'-R'.$x.',P'.$x.'-R'.$x.')');     
        $objPHPExcel->getActiveSheet()->setCellValue ('T'.$x,$row['ItemCode']);
        $objPHPExcel->getActiveSheet()->setCellValue ('U'.$x,$row['Conversion']);
        $objPHPExcel->getActiveSheet()->setCellValue ('V'.$x,'=M'.$x.'*U'.$x.'/100');
        $objPHPExcel->getActiveSheet()->setCellValue ('W'.$x,$row['ProdCat']);
        $objPHPExcel->getActiveSheet()->setCellValue ('X'.$x,'');
        $objPHPExcel->getActiveSheet()->setCellValue ('Y'.$x,$row['Address']);
        $objPHPExcel->getActiveSheet()->setCellValue ('Z'.$x,'=S'.$x.'/1.12');
        $objPHPExcel->getActiveSheet()->setCellValue ('AA'.$x,$row['Category']);
        $objPHPExcel->getActiveSheet()->setCellValue ('AB'.$x,$row['JobberName']);

        $objPHPExcel->getActiveSheet()->getStyle('V'.$x)->getNumberFormat()->setFormatCode('0.00'); 
        $objPHPExcel->getActiveSheet()->getStyle('B'.$x)->getNumberFormat()->setFormatCode('0');

        $objPHPExcel->getActiveSheet()->getStyle('B'.$x)->getNumberFormat()->setFormatCode('0');

        $objPHPExcel->getActiveSheet()->getStyle('R'.$x)->getNumberFormat()->setFormatCode('0.00');

        $objPHPExcel->getActiveSheet()->getStyle('S'.$x)->getNumberFormat()->setFormatCode('0.00');
        $objPHPExcel->getActiveSheet()->getStyle('T'.$x)->getNumberFormat()->setFormatCode('0');
          $objPHPExcel->getActiveSheet()->getStyle('U'.$x)->getNumberFormat()->setFormatCode('0.00');
        $objPHPExcel->getActiveSheet()->getStyle('Z'.$x)->getNumberFormat()->setFormatCode('0.00');
        //$objPHPExcel->getActiveSheet()->getStyle('Q'.$x)->getNumberFormat()->setFormatCode('0%');
        $x=$x+1;


        


        




        
        // CREDIT DETAILS FORM -----------------------------------------------------------------------
        //TO GET THE NUMBER OF COLUMNS
        


        //  SHOULD BE ENTRIES FORM -----------------------------------------------------------------------
        //TO GET THE NUMBER OF COLUMNS

      $intCounterLtr=28;
        for($intCount=1;$intCount<=0;$intCount++){
          $intCounterLtr=$intCounterLtr+1;

$objPHPExcel->getActiveSheet()->getStyle($alphabet[$intCounterLtr-1].($x-1))->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
$objPHPExcel->getActiveSheet()->duplicateStyle($objPHPExcel->getActiveSheet()->getStyle('A5'), 'A5:AB1000');
            // SET BACKGROUND COLOR OF CELL 
          $objPHPExcel->getActiveSheet()->getStyle($alphabet[$intCounterLtr-1].($x-1))->applyFromArray(
              array(
                  'fill' => array(
                      'type' => PHPExcel_Style_Fill::FILL_SOLID,
                      'color' => array('rgb' => 'ffff80')
                  )
              )
          );

          // SET BORDER LINE 
          $objPHPExcel->getActiveSheet()->getStyle($alphabet[$intCounterLtr-1].($x-1))->applyFromArray(
            array(
                'borders' => array(
                  'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
              )
          );

          // SET ALIGNMENT
          $objPHPExcel->getActiveSheet()->getStyle($alphabet[$intCounterLtr-1].($x-1))->applyFromArray(
            array(
                'alignment' => array(
                  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                )
              )
          );
        }

///////
      //  STATUS ANSWER  -----------------------------------------------------------------------
        //TO GET THE NUMBER OF COLUMNS
        $intCounterLtr=6;
        for($intCount=1;$intCount<=0;$intCount++){
          $intCounterLtr=$intCounterLtr+1;

          
        $objPHPExcel->getActiveSheet()->getStyle($alphabet[$intCounterLtr-1].($x-1))->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);

          // SET BACKGROUND COLOR OF CELL 
          $objPHPExcel->getActiveSheet()->getStyle($alphabet[$intCounterLtr-1].($x-1))->applyFromArray(
              array(
                  'fill' => array(
                      'type' => PHPExcel_Style_Fill::FILL_SOLID,
                      'color' => array('rgb' => '97b1db')
                  )
              )
          );

          // SET BORDER LINE 
          $objPHPExcel->getActiveSheet()->getStyle($alphabet[$intCounterLtr-1].($x-1))->applyFromArray(
            array(
                'borders' => array(
                  'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
              )
          );

          // SET ALIGNMENT
          $objPHPExcel->getActiveSheet()->getStyle($alphabet[$intCounterLtr-1].($x-1))->applyFromArray(
            array(
                'alignment' => array(
                  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                )
              )
          );


          // FOR AA COLUMN - SUM OF INPUT BUDGET
          // SET BACKGROUND COLOR OF CELL 
          $objPHPExcel->getActiveSheet()->getStyle('H'.($x-1))->applyFromArray(
              array(
                  'fill' => array(
                      'type' => PHPExcel_Style_Fill::FILL_SOLID,
                      'color' => array('rgb' => '97b1db')
                  )
              )
          );

          // SET BORDER LINE 
          $objPHPExcel->getActiveSheet()->getStyle('H'.($x-1))->applyFromArray(
            array(
                'borders' => array(
                  'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
              )
          );

          // SET ALIGNMENT
          $objPHPExcel->getActiveSheet()->getStyle('H'.($x-1))->applyFromArray(
            array(
                'alignment' => array(
                  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                )
              )
          );

          // FOR AA COLUMN - SUM OF INPUT BUDGET
          // SET BACKGROUND COLOR OF CELL 
          $objPHPExcel->getActiveSheet()->getStyle('AB'.($x-1))->applyFromArray(
              array(
                  'fill' => array(
                      'type' => PHPExcel_Style_Fill::FILL_SOLID,
                      'color' => array('rgb' => '97b1db')
                  )
              )
          );

          // SET BORDER LINE 
          $objPHPExcel->getActiveSheet()->getStyle('AB'.($x-1))->applyFromArray(
            array(
                'borders' => array(
                  'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
              )
          );

          // SET ALIGNMENT
          $objPHPExcel->getActiveSheet()->getStyle('AB'.($x-1))->applyFromArray(
            array(
                'alignment' => array(
                  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                )
              )
          );

          // FOR AB COLUMN - SUM OF INPUT BUDGET
          // SET BACKGROUND COLOR OF CELL 
          $objPHPExcel->getActiveSheet()->getStyle('AB'.($x-1))->applyFromArray(
              array(
                  'fill' => array(
                      'type' => PHPExcel_Style_Fill::FILL_SOLID,
                      'color' => array('rgb' => '97b1db')
                  )
              )
          );

          // SET BORDER LINE 
          $objPHPExcel->getActiveSheet()->getStyle('AB'.($x-1))->applyFromArray(
            array(
                'borders' => array(
                  'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
              )
          );

          // SET ALIGNMENT
          $objPHPExcel->getActiveSheet()->getStyle('AB'.($x-1))->applyFromArray(
            array(
                'alignment' => array(
                  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                )
              )
          );
        }
      }

      $objPHPExcel->setActiveSheetIndex(1);
      // HEADER

$objPHPExcel->getActiveSheet()->getStyle('A4:AB4')->getAlignment()->setWrapText(true);



foreach(range('A','AB') as $columnID) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
        ->setAutoSize(true);
}
$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setAutoSize(true);
//LOCK SPECIFIC CELL
$objPHPExcel->getActiveSheet()->getProtection()->setPassword('PPDATA');
$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);


//$objPHPExcel->getActiveSheet()->setAutoFilter('A6:H6');
// SET BACKGROUND COLOR OF CELL
$objPHPExcel->getActiveSheet()->getStyle('A4:AB4')->applyFromArray(
    array(  
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '0099ff','00ffff')
        )
    )
);
// Rename 2nd sheet
$objPHPExcel->getActiveSheet()->setTitle('PUSH SALES');
$objPHPExcel->getActiveSheet()->getStyle('A4:AB4')->applyFromArray(
  array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
           'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
          )
      )
    )
);

$objPHPExcel->setActiveSheetIndex(1);
$objPHPExcel->getActiveSheet()->getStyle('A4:AB4')->getFont()->setBold(true);
//______________________________________________________________________________________________________________________________
//__________________________________________________________________________________________________________________


/**



$objPHPExcel->createSheet();

// Add some data to the second sheet, resembling some different data types
$objPHPExcel->setActiveSheetIndex(2)
      // HEADER
      ->setCellValue('A1', '')
      ->setCellValue('A2', 'Date & Time    : '.date('l jS \of F Y h:i:s A'))
      ->setCellValue('A3', 'TSM & DSP TARGET')

      // CREDIT DATA
      ->setCellValue('A4', 'DBDM')
      ->setCellValue('B4', 'TSM/ASM')
      ->setCellValue('C4', 'AREA')
       ->setCellValue('D4', '')
       ->setCellValue('E4', 'REVENUE TARGET(Vat -Ex)');


$sqlModal="Select TSM,Address from Vw_MTD_Actial_vs_Target";
      //echo $sqlModal;


      //where bdm_username='".$parentCode."' and company_Cd in (". $BusinessUnit .")  and IsStatusSubmitted='Pending' and reporting_period in (select max(reporting_period) from [TIP].[Vw_BDMUserTagging] where reporting_year in (select max(reporting_year) from [TIP].[Vw_BDMUserTagging] ) )
      $stmt=sqlsrv_query($con,$sqlModal);

      $x=5;
      $alphabet = range('A', 'Z');      

      while($row=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
      
          

        $objPHPExcel->getActiveSheet()->getStyle('A'.$x) 
          ->getNumberFormat()
          ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
       $objPHPExcel->getActiveSheet()->setCellValueExplicit ('A'.$x,'');  
        $objPHPExcel->getActiveSheet()->setCellValue ('B'.$x,$row['TSM'],PHPExcel_Cell_DataType::TYPE_STRING);  
        $objPHPExcel->getActiveSheet()->setCellValue ('C'.$x,$row['Address']);  
        $objPHPExcel->getActiveSheet()->setCellValue ('D'.$x,''); 
          $objPHPExcel->getActiveSheet()->setCellValue ('E'.$x,'=C'.$x.'*D'.$x.'');
       

        $x=$x+1;


        


        




        
        // CREDIT DETAILS FORM -----------------------------------------------------------------------
        //TO GET THE NUMBER OF COLUMNS
        


        //  SHOULD BE ENTRIES FORM -----------------------------------------------------------------------
        //TO GET THE NUMBER OF COLUMNS

        $intCounterLtr=0;
        for($intCount=1;$intCount<=5;$intCount++){
          $intCounterLtr=$intCounterLtr+1;


          // SET BACKGROUND COLOR OF CELL 
          $objPHPExcel->getActiveSheet()->getStyle($alphabet[$intCounterLtr-1].($x-1))->applyFromArray(
              array(
                  'fill' => array(
                      'type' => PHPExcel_Style_Fill::FILL_SOLID,
                      'color' => array('rgb' => 'ffff80')
                  )
              )
          );

          // SET BORDER LINE 
          $objPHPExcel->getActiveSheet()->getStyle($alphabet[$intCounterLtr-1].($x-1))->applyFromArray(
            array(
                'borders' => array(
                  'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
              )
          );

          // SET ALIGNMENT
          $objPHPExcel->getActiveSheet()->getStyle($alphabet[$intCounterLtr-1].($x-1))->applyFromArray(
            array(
                'alignment' => array(
                  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                )
              )
          );

        }

      //  STATUS ANSWER  -----------------------------------------------------------------------
        //TO GET THE NUMBER OF COLUMNS
        $intCounterLtr=5;
        for($intCount=1;$intCount<=0;$intCount++){
          $intCounterLtr=$intCounterLtr+1;

          
        $objPHPExcel->getActiveSheet()->getStyle($alphabet[$intCounterLtr-1].($x-1))->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);

          // SET BACKGROUND COLOR OF CELL 
          $objPHPExcel->getActiveSheet()->getStyle($alphabet[$intCounterLtr-1].($x-1))->applyFromArray(
              array(
                  'fill' => array(
                      'type' => PHPExcel_Style_Fill::FILL_SOLID,
                      'color' => array('rgb' => '97b1db')
                  )
              )
          );

          // SET BORDER LINE 
          $objPHPExcel->getActiveSheet()->getStyle($alphabet[$intCounterLtr-1].($x-1))->applyFromArray(
            array(
                'borders' => array(
                  'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
              )
          );

          // SET ALIGNMENT
          $objPHPExcel->getActiveSheet()->getStyle($alphabet[$intCounterLtr-1].($x-1))->applyFromArray(
            array(
                'alignment' => array(
                  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                )
              )
          );


          // FOR AA COLUMN - SUM OF INPUT BUDGET
          // SET BACKGROUND COLOR OF CELL 
          $objPHPExcel->getActiveSheet()->getStyle('E'.($x-1))->applyFromArray(
              array(
                  'fill' => array(
                      'type' => PHPExcel_Style_Fill::FILL_SOLID,
                      'color' => array('rgb' => '97b1db')
                  )
              )
          );

          // SET BORDER LINE 
          $objPHPExcel->getActiveSheet()->getStyle('E'.($x-1))->applyFromArray(
            array(
                'borders' => array(
                  'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
              )
          );

          // SET ALIGNMENT
          $objPHPExcel->getActiveSheet()->getStyle('E'.($x-1))->applyFromArray(
            array(
                'alignment' => array(
                  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                )
              )
          );

          // FOR AA COLUMN - SUM OF INPUT BUDGET
          // SET BACKGROUND COLOR OF CELL 
          $objPHPExcel->getActiveSheet()->getStyle('E'.($x-1))->applyFromArray(
              array(
                  'fill' => array(
                      'type' => PHPExcel_Style_Fill::FILL_SOLID,
                      'color' => array('rgb' => '97b1db')
                  )
              )
          );

          // SET BORDER LINE 
          $objPHPExcel->getActiveSheet()->getStyle('E'.($x-1))->applyFromArray(
            array(
                'borders' => array(
                  'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
              )
          );

          // SET ALIGNMENT
          $objPHPExcel->getActiveSheet()->getStyle('E'.($x-1))->applyFromArray(
            array(
                'alignment' => array(
                  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                )
              )
          );

          // FOR AB COLUMN - SUM OF INPUT BUDGET
          // SET BACKGROUND COLOR OF CELL 
          $objPHPExcel->getActiveSheet()->getStyle('E'.($x-1))->applyFromArray(
              array(
                  'fill' => array(
                      'type' => PHPExcel_Style_Fill::FILL_SOLID,
                      'color' => array('rgb' => '97b1db')
                  )
              )
          );

          // SET BORDER LINE 
          $objPHPExcel->getActiveSheet()->getStyle('E'.($x-1))->applyFromArray(
            array(
                'borders' => array(
                  'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
              )
          );

          // SET ALIGNMENT
          $objPHPExcel->getActiveSheet()->getStyle('E'.($x-1))->applyFromArray(
            array(
                'alignment' => array(
                  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                )
              )
          );
        
}
      }
      $objPHPExcel->setActiveSheetIndex(2);
      // HEADER


foreach(range('A','Z') as $columnID) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
        ->setAutoSize(true);
}


//LOCK SPECIFIC CELL
$objPHPExcel->getActiveSheet()->getProtection()->setPassword('PPDATA');
$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);


//$objPHPExcel->getActiveSheet()->setAutoFilter('A6:H6');
// SET BACKGROUND COLOR OF CELL
$objPHPExcel->getActiveSheet()->getStyle('A4:E4')->applyFromArray(
    array(  
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '0099ff','00ffff')
        )
    )
);
$objPHPExcel->getActiveSheet()->getStyle('A3:E3')->applyFromArray(
     
   array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    )
   


);
$objPHPExcel->getActiveSheet()->getStyle('A3:E3')->applyFromArray(
 array(  
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '99ff33')
        )
    )
 );
// Rename 2nd sheet
$objPHPExcel->getActiveSheet()->setTitle('TARGET');
$objPHPExcel->getActiveSheet()->getStyle('A4:E4')->applyFromArray(
  array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
           'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
          )
      )
    )
);
  
        

//




$objPHPExcel->setActiveSheetIndex(2);
$objPHPExcel->getActiveSheet()->getStyle('A6:C6')->getFont()->setBold(true);
//______________________________________________________________________________________________________________________________
//__________________________________________________________________________________________________________________


//______________________________________________________________________________________________________________________________
//__________________________________________________________________________________________________________________


/**



$objPHPExcel->createSheet();

// Add some data to the second sheet, resembling some different data types
$objPHPExcel->setActiveSheetIndex(3)
      // HEADER
      ->setCellValue('A1', 'Date & Time    : '.date('l jS \of F Y h:i:s A'))
      ->setCellValue('A2', 'Count of Receipt number Row Labels')

      // CREDIT DATA
      ->setCellValue('C2', 'Column Labels')
      ->setCellValue('D2', 'AREA')
      ->setCellValue('E2', 'REVENUE TARGET(Vat -Ex)');


//LOCK SPECIFIC CELL
$objPHPExcel->getActiveSheet()->getProtection()->setPassword('PPDATA');
$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);


//$objPHPExcel->getActiveSheet()->setAutoFilter('A6:H6');
// SET BACKGROUND COLOR OF CELL
$objPHPExcel->getActiveSheet()->getStyle('A4:H4')->applyFromArray(
    array(  
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '0099ff','00ffff')
        )
    )
);
// Rename 2nd sheet
$objPHPExcel->getActiveSheet()->setTitle('WORKING DAYS');
$objPHPExcel->getActiveSheet()->getStyle('A4:H4')->applyFromArray(
  array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
           'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
          )
      )
    )
);

$objPHPExcel->setActiveSheetIndex(3);
$objPHPExcel->getActiveSheet()->getStyle('A6:H6')->getFont()->setBold(true);

//______________________________________________________________________________________________________________________________
//__________________________________________________________________________________________________________________





// Add some data
$objPHPExcel->setActiveSheetIndex(0)
      // HEADER
      ->setCellValue('A1', 'Report Type     : SKU Sales PRODUCT')
      ->setCellValue('A2', '')
      ->setCellValue('A3', 'Date & Time    : '.date('l jS \of F Y h:i:s A'))

      // CREDIT DATA
      ->setCellValue('A6', 'Distributor')
      ->setCellValue('B6', 'TSM/ASM')
      ->setCellValue('C6', 'AREA/ROUTE')
      ->setCellValue('D6', 'REV. TARGET (Vat Ex)')
      ->setCellValue('E6', 'ACTUAL SELL-OUT REVENUE(Vat Ex')
      ->setCellValue('F6', 'ACTUAL VS. TARGET')
      ->setCellValue('G6', 'ACTUAL SELL-IN REVENUE(Vat Ex')
      ->setCellValue('H6', 'ACTUAL VS. TARGET');
          
      $sqlModal="select * from Vw_MTD_Actial_vs_Target";
      //echo $sqlModal;


      //where bdm_username='".$parentCode."' and company_Cd in (". $BusinessUnit .")  and IsStatusSubmitted='Pending' and reporting_period in (select max(reporting_period) from [TIP].[Vw_BDMUserTagging] where reporting_year in (select max(reporting_year) from [TIP].[Vw_BDMUserTagging] ) )
      $stmt=sqlsrv_query($con,$sqlModal);

      $x=7;
      $alphabet = range('A', 'Z');      

      while($row=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
        $objPHPExcel->getActiveSheet()->getStyle('A'.$x) 
          ->getNumberFormat()
          ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
       $objPHPExcel->getActiveSheet()->setCellValueExplicit ('A'.$x,'');  
        $objPHPExcel->getActiveSheet()->setCellValue ('B'.$x,$row['TSM']);  
        $objPHPExcel->getActiveSheet()->setCellValue ('C'.$x,$row['Address']); 
        $objPHPExcel->getActiveSheet()->setCellValue ('D'.$x,''); 
     //"'=SUMIFS('PUSH SALES'!E:E,'PUSH SALES'!H:H,MTD_ACTUAL_vs_TARGET!B'$x')'"
       $objPHPExcel->getActiveSheet()->setCellValue ('E'.$x,'');  
        $objPHPExcel->getActiveSheet()->setCellValue ('F'.$x,'=E'.$x.'/D'.$x.''); 
        $objPHPExcel->getActiveSheet()->setCellValue ('G'.$x,'');
        $objPHPExcel->getActiveSheet()->setCellValue ('H'.$x,'=G'.$x.'/E'.$x.'');


        $objPHPExcel->getActiveSheet()->getStyle('F'.$x)->getNumberFormat()->setFormatCode('0%');
         $objPHPExcel->getActiveSheet()->getStyle('H'.$x)->getNumberFormat()->setFormatCode('0%');

        $x=$x+1;


        


      
        // CREDIT DETAILS FORM -----------------------------------------------------------------------
        //TO GET THE NUMBER OF COLUMNS
        


        //  SHOULD BE ENTRIES FORM -----------------------------------------------------------------------
        //TO GET THE NUMBER OF COLUMNS

        $intCounterLtr=0;
        for($intCount=1;$intCount<=8;$intCount++){
          $intCounterLtr=$intCounterLtr+1;

          $objPHPExcel->getActiveSheet()->getStyle($alphabet[$intCounterLtr-1].($x-1))->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
$objPHPExcel->getActiveSheet()->duplicateStyle($objPHPExcel->getActiveSheet()->getStyle('A7'), 'A7:H'.$x.'');

          // SET BACKGROUND COLOR OF CELL 
          $objPHPExcel->getActiveSheet()->getStyle($alphabet[$intCounterLtr-1].($x-1))->applyFromArray(
              array(
                  'fill' => array(
                      'type' => PHPExcel_Style_Fill::FILL_SOLID,
                      'color' => array('rgb' => 'ffff80')
                  )
              )
          );

          // SET BORDER LINE 
          $objPHPExcel->getActiveSheet()->getStyle($alphabet[$intCounterLtr-1].($x-1))->applyFromArray(
            array(
                'borders' => array(
                  'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
              )
          );

          // SET ALIGNMENT
          $objPHPExcel->getActiveSheet()->getStyle($alphabet[$intCounterLtr-1].($x-1))->applyFromArray(
            array(
                'alignment' => array(
                  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                )
              )
          );

        }

      //  STATUS ANSWER  -----------------------------------------------------------------------
        //TO GET THE NUMBER OF COLUMNS
        $intCounterLtr=7;
        for($intCount=1;$intCount<=0;$intCount++){
          $intCounterLtr=$intCounterLtr+1;

          
        $objPHPExcel->getActiveSheet()->getStyle($alphabet[$intCounterLtr-1].($x-1))->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);

          // SET BACKGROUND COLOR OF CELL 
          $objPHPExcel->getActiveSheet()->getStyle($alphabet[$intCounterLtr-1].($x-1))->applyFromArray(
              array(
                  'fill' => array(
                      'type' => PHPExcel_Style_Fill::FILL_SOLID,
                      'color' => array('rgb' => '97b1db')
                  )
              )
          );

          // SET BORDER LINE 
          $objPHPExcel->getActiveSheet()->getStyle($alphabet[$intCounterLtr-1].($x-1))->applyFromArray(
            array(
                'borders' => array(
                  'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
              )
          );

          // SET ALIGNMENT
          $objPHPExcel->getActiveSheet()->getStyle($alphabet[$intCounterLtr-1].($x-1))->applyFromArray(
            array(
                'alignment' => array(
                  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                )
              )
          );


          // FOR AA COLUMN - SUM OF INPUT BUDGET
          // SET BACKGROUND COLOR OF CELL 
          $objPHPExcel->getActiveSheet()->getStyle('E'.($x-1))->applyFromArray(
              array(
                  'fill' => array(
                      'type' => PHPExcel_Style_Fill::FILL_SOLID,
                      'color' => array('rgb' => '97b1db')
                  )
              )
          );

          // SET BORDER LINE 
          $objPHPExcel->getActiveSheet()->getStyle('E'.($x-1))->applyFromArray(
            array(
                'borders' => array(
                  'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
              )
          );

          // SET ALIGNMENT
          $objPHPExcel->getActiveSheet()->getStyle('E'.($x-1))->applyFromArray(
            array(
                'alignment' => array(
                  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                )
              )
          );

          // FOR AA COLUMN - SUM OF INPUT BUDGET
          // SET BACKGROUND COLOR OF CELL 
          $objPHPExcel->getActiveSheet()->getStyle('E'.($x-1))->applyFromArray(
              array(
                  'fill' => array(
                      'type' => PHPExcel_Style_Fill::FILL_SOLID,
                      'color' => array('rgb' => '97b1db')
                  )
              )
          );

          // SET BORDER LINE 
          $objPHPExcel->getActiveSheet()->getStyle('E'.($x-1))->applyFromArray(
            array(
                'borders' => array(
                  'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
              )
          );

          // SET ALIGNMENT
          $objPHPExcel->getActiveSheet()->getStyle('E'.($x-1))->applyFromArray(
            array(
                'alignment' => array(
                  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                )
              )
          );

          // FOR AB COLUMN - SUM OF INPUT BUDGET
          // SET BACKGROUND COLOR OF CELL 
          $objPHPExcel->getActiveSheet()->getStyle('H'.($x-1))->applyFromArray(
              array(
                  'fill' => array(
                      'type' => PHPExcel_Style_Fill::FILL_SOLID,
                      'color' => array('rgb' => '97b1db')
                  )
              )
          );

          // SET BORDER LINE 
          $objPHPExcel->getActiveSheet()->getStyle('H'.($x-1))->applyFromArray(
            array(
                'borders' => array(
                  'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
              )
          );

          // SET ALIGNMENT
          $objPHPExcel->getActiveSheet()->getStyle('H'.($x-1))->applyFromArray(
            array(
                'alignment' => array(
                  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                )
              )
          );
        }
      }

      $objPHPExcel->setActiveSheetIndex(0);
      // HEADER


foreach(range('A','H') as $columnID) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
        ->setAutoSize(true);
}
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);

// Rename worksheet

$objPHPExcel->getActiveSheet()->setTitle('MTD_ACTUAL_vs_TARGET');


$objPHPExcel->getActiveSheet()->getAutoFilter('A1:J1');


//LOCK SPECIFIC CELL
$objPHPExcel->getActiveSheet()->getProtection()->setPassword('PPDATA');
$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);


//$objPHPExcel->getActiveSheet()->setAutoFilter('A6:H6');
// SET BACKGROUND COLOR OF CELL
$objPHPExcel->getActiveSheet()->getStyle('A6:H6')->applyFromArray(
    array(  
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '33ccff')
        )
    )
);


//This is the key...
/*
$objPHPExcel->getActiveSheet()->getStyle('k6:X6')->applyFromArray(
    array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'ffff1a')
        )
    )
);


$objPHPExcel->getActiveSheet()->getStyle('Y6:AB6')->applyFromArray(
    array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '6599ed')
        )
    )
);

// SET BORDER LINE 
$objPHPExcel->getActiveSheet()->getStyle('A6:H6')->applyFromArray(
  array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN
          )
      )
    )
);

// MERGE CELLS FOR CORPORATE TAF
//$objPHPExcel->getActiveSheet()->mergeCells('R5:X5');
//$objPHPExcel->getActiveSheet()->setCellValue ('R5',"If Reference Type is CORPORATE");
//$objPHPExcel->getActiveSheet()->getStyle("R5")->getFont()->setSize(15);

$objPHPExcel->getActiveSheet()->getStyle("A1")->getFont()->setSize(16);
$objPHPExcel->getActiveSheet()->getStyle("A2")->getFont()->setSize(16);
$objPHPExcel->getActiveSheet()->getStyle("A3")->getFont()->setSize(16);
/*
$objPHPExcel->getActiveSheet()->getStyle('R5')->applyFromArray(
  array(
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
      )
    )
);

// SET BACKGROUND COLOR OF CELL
$objPHPExcel->getActiveSheet()->getStyle('R5')->applyFromArray(
    array(  
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '28e0d7')
        )
    )
);

//---------------------------



// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->getStyle('A1:E4')->getFont()->setBold(true);

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->getStyle('A6:J6')->getFont()->setBold(true);
//--------------------------------------------------------------------------------------------------------------
**/
$objPHPExcel->setActiveSheetIndex(0)
      // HEADER
      ->setCellValue('A1', '')
      ->setCellValue('A2', 'Date & Time    : '.date('l jS \of F Y h:i:s A'))
     


      // CREDIT DATA
      ->setCellValue('A4', 'Date')
      ->setCellValue('B4', 'Receipt Number')
      ->setCellValue('C4', 'Receipt Type')
      ->setCellValue('D4', 'Gross Sales')
      ->setCellValue('E4', 'Discount')
      ->setCellValue('F4', 'Net Sales')
      ->setCellValue('G4', 'Total Collected')
      ->setCellValue('H4', 'Payment Type')
      ->setCellValue('I4', 'POS')
      ->setCellValue('J4', 'Cashier Name')
      ->setCellValue('K4', 'Customer Name')
      ->setCellValue('L4', 'Contact')
      ->setCellValue('M4', 'Qty')
      ->setCellValue('N4', 'Description')
      ->setCellValue('O4', 'Price')
      ->setCellValue('P4', 'Gross Sale Per SKU')
      ->setCellValue('Q4', 'Discount %')
      ->setCellValue('R4', 'Discount Per SKU')
      ->setCellValue('S4', 'Net Sale Per SKU')
      ->setCellValue('T4', 'ITEM Code')
      ->setCellValue('U4', 'Size')
      ->setCellValue('V4', 'QTY (KG)')      
      ->setCellValue('W4', 'CATEGORY')
      ->setCellValue('X4', 'OPERATION TYPE')
      ->setCellValue('Y4', 'AREA')
      ->setCellValue('Z4', 'NET SALES VAT EX')
      ->setCellValue('AA4', 'ITEM CATEGORY')
      ->setCellValue('AB4', 'DISTRIBUTOR');

if($usertype=='Distributor'){
 $sqlModal="select * from dbo.Vw_PUSHSALES where JobberID='".$JobberId."' AND usertype='".$usertype."'  AND JobberName='".$Distributor."' AND  Dim3 IN ('WITHDRAWAL')";
 }elseif ($usertype=='Admin') {
  $sqlModal="select * from dbo.Vw_PUSHSALES where Dim3 IN ('WITHDRAWAL')";
}
      //echo $sqlModal;


      //where bdm_username='".$parentCode."' and company_Cd in (". $BusinessUnit .")  and IsStatusSubmitted='Pending' and reporting_period in (select max(reporting_period) from [TIP].[Vw_BDMUserTagging] where reporting_year in (select max(reporting_year) from [TIP].[Vw_BDMUserTagging] ) )
      $stmt=sqlsrv_query($con,$sqlModal);

      $x=5;
      $alphabet = range('A', 'AC');      

      while($row=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
      
       

        $objPHPExcel->getActiveSheet()->getStyle('A'.$x) 
          ->getNumberFormat()
          ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
       $objPHPExcel->getActiveSheet()->setCellValueExplicit ('A'.$x, $row['TS'],PHPExcel_Cell_DataType::TYPE_STRING);  
        $objPHPExcel->getActiveSheet()->setCellValue ('B'.$x,$row['WRID'],PHPExcel_Cell_DataType::TYPE_STRING);  
        $objPHPExcel->getActiveSheet()->setCellValue ('C'.$x,$row['Dim3']); 
        $objPHPExcel->getActiveSheet()->setCellValue ('D'.$x,$row['GrossSale']);  
        $objPHPExcel->getActiveSheet()->setCellValue ('E'.$x,$row['Discount']);  
        $objPHPExcel->getActiveSheet()->setCellValue ('F'.$x,$row['NetAmount']); 
        $objPHPExcel->getActiveSheet()->setCellValue ('G'.$x,$row['NetAmount']);
        $objPHPExcel->getActiveSheet()->setCellValue ('H'.$x,$row['Payment_Type']);
        $objPHPExcel->getActiveSheet()->setCellValue ('I'.$x,$row['Routesalesman']);
        $objPHPExcel->getActiveSheet()->setCellValue ('J'.$x,$row['JobberName']);
        $objPHPExcel->getActiveSheet()->setCellValue ('K'.$x,$row['Dim1']);
        $objPHPExcel->getActiveSheet()->setCellValue ('L'.$x,'');
        $objPHPExcel->getActiveSheet()->setCellValue ('M'.$x,$row['QTY']);
        $objPHPExcel->getActiveSheet()->setCellValue ('N'.$x,$row['SKUDesc']);
        $objPHPExcel->getActiveSheet()->setCellValue ('O'.$x,$row['UnitPrice']);
        $objPHPExcel->getActiveSheet()->setCellValue ('P'.$x,$row['Gross_Sale_Per_SKU']);
        $objPHPExcel->getActiveSheet()->setCellValue ('Q'.$x,$row['Dim6'].'%');
        $objPHPExcel->getActiveSheet()->setCellValue ('R'.$x,$row['Discount_Per_SKU']);
        $objPHPExcel->getActiveSheet()->setCellValue ('S'.$x,'=IF(C38="REFUND",""&P'.$x.'-R'.$x.',P'.$x.'-R'.$x.')');     
        $objPHPExcel->getActiveSheet()->setCellValue ('T'.$x,$row['ItemCode']);
        $objPHPExcel->getActiveSheet()->setCellValue ('U'.$x,$row['Conversion']);
        $objPHPExcel->getActiveSheet()->setCellValue ('V'.$x,'=M'.$x.'*U'.$x.'/100');
        $objPHPExcel->getActiveSheet()->setCellValue ('W'.$x,$row['ProdCat']);
        $objPHPExcel->getActiveSheet()->setCellValue ('X'.$x,'');
        $objPHPExcel->getActiveSheet()->setCellValue ('Y'.$x,$row['Address']);
        $objPHPExcel->getActiveSheet()->setCellValue ('Z'.$x,'=S'.$x.'/1.12');
        $objPHPExcel->getActiveSheet()->setCellValue ('AA'.$x,$row['Category']);
        $objPHPExcel->getActiveSheet()->setCellValue ('AB'.$x,$row['JobberName']);

        $objPHPExcel->getActiveSheet()->getStyle('V'.$x)->getNumberFormat()->setFormatCode('0.00'); 
        $objPHPExcel->getActiveSheet()->getStyle('B'.$x)->getNumberFormat()->setFormatCode('0');

        $objPHPExcel->getActiveSheet()->getStyle('B'.$x)->getNumberFormat()->setFormatCode('0');

        $objPHPExcel->getActiveSheet()->getStyle('T'.$x)->getNumberFormat()->setFormatCode('0');
          $objPHPExcel->getActiveSheet()->getStyle('U'.$x)->getNumberFormat()->setFormatCode('0.00');
        $objPHPExcel->getActiveSheet()->getStyle('Z'.$x)->getNumberFormat()->setFormatCode('0.00');
        $objPHPExcel->getActiveSheet()->getStyle('Q'.$x)->getNumberFormat()->setFormatCode('0%');
        $x=$x+1;


        


        




        
        // CREDIT DETAILS FORM -----------------------------------------------------------------------
        //TO GET THE NUMBER OF COLUMNS
        


        //  SHOULD BE ENTRIES FORM -----------------------------------------------------------------------
        //TO GET THE NUMBER OF COLUMNS

      $intCounterLtr=28;
        for($intCount=1;$intCount<=0;$intCount++){
          $intCounterLtr=$intCounterLtr+1;

$objPHPExcel->getActiveSheet()->getStyle($alphabet[$intCounterLtr-1].($x-1))->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
$objPHPExcel->getActiveSheet()->duplicateStyle($objPHPExcel->getActiveSheet()->getStyle('A5'), 'A5:AB1000');
            // SET BACKGROUND COLOR OF CELL 
          $objPHPExcel->getActiveSheet()->getStyle($alphabet[$intCounterLtr-1].($x-1))->applyFromArray(
              array(
                  'fill' => array(
                      'type' => PHPExcel_Style_Fill::FILL_SOLID,
                      'color' => array('rgb' => 'ffff80')
                  )
              )
          );

          // SET BORDER LINE 
          $objPHPExcel->getActiveSheet()->getStyle($alphabet[$intCounterLtr-1].($x-1))->applyFromArray(
            array(
                'borders' => array(
                  'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
              )
          );

          // SET ALIGNMENT
          $objPHPExcel->getActiveSheet()->getStyle($alphabet[$intCounterLtr-1].($x-1))->applyFromArray(
            array(
                'alignment' => array(
                  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                )
              )
          );
        }

///////
      //  STATUS ANSWER  -----------------------------------------------------------------------
        //TO GET THE NUMBER OF COLUMNS
        $intCounterLtr=6;
        for($intCount=1;$intCount<=0;$intCount++){
          $intCounterLtr=$intCounterLtr+1;

          
        $objPHPExcel->getActiveSheet()->getStyle($alphabet[$intCounterLtr-1].($x-1))->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);

          // SET BACKGROUND COLOR OF CELL 
          $objPHPExcel->getActiveSheet()->getStyle($alphabet[$intCounterLtr-1].($x-1))->applyFromArray(
              array(
                  'fill' => array(
                      'type' => PHPExcel_Style_Fill::FILL_SOLID,
                      'color' => array('rgb' => '97b1db')
                  )
              )
          );

          // SET BORDER LINE 
          $objPHPExcel->getActiveSheet()->getStyle($alphabet[$intCounterLtr-1].($x-1))->applyFromArray(
            array(
                'borders' => array(
                  'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
              )
          );

          // SET ALIGNMENT
          $objPHPExcel->getActiveSheet()->getStyle($alphabet[$intCounterLtr-1].($x-1))->applyFromArray(
            array(
                'alignment' => array(
                  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                )
              )
          );


          // FOR AA COLUMN - SUM OF INPUT BUDGET
          // SET BACKGROUND COLOR OF CELL 
          $objPHPExcel->getActiveSheet()->getStyle('H'.($x-1))->applyFromArray(
              array(
                  'fill' => array(
                      'type' => PHPExcel_Style_Fill::FILL_SOLID,
                      'color' => array('rgb' => '97b1db')
                  )
              )
          );

          // SET BORDER LINE 
          $objPHPExcel->getActiveSheet()->getStyle('H'.($x-1))->applyFromArray(
            array(
                'borders' => array(
                  'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
              )
          );

          // SET ALIGNMENT
          $objPHPExcel->getActiveSheet()->getStyle('H'.($x-1))->applyFromArray(
            array(
                'alignment' => array(
                  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                )
              )
          );

          // FOR AA COLUMN - SUM OF INPUT BUDGET
          // SET BACKGROUND COLOR OF CELL 
          $objPHPExcel->getActiveSheet()->getStyle('AB'.($x-1))->applyFromArray(
              array(
                  'fill' => array(
                      'type' => PHPExcel_Style_Fill::FILL_SOLID,
                      'color' => array('rgb' => '97b1db')
                  )
              )
          );

          // SET BORDER LINE 
          $objPHPExcel->getActiveSheet()->getStyle('AB'.($x-1))->applyFromArray(
            array(
                'borders' => array(
                  'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
              )
          );

          // SET ALIGNMENT
          $objPHPExcel->getActiveSheet()->getStyle('AB'.($x-1))->applyFromArray(
            array(
                'alignment' => array(
                  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                )
              )
          );

          // FOR AB COLUMN - SUM OF INPUT BUDGET
          // SET BACKGROUND COLOR OF CELL 
          $objPHPExcel->getActiveSheet()->getStyle('AB'.($x-1))->applyFromArray(
              array(
                  'fill' => array(
                      'type' => PHPExcel_Style_Fill::FILL_SOLID,
                      'color' => array('rgb' => '97b1db')
                  )
              )
          );

          // SET BORDER LINE 
          $objPHPExcel->getActiveSheet()->getStyle('AB'.($x-1))->applyFromArray(
            array(
                'borders' => array(
                  'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
              )
          );

          // SET ALIGNMENT
          $objPHPExcel->getActiveSheet()->getStyle('AB'.($x-1))->applyFromArray(
            array(
                'alignment' => array(
                  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                )
              )
          );
        }
      }

      $objPHPExcel->setActiveSheetIndex(0);
      // HEADER

$objPHPExcel->getActiveSheet()->getStyle('A4:AB4')->getAlignment()->setWrapText(true);



foreach(range('A','AB') as $columnID) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
        ->setAutoSize(true);
}
$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setAutoSize(true);
//LOCK SPECIFIC CELL
$objPHPExcel->getActiveSheet()->getProtection()->setPassword('PPDATA');
$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);


//$objPHPExcel->getActiveSheet()->setAutoFilter('A6:H6');
// SET BACKGROUND COLOR OF CELL
$objPHPExcel->getActiveSheet()->getStyle('A4:AB4')->applyFromArray(
    array(  
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '0099ff','00ffff')
        )
    )
);
// Rename 2nd sheet
$objPHPExcel->getActiveSheet()->setTitle('WITHDRAWAL');
$objPHPExcel->getActiveSheet()->getStyle('A4:AB4')->applyFromArray(
  array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
           'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
          )
      )
    )
);

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->getStyle('A4:AB4')->getFont()->setBold(true);
// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="PUSH Sales Excel '.gmdate('YMd').'.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

exit;

