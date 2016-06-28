<?php
require_once("Project/bussiness/Plugin_GtoGDao.php");
require_once("Project/common/plugin_gtog.php");

require_once("Project/bussiness/Plugin_Gtog_DataDao.php");
require_once("Project/common/plugin_gtog_data.php");

class  ShowData4 extends TForm
{
	 	
	function ShowData4()
	{
		global $ConfigPage;
		$this->Init("ShowData4","DataL3","",true);

		$topic=$this->getdata('topic');
		$sub=$this->getdata('sub');

		$pn_data=new TPanel();
        $pn_data->set("pn_data","","","",true,"","");
        $this->add($pn_data);

		if($topic=="4")
		{
			if($sub=="1")
			{
				$dao_gtog=new Plugin_GtoGDao();
					$o_gtog=$dao_gtog->selectAllByOpenLimit("1");

				$pn_data->append("
                <div class='post'>
                    <h3 class='title title-blog'>การขายข้าวแบบ G to G ข้อมูล ณ วันที่ ".$o_gtog[0]->gtogDate."</h3>
                ");

				$dao_gtog_data=new Plugin_Gtog_DataDao();
					$o_gtog_data=$dao_gtog_data->selectAllByGtogID($o_gtog[0]->gtogID,"BULOG");

				$stringtable="<p>";
				$stringtable.="<center><h4 class='title title-blog'>ขายข้าวแบบ G to G ขายให้ BULOG</h4></center>";
				$stringtable.="<hr />";
				$stringtable.="<table class='table table-striped'>";
				$stringtable.="<thead><tr><th>งวดที่/สัญญาที่</th><th>ชนิดข้าว</th><th>ปริมาณ (ตัน)</th><th>ราคา (เหรียญ/ตัน)</th></tr></thead>";
				$stringtable.="<tbody>";
				for($i=0;$i<count($o_gtog_data);$i++)
				{
					$stringtable.="<tr><td>".$o_gtog_data[$i]->gtogPeriod."</td><td>".$o_gtog_data[$i]->riceType."</td><td>".$o_gtog_data[$i]->gtogValue."</td><td>".$o_gtog_data[$i]->gtogPrice."</td></tr>";
				}
				$stringtable.="</tbody>";
				$stringtable.="</table>";
				$stringtable.="</p>";
				$pn_data->append($stringtable);

				
				$o_gtog_data=$dao_gtog_data->selectAllByGtogID($o_gtog[0]->gtogID,"COFCO");

				$stringtable="<p>";
				$stringtable.="<center><h4 class='title title-blog'>ขายข้าวแบบ G to G ขายให้ COFCO</h4></center>";
				$stringtable.="<hr />";
				$stringtable.="<table class='table table-striped'>";
				$stringtable.="<thead><tr><th>งวดที่/สัญญาที่</th><th>ชนิดข้าว</th><th>ปริมาณ (ตัน)</th><th>ราคา (เหรียญ/ตัน)</th></tr></thead>";
				$stringtable.="<tbody>";
				for($i=0;$i<count($o_gtog_data);$i++)
				{
					$stringtable.="<tr><td>".$o_gtog_data[$i]->gtogPeriod."</td><td>".$o_gtog_data[$i]->riceType."</td><td>".$o_gtog_data[$i]->gtogValue."</td><td>".$o_gtog_data[$i]->gtogPrice."</td></tr>";
				}
				$stringtable.="</tbody>";
				$stringtable.="</table>";
				$stringtable.="</p>";
				$pn_data->append($stringtable);

				$o_gtog_data=$dao_gtog_data->selectAllByGtogID($o_gtog[0]->gtogID,"NFA");

				$stringtable="<p>";
				$stringtable.="<center><h4 class='title title-blog'>ขายข้าวแบบ G to G ขายให้ NFA</h4></center>";
				$stringtable.="<hr />";
				$stringtable.="<table class='table table-striped'>";
				$stringtable.="<thead><tr><th>งวดที่/สัญญาที่</th><th>ชนิดข้าว</th><th>ปริมาณ (ตัน)</th><th>ราคา (เหรียญ/ตัน)</th></tr></thead>";
				$stringtable.="<tbody>";
				for($i=0;$i<count($o_gtog_data);$i++)
				{
					$stringtable.="<tr><td>".$o_gtog_data[$i]->gtogPeriod."</td><td>".$o_gtog_data[$i]->riceType."</td><td>".$o_gtog_data[$i]->gtogValue."</td><td>".$o_gtog_data[$i]->gtogPrice."</td></tr>";
				}
				$stringtable.="</tbody>";
				$stringtable.="</table>";
				$stringtable.="</p>";
				$pn_data->append($stringtable);


				$pn_data->append("
                	</div>
				");
			}
		}
		$this->waitevent();
	}	
}

?>