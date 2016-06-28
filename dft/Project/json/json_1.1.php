<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
$data = array(
        array('product1' => '478.5'),
        array('product2' => '478.1'),
        array('product3' => '469.3'),
        array('consume1' => '481.6'),
        array('consume2' => '482.0'),
        array('consume3' => '484.6'),
        array('sale1' => '43.4'),
        array('sale2' => '42.4'),
        array('sale3' => '41.3'),
        array('stock1' => '107.5'),
        array('stock2' => '103.7'),
        array('stock3' => '88.4'),
        array('cha_product1' => '142.5'),
        array('cha_product2' => '144.5'),
        array('cha_product3' => '145.5'),
        array('cha_consume1' => '146.3'),
        array('cha_consume2' => '147.6'),
        array('cha_consume3' => '150'),
        array('cha_sale1' => '4.1'),
        array('cha_sale2' => '4.5'),
        array('cha_sale3' => '4.7'),
        array('cha_stock1' => '0'),
        array('cha_stock2' => '0'),
        array('cha_stock3' => '0'),
        array('ind_product1' => '106.6'),
        array('ind_product2' => '104.8'),
        array('ind_product3' => '100'),
        array('ind_consume1' => '99.1'),
        array('ind_consume2' => '98'),
        array('ind_consume3' => '98'),
        array('ind_sale1' => '0'),
        array('ind_sale2' => '0'),
        array('ind_sale3' => '0'),
        array('ind_stock1' => '10.9'),
        array('ind_stock2' => '11.5'),
        array('ind_stock3' => '8.5'),
        array('indo_product1' => '36.3'),
        array('indo_product2' => '35.7'),
        array('indo_product3' => '36.3'),
        array('indo_consume1' => '38.5'),
        array('indo_consume2' => '38.5'),
        array('indo_consume3' => '38.6'),
        array('indo_sale1' => '1.8'),
        array('indo_sale2' => '1.8'),
        array('indo_sale3' => '1.8'),
        array('indo_stock1' => '0'),
        array('indo_stock2' => '0'),
        array('indo_stock3' => '0'),
        array('ban_product1' => '34.3'),
        array('ban_product2' => '34.5'),
        array('ban_product3' => '34.6'),
        array('ban_consume1' => '34.9'),
        array('ban_consume2' => '35.2'),
        array('ban_consume3' => '35.5'),
        array('ban_sale1' => '0'),
        array('ban_sale2' => '0'),
        array('ban_sale3' => '0'),
        array('ban_stock1' => '0'),
        array('ban_stock2' => '0'),
        array('ban_stock3' => '0'),
        array('vie_product1' => '28.1'),
        array('vie_product2' => '28.0'),
        array('vie_product3' => '28.2'),
        array('vie_consume1' => '22'),
        array('vie_consume2' => '22'),
        array('vie_consume3' => '22'),
        array('vie_sale1' => '0'),
        array('vie_sale2' => '0'),
        array('vie_sale3' => '0'),
        array('vie_stock1' => '6.3'),
        array('vie_stock2' => '6.3'),
        array('vie_stock3' => '7.1'),
        array('tha_product1' => '20.4'),
        array('tha_product2' => '18.7'),
        array('tha_product3' => '16.4'),
        array('tha_consume1' => '10.8'),
        array('tha_consume2' => '11.7'),
        array('tha_consume3' => '11.8'),
        array('tha_sale1' => '0'),
        array('tha_sale2' => '0'),
        array('tha_sale3' => '0'),
        array('tha_stock1' => '10.9'),
        array('tha_stock2' => '9'),
        array('tha_stock3' => '10'),
        array('mia_product1' => '1.6'),
        array('mia_product2' => '2'),
        array('mia_product3' => '1.8'),
        array('mia_consume1' => '10.4'),
        array('mia_consume2' => '10.5'),
        array('mia_consume3' => '10.5'),
        array('mia_sale1' => '1.4'),
        array('mia_sale2' => '1.4'),
        array('mia_sale3' => '1.5'),
        array('mia_stock1' => '1.6'),
        array('mia_stock2' => '2'),
        array('mia_stock3' => '1.8'),
        array('phi_product1' => '11.8'),
        array('phi_product2' => '11.9'),
        array('phi_product3' => '11.2'),
        array('phi_consume1' => '12.8'),
        array('phi_consume2' => '13.2'),
        array('phi_consume3' => '13.2'),
        array('phi_sale1' => '1.8'),
        array('phi_sale2' => '1.8'),
        array('phi_sale3' => '1.8'),
        array('phi_stock1' => '0'),
        array('phi_stock2' => '0'),
        array('phi_stock3' => '0'),
        array('oth_product1' => '81.1'),
        array('oth_product2' => '87.2'),
        array('oth_product3' => '84.8'),
        array('oth_consume1' => '106.5'),
        array('oth_consume2' => '105.2'),
        array('oth_consume3' => '104.9'),
        array('oth_sale1' => '29.1'),
        array('oth_sale2' => '27.4'),
        array('oth_sale3' => '26.7'),
        array('oth_stock1' => '5.8'),
        array('oth_stock2' => '5'),
        array('oth_stock3' => '5.3'),
        array('rice_w1' => '3.8'),
        array('rice_n1' => '1.9'),
        array('rice_h1' => '1.5'),
        array('rice_ne1' => '0.1'),
        array('rice_p1' => '0.0'),
        array('rice_k1' => '0.0'),
        array('rice_w2' => '51.0%'),
        array('rice_n2' => '25.9%'),
        array('rice_h2' => '20.5%'),
        array('rice_ne2' => '1.3%'),
        array('rice_p2' => '0.41%'),
        array('rice_k2' => '0.72%'),
        array('nor_plant' => '14,673,698'),
        array('nor_keep' => '14,352,849'),
        array('nor_product' => '8,637,165'),
        array('esa_plant' => '37,066,629'),
        array('esa_keep' => '33,750,137'),
        array('esa_product' => '12,295,137'),
        array('cen_plant' => '9,395,366'),
        array('cen_keep' => '9,135,424'),
        array('cen_product' => '5,740,365'),
        array('sou_plant' => '944,211'),
        array('sou_keep' => '897,399'),
        array('sou_product' => '417,517'),
        array('plant_1' => '60,790,599'),
        array('keep_1' => '432'),
        array('product_1' => '26,269,964'),
        array('plant_2' => '56,688,379'),
        array('keep_2' => '414'),
        array('product_2' => '23,477,574'),
        array('plant_3' => '58,695,910'),
        array('keep_3' => '429'),
        array('product_3' => '25,203,812'),
        array('plant_1x' => '8,460,759'),
        array('keep_1x' => '632'),
        array('product_1x' => '5,346,915'),
        array('plant_2x' => '6,324,447'),
        array('keep_2x' => '623'),
        array('product_2x' => '3,940,883'),
        array('plant_3x' => '0'),
        array('keep_3x' => '0'),
        array('product_3x' => '0'),
        array('maxx' => '9'),
        array('price' => '4787'),
        array('best_quality' => '5'),
        array('low_quality' => '4'),
        array('sum1' => '22.979'),
        array('rice2_h' => '6'),
        array('rice2_n' => '6.7'),
        array('rice2_j' => '10.2'),
        array('sum2' => '4.03'),
        array('rice2_h_price' => '12,626-14,973'),
        array('rice2_n_price' => '9,170-11,335'),
        array('rice2_j_price' => '7,900-8,000'),
        array('aa' => 'ทดสอบ'),
        array('step1' => '2,380'),
        array('step2' => '1,990'),
        array('step3' => '650'),
        array('stepSum' => '5,020'),
        array('stepExtra' => '500'),

      );

$json = json_encode($data);

echo $json;
exit;
//print_r($json);
//$json_de=json_decode($json);
//print_r($json_de);
?>