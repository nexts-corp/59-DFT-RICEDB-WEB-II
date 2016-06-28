<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
$data = array(
        array('fob_inter_r1' => '365'),
        array('fob_inter_r2' => '355'),
        array('fob_inter_r3' => '350'),
        array('fob_inter_r4' => '343'),
        array('fob_inter_r5' => '356'),
        array('fob_tha_r1' => '371'),
        array('fob_tha_r2' => '360'),
        array('fob_tha_r3' => '357'),
        array('fob_tha_r4' => '354'),
        array('fob_tha_r5' => '363'),
        array('fob_tha_s1' => '365'),
        array('fob_tha_s2' => '356'),
        array('fob_tha_s3' => '352'),
        array('fob_tha_s4' => '350'),
        array('fob_tha_s5' => '362'),
      );

$json = json_encode($data);

echo $json;
exit;
//print_r($json);
//$json_de=json_decode($json);
//print_r($json_de);
?>
