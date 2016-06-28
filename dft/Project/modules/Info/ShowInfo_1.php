<?php


class  ShowInfo_1 extends TForm
 {

		function ShowInfo_1()
		{
			global $ConfigPage;
				$this->Init("ShowInfo_1","Info","",true);

        $pn=new TPanel();
        $pn->set("pn","","","",true,"","");
        $this->add($pn);



        $pn_info=new TPanel();
        $pn_info->set("pn_info","","","",true,"","");
        $this->add($pn_info);


            $obj=$this->getdata('inf');

            if(empty($obj))
              $obj="preview1_1";
            
            if($obj=="preview1_1"){
              $src="<object data='./images/info/job1_1/web/job1_1.html' style='height:4500px;width:100%;overflow:hidden;'></object>";
              //$keyword="ต้นทุนในการผลิตข้าวของชาวนาต่อ 1 ไร่";
              $pn->append($src);
              $pn_info->append($keyword);

            }elseif($obj=="preview1_1_3"){
              $src="<object data='./images/info/job1_3/web/job1_3.html' style='height:1500px;width:100%;overflow:hidden;'></object>";
              //$keyword="ต้นทุนในการผลิตข้าวของชาวนาต่อ 1 ไร่";
              $pn->append($src);
              $pn_info->append($keyword);

            }elseif($obj=="preview1_1_4"){
              $src="<object data='./images/info/job1_4x/web/job1_4x.html' style='height:900px;width:100%;overflow:hidden;'></object>";
              //$keyword="ต้นทุนในการผลิตข้าวของชาวนาต่อ 1 ไร่";
              $pn->append($src);
              $pn_info->append($keyword);
            }elseif($obj=="preview1_1_6"){
              $src="<object data='./images/info/job1_6/web/job1_6.html' style='height:920px;width:100%;overflow:hidden;'></object>";
              //$keyword="ต้นทุนในการผลิตข้าวของชาวนาต่อ 1 ไร่";
              $pn->append($src);
              $pn_info->append($keyword);
            }elseif($obj=="preview1_1_7"){
              $src="<object data='./images/info/job1_7/web/job1_7.html' style='height:800px;width:100%;overflow:hidden;'></object>";
              //$keyword="ต้นทุนในการผลิตข้าวของชาวนาต่อ 1 ไร่";
              $pn->append($src);
              $pn_info->append($keyword);
            }elseif($obj=="preview1_1_8"){
              $src="<object data='./images/info/job1_8/web/job1_8.html' style='height:700px;width:100%;overflow:hidden;'></object>";
              //$keyword="ต้นทุนในการผลิตข้าวของชาวนาต่อ 1 ไร่";
              $pn->append($src);
              $pn_info->append($keyword);
            }




			$this->waitevent();
		}
 }

?>
