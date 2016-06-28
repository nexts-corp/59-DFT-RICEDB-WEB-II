<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
$data = array(
        array('p_rice1' => '159 -265'),
        array('p_rice2' => '138 -192'),
        array('p_rice3' => '72 -168'),
        array('p_rice4' => '35-39'),
        array('w_rice1' => '5 กก.'),
        array('w_rice2' => '5 กก.'),
        array('w_rice3' => '5 กก.'),
        array('w_rice4' => '1 กก.'),
      );

$json = json_encode($data);

echo $json;
exit;
//print_r($json);
//$json_de=json_decode($json);
//print_r($json_de);
?>
