<?php
class  ShowInfo_6 extends TForm
 {

		function ShowInfo_6()
		{
			global $ConfigPage;
				$this->Init("ShowInfo_6","Info","",true);

        $pn=new TPanel();
        $pn->set("pn","","","",true,"","");
        $this->add($pn);



        $pn_info=new TPanel();
        $pn_info->set("pn_info","","","",true,"","");
        $this->add($pn_info);


        $obj=$this->getdata('inf');
        
        if(empty($obj))
              $obj="preview5_1";

        if($obj=="preview5_1"){
          $src="<object data='./images/info/job5_1/web/job5_1.html' style='height:2200px;width:100%;overflow:hidden;'></object>";
          //$keyword="ต้นทุนในการผลิตข้าวของชาวนาต่อ 1 ไร่";
          $pn->append($src);
          $pn_info->append($keyword);

        }



			$this->waitevent();
		}
 }

?>
