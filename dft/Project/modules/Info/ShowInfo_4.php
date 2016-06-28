<?php
class  ShowInfo_4 extends TForm
 {

		function ShowInfo_4()
		{
			global $ConfigPage;
				$this->Init("ShowInfo_4","Info","",true);

        $pn=new TPanel();
        $pn->set("pn","","","",true,"","");
        $this->add($pn);



        $pn_info=new TPanel();
        $pn_info->set("pn_info","","","",true,"","");
        $this->add($pn_info);


        $obj=$this->getdata('inf');
        
        if(empty($obj))
              $obj="preview4_1";

        if($obj=="preview4_1"){
          $src="<object data='./images/info/job4_1/web/job4_1.html' style='height:2250px;width:100%;overflow:hidden;'></object>";
          //$keyword="ต้นทุนในการผลิตข้าวของชาวนาต่อ 1 ไร่";
          $pn->append($src);
          $pn_info->append($keyword);

        }
        elseif($obj=="preview4_2_1"){
          $src="<object data='./images/info/job4_2/nation1/web/nation1.html' style='height:800px;width:100%;overflow:hidden;'></object>";
          //$keyword="ต้นทุนในการผลิตข้าวของชาวนาต่อ 1 ไร่";
          $pn->append($src);
          $pn_info->append($keyword);

        }
        elseif($obj=="preview4_2_2"){
          $src="<object data='./images/info/job4_2/nation2/web/nation2.html' style='height:800px;width:100%;overflow:hidden;'></object>";
          //$keyword="ต้นทุนในการผลิตข้าวของชาวนาต่อ 1 ไร่";
          $pn->append($src);
          $pn_info->append($keyword);

        }
        elseif($obj=="preview4_2_3"){
          $src="<object data='./images/info/job4_2/nation3/web/nation3.html' style='height:800px;width:100%;overflow:hidden;'></object>";
          //$keyword="ต้นทุนในการผลิตข้าวของชาวนาต่อ 1 ไร่";
          $pn->append($src);
          $pn_info->append($keyword);

        }
        elseif($obj=="preview4_2_4"){
          $src="<object data='./images/info/job4_2/nation4/web/nation4.html' style='height:800px;width:100%;overflow:hidden;'></object>";
          //$keyword="ต้นทุนในการผลิตข้าวของชาวนาต่อ 1 ไร่";
          $pn->append($src);
          $pn_info->append($keyword);

        }
        elseif($obj=="preview4_2_5"){
          $src="<object data='./images/info/job4_2/nation5/web/nation5.html' style='height:800px;width:100%;overflow:hidden;'></object>";
          //$keyword="ต้นทุนในการผลิตข้าวของชาวนาต่อ 1 ไร่";
          $pn->append($src);
          $pn_info->append($keyword);

        }




			$this->waitevent();
		}
 }

?>
