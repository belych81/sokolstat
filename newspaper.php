<?php

require_once $_SERVER["DOCUMENT_ROOT"]."/dompdf-tagged-pdf/dompdf_config.inc.php";
$url = 'https://sokolstat.ru/newspaper/';

echo 1;
$html = file_get_contents($url);
var_dump($html);
$dompdf = new \Dompdf\Dompdf();
$dompdf->load_html($html, 'UTF-8');
echo 3;
// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');
echo 5;
// Render the HTML as PDF
$dompdf->render();
echo 4;
$output = $dompdf->output();
file_put_contents($_SERVER['DOCUMENT_ROOT']."/file.pdf", $output);
echo 2;
 ?>