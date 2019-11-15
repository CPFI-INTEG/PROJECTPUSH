<?php
  if(session_status() != PHP_SESSION_ACTIVE) {
  	session_start();
  }

$Distributor=$_SESSION['Distributor']; // THIS IS THE FIELD OF BDM NAME
    $Username=$_SESSION['Username'];
    $Name=$_SESSION['Name'];


   

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
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
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
include dirname(__FILE__) . '/Classes/PHPExcel.php';

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
			
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
			// HEADER
			->setCellValue('A1', 'Report Type     : PUSH PRODUCT')
			->setCellValue('A2', 'Reporting Month   : '.(gmdate('m')-1))
			->setCellValue('A3', 'Date & Time    : '.date('l jS \of F Y h:i:s A'))

			// CREDIT DATA
			->setCellValue('A6', 'Item Code')
			->setCellValue('B6', 'Product Description')
			->setCellValue('C6', 'Product Brand')

			->setCellValue('D6', 'Product Category')

			->setCellValue('E6', 'UBA Category')
			->setCellValue('F6', 'UOM Code')
			->setCellValue('G6', 'Conversion')
			->setCellValue('H6', 'Unit Price')
			->setCellValue('I6', 'Status')

		
			;
				 	
			//$sqlModal='select ItemCode,ProdDesc,ProdCat,UOMCode,ID,Conversion,UnitPrice,ShortItemCode,Stat from dbo.dsrSKU';
		 	//echo $sqlModal;


		 	//where bdm_username='".$parentCode."' and company_Cd in (". $BusinessUnit .")  and IsStatusSubmitted='Pending' and reporting_period in (select max(reporting_period) from [TIP].[Vw_BDMUserTagging] where reporting_year in (select max(reporting_year) from [TIP].[Vw_BDMUserTagging] ) )
			//$stmt=sqlsrv_query($con,$sqlModal);

			$x=7;
			$alphabet = range('A', 'I');			

			//while($row=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
				$objPHPExcel->getActiveSheet()->getStyle('A'.$x) 
    			->getNumberFormat()
    			->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
				$objPHPExcel->getActiveSheet()->setCellValueExplicit ('A'.$x);	
				$objPHPExcel->getActiveSheet()->setCellValue ('B'.$x);	
				$objPHPExcel->getActiveSheet()->setCellValue ('C'.$x);	
				$objPHPExcel->getActiveSheet()->setCellValue ('D'.$x);	
				$objPHPExcel->getActiveSheet()->setCellValue ('E'.$x);	
				$objPHPExcel->getActiveSheet()->setCellValue ('F'.$x);	
				$objPHPExcel->getActiveSheet()->setCellValue ('G'.$x);
				$objPHPExcel->getActiveSheet()->setCellValue ('H'.$x);	
				$objPHPExcel->getActiveSheet()->setCellValue ('I'.$x,'=IF(A'.$x.'="","INACTIVE","ACTIVE")');	
			
		
			//	$objPHPExcel->getActiveSheet()->setCellValue ('G'.$x,'=IFERROR(IF((SEARCH("CORP",K'.$x.'))<>0,"TRUE","FALSE"),"FALSE")');
				

				$x=$x+1;
				
				// CREDIT DETAILS FORM -----------------------------------------------------------------------
				//TO GET THE NUMBER OF COLUMNS
				


				//  SHOULD BE ENTRIES FORM -----------------------------------------------------------------------
				//TO GET THE NUMBER OF COLUMNS

				$intCounterLtr=0;
				for($intCount=1;$intCount<=7;$intCount++){
					$intCounterLtr=$intCounterLtr+1;

					$objPHPExcel->getActiveSheet()->getStyle($alphabet[$intCounterLtr-1].($x-1))->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
$objPHPExcel->getActiveSheet()->duplicateStyle($objPHPExcel->getActiveSheet()->getStyle('A7'), 'A7:I200');

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
$objPHPExcel->getActiveSheet()->duplicateStyle($objPHPExcel->getActiveSheet()->getStyle('A7'), 'A7:H200');
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
					$objPHPExcel->getActiveSheet()->getStyle('I'.($x-1))->applyFromArray(
					    array(
					        'fill' => array(
					            'type' => PHPExcel_Style_Fill::FILL_SOLID,
					            'color' => array('rgb' => '97b1db')
					        )
					    )
					);

					// SET BORDER LINE 
					$objPHPExcel->getActiveSheet()->getStyle('I'.($x-1))->applyFromArray(
						array(
					  		'borders' => array(
						    	'allborders' => array(
						      	'style' => PHPExcel_Style_Border::BORDER_THIN
						      	)
					    	)
					  	)
					);

					// SET ALIGNMENT
					$objPHPExcel->getActiveSheet()->getStyle('I'.($x-1))->applyFromArray(
						array(
					  		'alignment' => array(
						    	'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
					    	)
					  	)
					);
				}
			//}

			$objPHPExcel->setActiveSheetIndex(0);
			// HEADER


foreach(range('A','I') as $columnID) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
        ->setAutoSize(true);
}
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('PUSH PRODUCT DATA');





//LOCK SPECIFIC CELL
$objPHPExcel->getActiveSheet()->getProtection()->setPassword('PPDATA');
$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);

// SET BACKGROUND COLOR OF CELL
$objPHPExcel->getActiveSheet()->getStyle('A6:I6')->applyFromArray(
    array(	
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '999966')
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
*/
// SET BORDER LINE 
$objPHPExcel->getActiveSheet()->getStyle('A6:I6')->applyFromArray(
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
*/
//---------------------------



// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->getStyle('A1:E4')->getFont()->setBold(true);

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->getStyle('A6:I6')->getFont()->setBold(true);

// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="PUSH PRODUCT Excel '.date('YMd').'.xlsx"');
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
