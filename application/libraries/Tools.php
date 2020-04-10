<?php
class Tools
{
    function exportdata($table,$title,$desc,$namafile,$folderpath='')
    {
        $CI=& get_instance();
        $CI->load->library('phpexcel');
        $CI->load->database();
        $CI->load->library('PHPExcel/iofactory');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle($title)
                         ->setDescription($desc);
        $objPHPExcel->setActiveSheetIndex(0);
        
        $space=0;
        $space+=1;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,$space,$title);
        $space+=1;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,$space,$desc);
        $fields = $CI->db->list_fields($table);
        $countfield=count($fields)-1;
        $space+=2;
        $col=-1;
        for($colC=0;$colC<=$countfield;$colC++)
        {
            $col+=1;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$space,$fields[$colC]);
        }
        
        
        $result=$CI->db->get($table);
        $dataarray=array();
        $space+=1;
        foreach($result->result() as $row)
        {
            $dcol=-1;
            $dataarray=$row;
            foreach($dataarray as $row2)
            {
                $dcol+=1;                
            $objPHPExcel->getActiveSheet()->setCellValueExplicitByColumnAndRow($dcol,$space,$row2,PHPExcel_Cell_DataType::TYPE_STRING);
            }
            $space+=1;
        }
        
        $col+=1;
        $space+=1;
                
        $filename=$namafile.'.xls';
        if($folderpath!="")
        {
            
            $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save($folderpath.'/'.$filename);
        }else{
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$filename.'"');
            header('Cache-Control: max-age=0');
                    
            $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
        }
        
    }
    
    function importdata($file,$table,$startRow,$checkPrimary=FALSE)
    {
        $CI=& get_instance();
        $CI->load->database();
        $CI->load->library('phpexcel');
        $CI->load->library('PHPExcel/iofactory');
        $objPHPExcel = new PHPExcel();
        try{
            $inputFileType = IOFactory::identify($file);
            $objReader = IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($file);
        } catch (Exception $ex) {
            die("Tidak dapat mengakses file ".$ex->getMessage());
        }
        
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        
        for ($row = $startRow; $row <= $highestRow; $row++){
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,NULL,TRUE,FALSE);
            $startCol=0;
            if($checkPrimary==TRUE)
            {
                $startCol=0;
            }else{
                $startCol=1;
            }
                    
		    $fields = $CI->db->list_fields('client');
            $countfield=count($fields)-1;
            
            $datacol=array();
            $dataxl=array();
            $colXl=-1;
            for($col=$startCol;$col<=$countfield;$col++)
            {
                $colXl+=1;                
                $datacol[]=$fields[$col];
                $dataxl[]=$rowData[0][$colXl];
            }
            $data=array_combine($datacol,$dataxl);
            $CI->db->insert($table,$data);
            
            
        }
    }        
}
?>