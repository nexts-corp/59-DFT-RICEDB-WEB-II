<?php
header("Content-Type: application/json");
header("content-type:text/javascript;charset=utf-8");
header("Access-Control-Allow-Origin: *");
$data = array(
        array('type1_1_a' => '1,405'),
        array('type1_1_b' => '3,688'),
        array('type1_2_a' => '3,052'),
        array('type1_2_b' => '3,100'),
        array('type2_1_a' => '1,795'),
        array('type2_1_b' => '-'),
        array('type2_2_a' => '1,847'),
        array('type2_2_b' => '1,833'),
        array('type3_1_a' => '1,405'),
        array('type3_1_b' => '1,848'),
        array('type3_2_a' => '1,240'),
        array('type3_2_b' => '1,237'),
        array('type4_1_a' => '1,235'),
        array('type4_1_b' => '-'),
        array('type4_2_a' => '1,231'),
        array('type4_2_b' => '1,229'),
        array('type5_1_a' => '2,745'),
        array('type5_1_b' => '-'),
        array('type5_2_a' => '2,822'),
        array('type5_2_b' => '2,843'),
        array('type5_3_a' => '-'),
        array('type5_3_b' => '2,156'),
        array('type5_4_a' => '2,700'),
        array('type5_4_b' => '2,673'),
        array('type6_1_a' => '12,400'),
        array('type6_1_b' => '-'),
        array('type6_2_a' => '12,500'),
        array('type6_2_b' => '12,500'),
        array('type6_3_a' => '10,724'),
        array('type6_3_b' => '-'),
        array('type6x_1_a' => '13,900'),
        array('type6x_1_b' => '-'),
        array('type6x_2_a' => '14,023'),
        array('type6x_2_b' => '13,825'),
        array('type6x_3_a' => '11,717'),
        array('type6x_3_b' => '-'),
        array('p_rice1' => '159 -265'),
        array('p_rice2' => '138 -192'),
        array('p_rice3' => '72 -168'),
        array('p_rice4' => '35-39'),
        array('w_rice1' => '5 กก.'),
        array('w_rice2' => '5 กก.'),
        array('w_rice3' => '5 กก.'),
        array('w_rice4' => '1 กก.'),
      );
//$data = iconv("tis-620","utf-8",$data);

$json = json_encode($data,JSON_UNESCAPED_UNICODE);

echo $json;
exit;
//print_r($json);
//$json_de=json_decode($json);
//print_r($json_de);
?>
