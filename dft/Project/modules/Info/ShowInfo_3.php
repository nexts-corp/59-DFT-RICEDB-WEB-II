<?php
class  ShowInfo_3 extends TForm
 {

		function ShowInfo_3()
		{
			global $ConfigPage;
				$this->Init("ShowInfo_3","Info","",true);

        $pn=new TPanel();
        $pn->set("pn","","","",true,"","");
        $this->add($pn);



        $pn_info=new TPanel();
        $pn_info->set("pn_info","","","",true,"","");
        $this->add($pn_info);


        $obj=$this->getdata('inf');

        if(empty($obj))
              $obj="preview3_3";
            
        if($obj=="preview3_3"){
          $src="<object data='./images/info/job3_2/web/job3_2.html' style='height:4000px;width:100%;overflow:hidden;'></object>";
          //$keyword="ต้นทุนในการผลิตข้าวของชาวนาต่อ 1 ไร่";
          $pn->append($src);
          $pn_info->append($keyword);

        }

        elseif($obj=="preview3_2"){
            $src="<object data='./images/info/job3_3/web/job3_3.html' style='height:1650px;width:100%;overflow:hidden;'></object>";
            //$keyword="ต้นทุนในการผลิตข้าวของชาวนาต่อ 1 ไร่";
            $pn->append($src);
            $pn_info->append($keyword);

          }

        elseif($obj=="preview3_4"){
            $src="<object data='./images/info/job3_4_G2G/web/job3_4_G2G.html' style='height:1050px;width:100%;overflow:hidden;'></object>";
            //$keyword="ต้นทุนในการผลิตข้าวของชาวนาต่อ 1 ไร่";
            $pn->append($src);
            $pn_info->append($keyword);

          }




			$this->waitevent();
		}
 }

?>
