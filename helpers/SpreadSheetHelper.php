<?php

use \PhpOffice\PhpSpreadsheet\Spreadsheet;
use \PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use \PhpOffice\PhpSpreadsheet\Style\Fill;
use \PhpOffice\PhpSpreadsheet\Style\Border;
use \PhpOffice\PhpSpreadsheet\Style\Alignment;

class SpreadSheetHelper
{

  public $spreadsheet;
  public $drawing;

  function __construct()
  {
    $this->spreadsheet = new Spreadsheet();
    $this->drawing = new Drawing();
  }

  /**
   * Funcion que ejecuta la funcion cellStyles()
   *
   * @param [type] $cells
   * @param array $styleArray
   * @return void
   */
  public function spreadStyle($cells, $styleArray = [])
  {
    global $spreadsheet;
    $spreadsheet->getActiveSheet()->getStyle($cells)->applyFromArray($styleArray);
  }

  /**
   * Funcion para la fuente de celda
   *
   * @param array $styles
   * @return void
   */
  public function cellFont($styles = [])
  {
    $styleArray = [
      'font' => [
        'bold' => TRUE,
        'color' => ['rgb' => $styles['colorFont']],
        'size'  => $styles['size'],
        'name'  => $styles['font']
      ]
    ];
    $this->spreadStyle($styles['cells'], $styleArray);
  }

  /**
   * Función para el formato de celda (Porcentaje)
   *
   * @param [type] $cells
   * @return void
   */
  public function fnCellFormat($cells, $format)
  {
    global $spreadsheet;
    $spreadsheet->getActiveSheet()
      ->getStyle($cells)
      ->getNumberFormat()
      ->setFormatCode($format);
  }

  /**
   * Funcion de estilos para el PHPSpreadSheet
   *
   * @param array $styles
   * @return void
   */
  public function fnCellStyles($styles = [])
  {
    $styleArray = [
      'font' => [
        'bold' => TRUE,
        'color' => ['rgb' => (!empty($styles['colorFont'])  ? $styles['colorFont'] : '000000')],
      ],
      'alignment' => [
        'horizontal' => (!empty($styles['alignment'])  ? $styles['alignment'] : Alignment::HORIZONTAL_CENTER),
        'vertical' => Alignment::VERTICAL_CENTER,
      ],
      'borders' => [
        'allBorders' => [
          'borderStyle' => !empty($styles['typeBorder']) ? $styles['typeBorder'] : Border::BORDER_THICK,
          'color' => ['argb' => $styles['colorBorder']],
        ],
      ],
      'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
          'argb' => $styles['colorFill'],
        ],
      ],
    ];

    $this->spreadStyle($styles['cells'], $styleArray);
  }

  /**
   * Funcion para ejecutar la propiedades del archivo Excel
   *
   * @param array $params
   * @return void
   */
  public function fnPropertiesExcel($params = [])
  {
    global $spreadsheet;

    $spreadsheet->getDefaultStyle()->getFont()->setName($params['font']);
    $spreadsheet->getDefaultStyle()->getFont()->setSize($params['size']);

    $spreadsheet
      ->getProperties()
      ->setCreator("ITSANET PERU")
      ->setLastModifiedBy('Aplication ' . $params['app'])
      ->setTitle($params['title'])
      ->setSubject($params['subject'])
      ->setDescription($params['description'])
      ->setKeywords("office 2007 openxml php")
      ->setCategory($params['title']);

    // DISABLE GRIDS 
    $spreadsheet->getActiveSheet()->setShowGridlines(false);

    // TITLE SHEET
    $spreadsheet->getActiveSheet()->setTitle($params['title_sheet']);
  }

  /**
   * Funcion para agregar imagen al hoja del Excel
   *
   * @param array $params
   * @return void
   */
  public function fnDrawingWorkSheet($params = [])
  {
    global $spreadsheet;
    global $drawing;
    $drawing->setWorksheet($spreadsheet->getActiveSheet());
    $drawing->setName($params['name']);
    $drawing->setDescription($params['name']);
    $drawing->setPath($params['path']);
    $drawing->setCoordinates($params['coordinates']);
    $drawing->setHeight($params['height']);
    $drawing->setWidth($params['width']);
    $drawing->getShadow()->setVisible(true);
    $drawing->getShadow()->setDirection(45);
  }

  public function fnColumnDimensionIterator($params = [])
  {
    global $spreadsheet;
    foreach ($params as $c) {
      $spreadsheet->getActiveSheet()->getColumnDimension($c)->setAutoSize(true);
    }
  }
}
