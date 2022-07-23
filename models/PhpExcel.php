$objPHPExcel = new PHPExcel();


$filename = "report_".date('Ymd_His').".xls";

$sheet_title = array('person_mast','person_ex');

$sheet_count = 0;
foreach($patient_result as $tb_name => $tb_data){


$sheet = $objPHPExcel->createSheet($sheet_count);

$header_key = array_keys($tb_data[0]);

$header = array($header_key[0], $header_key[1], $header_key[2]);
$list = array ($header);
//$this->excel->setActiveSheetIndex($sheet_count);
$sheet->setTitle($sheet_title[$sheet_count]);

$tmp_row = array();
foreach($tb_data as $key => $curr_data){
//echo '
<pre>'; print_r( $curr_data); exit;
                $list[] = $curr_data;
            }

            $sheet->fromArray($list);
        $sheet_count++; //break;

    }