<?php


class  ShowInfo extends TForm
 {

		function ShowInfo()
		{
			global $ConfigPage;
				$this->Init("ShowInfo","Info","",true);

        $pn=new TPanel();
        $pn->set("pn","","","",true,"","");
        $this->add($pn);

        $keyword=$this->getdata('keyword');

        $pn_info=new TPanel();
        $pn_info->set("pn_info","","","",true,"","");
        $this->add($pn_info);


        $pn_info->append('

            '.$keyword.'

            ');



            $obj=$this->getdata('inf');

            if($obj=="preview1_0"){
            	$src='<img src="images/finalR/png1_0.png" alt="" class="animated" data-time="1000" data-fx="fadeInUp">';
            }elseif($obj=="preview1_1_1"){
            	$src='<img src="images/finalR/png1_1_1.png" alt="" class="animated" data-time="1000" data-fx="fadeInUp">';

            }elseif($obj=="preview1_1_2"){
            	//$src='<img src="images/finalR/png1_1_2.png" alt="" class="animated" data-time="1000" data-fx="fadeInUp">';
              $src="<center><object data='./images/oam/map_index.html' style='height:1200px; width:80%'></object></center>";

            }elseif($obj=="preview1_1_3"){
            	$src='<img src="images/finalR/png1_1_3.png" alt="" class="animated" data-time="1000" data-fx="fadeInUp">';

            }elseif($obj=="preview1_1_4"){
                  $src='<img src="images/finalR/png1_1_4.png" alt="" class="animated" data-time="1000" data-fx="fadeInUp">';

            }
            elseif($obj=="preview1_1_5"){
            	$src='<img src="images/finalR/png1_1_5.png" alt="" class="animated" data-time="1000" data-fx="fadeInUp">';

            }elseif($obj=="preview2_3"){
            	$src='<img src="images/finalR/png2_3.png" alt="" class="animated" data-time="1000" data-fx="fadeInUp">';

            }elseif($obj=="preview3_1_1"){
            	$src='<img src="images/finalR/png3_1_1.png" alt="" class="animated" data-time="1000" data-fx="fadeInUp">';

            }elseif($obj=="preview3_1_2"){
            	$src='<img src="images/finalR/png3_1_2.png" alt="" class="animated" data-time="1000" data-fx="fadeInUp">';

            }elseif($obj=="preview3_2_1"){
            	$src='<img src="images/finalR/png3_2_1.png" alt="" class="animated" data-time="1000" data-fx="fadeInUp">';

            }elseif($obj=="preview3_2_2"){
            	$src='<img src="images/finalR/png3_2_2.png" alt="" class="animated" data-time="1000" data-fx="fadeInUp">';

            }elseif($obj=="preview3_3"){
            	$src='<img src="images/finalR/png3_3.png" alt="" class="animated" data-time="1000" data-fx="fadeInUp">';

            }elseif($obj=="preview4_1"){
            	$src='<img src="images/finalR/png4_1.png" alt="" class="animated" data-time="1000" data-fx="fadeInUp">';

            }elseif($obj=="preview1_2"){

            $src='<img src="images/finalR/png1_2.png" alt="" class="animated" data-time="1000" data-fx="fadeInUp">';

            }



            $pn->append('

         <div class="col-md-12 text-center">
            '.$src.'
        </div>

                  ');

			$this->waitevent();
		}
 }

?>
