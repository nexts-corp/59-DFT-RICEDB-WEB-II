<?php

require_once("Project/bussiness/Plugin_MeasureDao.php");
require_once("Project/common/plugin_measure.php");


class  ShowData2 extends TForm
{
	 	
	function ShowData2()
	{
		global $ConfigPage;
		$this->Init("ShowData2","DataL3","",true);

		$topic=$this->getdata('topic');
		$sub=$this->getdata('sub');

		$pn_data=new TPanel();
        $pn_data->set("pn_data","","","",true,"","");
        $this->add($pn_data);

		if($topic=="2")
		{
			if($sub=="1")
			{
				$pn_data->append("
                <div class='post'>
                    <h3 class='title title-blog'>มาตรการช่วยเหลือเกษตรกรผู้ปลูกข้าว</h3>
                ");

				$dao_measure=new Plugin_MeasureDao();
					$o_measure=$dao_measure->selectAllByOpen();

					$stringtable="<p>";
					$stringtable.="<hr />";
					$stringtable.="<table class='table table-striped'>";
					$stringtable.="<thead><tr><th>หน่วยงาน</th><th>มาตรการ</th><th>เป้าหมาย</th><th>ระยะเวลาดำเนินการ</th><th>ปีที่มีมาตรการ</th></tr></thead>";
					$stringtable.="<tbody>";
					for($i=0;$i<count($o_measure);$i++)
					{
						$stringtable.="<tr><td>".$o_measure[$i]->measureDepartment."</td><td>".$o_measure[$i]->measureDetail."</td><td>".$o_measure[$i]->measureTarget."</td><td>".$o_measure[$i]->measureTime."</td><td>".$o_measure[$i]->measureYear."</td></tr>";
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