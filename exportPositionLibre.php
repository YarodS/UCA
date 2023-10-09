<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once('Cls_datos/MySession.php');
$MySession = new MySession();
if ($MySession->get('id_user')) {
require_once('PHPExcel/Classes/PHPExcel.php');
require_once('PHPMailerMaster/PHPMailerAutoload.php');
require_once('Cls_Datos/MyCustomers.php');
require_once('Cls_Datos/MyNclass.php');
require_once('Cls_Datos/MyAnalytics.php');
$MyCustomers = new MyCustomers();
$MyAnalytics = new MyAnalytics();
$MyNclass = new MyNclass();
$objPHPExcel = new PHPExcel();
$mail = new PHPMailer();

$_REQUEST['type'] = !empty($_REQUEST['type']) ? $_REQUEST['type'] : NULL;
$_REQUEST['nave'] = !empty($_REQUEST['nave']) ? $_REQUEST['nave'] : NULL;
$_REQUEST['lay_out'] = !empty($_REQUEST['lay_out']) ? $_REQUEST['lay_out'] : NULL;
//Datos

$lll1 = $MyAnalytics->uca_get_position_libres_nave_tp(array('p_type_post'=>$_REQUEST['type'],'p_nave'=>$_REQUEST['nave'],'p_lay_out'=>$_REQUEST['lay_out']));

$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
$objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
// Set document properties
$objPHPExcel->getProperties()->setCreator("ITSANET PERU")
               ->setLastModifiedBy("Aplication UCA")
               ->setTitle("Posiciones por Tipo/Nave")
               ->setSubject("Tipo Posiciones")
               ->setDescription("Reporte de Posiciones exportado desde la aplication UCA")
               ->setKeywords("office 2007 openxml php")
               ->setCategory("Aplication UCA");
// deshabilitar grilla
$objPHPExcel->getActiveSheet()->setShowGridlines(false);
// Add a drawing to the worksheet
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('Logo');
$objDrawing->setDescription('Logo');
$objDrawing->setPath('./rc/img/logo-itsanet.png');
$objDrawing->setCoordinates('D1');
$objDrawing->setHeight(67);
$objDrawing->setWidth(110);
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

// estilo color cell 
function cellColor($cells,$color){
    global $objPHPExcel;
    $objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => $color)
    ));
}
// estilo border
function cellBorder($cells,$color){
      global $objPHPExcel;
      $objPHPExcel->getActiveSheet()->getStyle($cells)->applyFromArray(array(
            'borders' => array(
                  'allborders' => array(                  
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('rgb' => $color)
                  )
            )
      ));
}
// estillo font
function cellFont($cells,$color,$bold,$size,$font){
      global $objPHPExcel;
      $objPHPExcel->getActiveSheet()->getStyle($cells)->applyFromArray(array(
            'font'  => array(
                  'bold'  => $bold,
                  'color' => array('rgb' => $color),
                  'size'  => $size,
                  'name'  => $font
            )
      ));
}
// format  data cell
function cellFormat($cells){
      global $objPHPExcel;
      $objPHPExcel->getActiveSheet()
                  ->getStyle($cells)
                  ->getNumberFormat()
                  ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE); 
}
function alieng_text($cells){
      global $objPHPExcel;
      $objPHPExcel->getActiveSheet()
            ->getStyle($cells)
            ->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
}
//Datos del cliemte
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A2', 'Posiciones Libres')
            ->setCellValue('A3', $_REQUEST['lay_out'].' '.$_REQUEST['type'].' '.$_REQUEST['nave']);          
                                    cellFont('A2:A3','','TRUE','11','');

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A5', 'TIPO POSICION')
            ->setCellValue('B5', 'NAVE')
            ->setCellValue('C5', 'CALLE')
            ->setCellValue('D5', 'COLUMNA')
            ->setCellValue('E5', 'NIVEL')
            ->setCellValue('F5', 'LARGO')
            ->setCellValue('G5', 'ANCHO')
            ->setCellValue('H5', 'MT2');
$c = 6;
foreach ($lll1 as $i => $v) {
      $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A'.$c, $v['TIPO_POSICION'])
        ->setCellValue('B'.$c, $v['NAVE_COD'])
        ->setCellValue('C'.$c, $v['CALLE'])
        ->setCellValue('D'.$c, $v['COLUMNA'])
        ->setCellValue('E'.$c, $v['NIVEL'])
        ->setCellValue('F'.$c, $v['LARGO'])
        ->setCellValue('G'.$c, $v['ANCHO'])
        ->setCellValue('H'.$c, $v['MT2']);
      $c++;
}
//$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(TRUE);

cellFont('A5:H5','','TRUE','','');
cellColor('A5:H5','d1d1d1');
cellBorder('A5:H'.$c,'939090'); // type position
alieng_text('A5:H'.$c);

$filename = 'Posiciones_vacias_'.$_REQUEST['lay_out'].'_'.$_REQUEST['type'].'-'.$_REQUEST['nave'].date('YmdHms');
$objPHPExcel->getActiveSheet()->setTitle('vacias'.$_REQUEST['lay_out'].'_'.$_REQUEST['type'].' '.$_REQUEST['nave']);
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
}else{
  header('Location: login.php');
}