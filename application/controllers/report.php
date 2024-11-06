<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('item_model');

        // Manually include the PHPExcel Autoloader
        require_once(APPPATH . 'libraries/PHPExcel/Autoloader.php');
        // Initialize the Autoloader
        PHPExcel_Autoloader::register();
    }

    public function index()
    {
        // Get data for the report
        $query = $this->item_model->eksport_data();
        if (!$query) {
            return false;
        }

        // Create a new PHPExcel object
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("Laporan Produk PT. Ujung Berung")
            ->setDescription("Berisi data model produk (Kode model, Nama Model, dan Deskrpsi model)");

        // Set active sheet index to the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        // Title Row
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Laporan Produk PT. Ujung Berung');
        $objPHPExcel->getActiveSheet()->mergeCells('A1:C1');
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16)->setBold(true);
        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        // Date
        $today = date("d-m-Y");
        $objPHPExcel->getActiveSheet()->setCellValue('C3', 'Tanggal: ' . $today);
        $objPHPExcel->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objPHPExcel->getActiveSheet()->getStyle('C3')->getFont()->setBold(true);

        // Table Headers
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getRowDimension('5')->setRowHeight(15);
        $objPHPExcel->getActiveSheet()->setCellValue('A5', 'Kode Model');
        $objPHPExcel->getActiveSheet()->setCellValue('B5', 'Nama Model');
        $objPHPExcel->getActiveSheet()->setCellValue('C5', 'Deskripsi');
        $objPHPExcel->getActiveSheet()->getStyle('A5:C5')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A5:C5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        // Border Style for headers
        $styleArray = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'E1E0F7'),
            ),
            'borders' => array(
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                ),
            ),
        );
        $objPHPExcel->getActiveSheet()->getStyle('A5:C5')->applyFromArray($styleArray);

        // Table Data
        $fields = $query->list_fields();
        $row = 6;
        foreach ($query->result() as $data) {
            $col = 0;
            foreach ($fields as $field) {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                $objPHPExcel->getActiveSheet()->getStyle("A" . $row . ":C" . $row)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $col++;
            }
            $row++;
        }

        // Create the Excel file and output it to the browser
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        // Define the filename for download
        $filename = 'Laporan_Produk_' . $today . '.xlsx';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Clean output buffer and send the file
        ob_get_clean();
        $objWriter->save('php://output');
    }
}
