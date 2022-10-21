<?php
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Replace;
require_once __DIR__ . '/../vendor/autoload.php';

class ExportService
{

    public function exportExcel($postResult, $columnResult)
    {
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()->setTitle("excelsheet");
        $spreadsheet->setActiveSheetIndex(0);
        $spreadsheet->getActiveSheet()->SetCellValue('A1', ucwords($columnResult[0]["COLUMN_NAME"]));
        $spreadsheet->getActiveSheet()->SetCellValue('B1', ucwords($columnResult[1]["COLUMN_NAME"]));
        $spreadsheet->getActiveSheet()->SetCellValue('C1', ucwords($columnResult[2]["COLUMN_NAME"]));
        $spreadsheet->getActiveSheet()->SetCellValue('D1', ucwords($columnResult[3]["COLUMN_NAME"]));
        $spreadsheet->getActiveSheet()->SetCellValue('E1', str_replace('_', ' ', ucwords($columnResult[4]["COLUMN_NAME"], '_')));
        $spreadsheet->getActiveSheet()->SetCellValue('F1', str_replace('_', ' ', ucwords($columnResult[5]["COLUMN_NAME"], '_')));
        $spreadsheet->getActiveSheet()
            ->getStyle("A1:F1")
            ->getFont()
            ->setBold(true);
        $rowCount = 2;
        if (! empty($postResult)) {
            foreach ($postResult as $k => $v) {
                $spreadsheet->getActiveSheet()->setCellValue("A" . $rowCount, $postResult[$k]["id"]);
                $spreadsheet->getActiveSheet()->setCellValue("B" . $rowCount, $postResult[$k]["name"]);
                $spreadsheet->getActiveSheet()->setCellValue("C" . $rowCount, $postResult[$k]["price"]);
                $spreadsheet->getActiveSheet()->setCellValue("D" . $rowCount, $postResult[$k]["category"]);
                $spreadsheet->getActiveSheet()->setCellValue("E" . $rowCount, $postResult[$k]["product_image"]);
                $spreadsheet->getActiveSheet()->setCellValue("F" . $rowCount, $postResult[$k]["average_rating"]);
                $rowCount ++;
            }
            $spreadsheet->getActiveSheet()
                ->getStyle('A:F')
                ->getAlignment()
                ->setWrapText(true);

            $spreadsheet->getActiveSheet()
                ->getRowDimension($rowCount)
                ->setRowHeight(- 1);
        }
        $writer = IOFactory::createWriter($spreadsheet, 'Xls');
        header('Content-Type: text/xls');
        $fileName = 'exported_excel_' . time() . '.xls';
        $headerContent = 'Content-Disposition: attachment;filename="' . $fileName . '"';
        header($headerContent);
        $writer->save('php://output');
    }
}
?>