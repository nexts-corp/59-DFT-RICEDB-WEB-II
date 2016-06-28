<?php

require_once("Project/bussiness/Plugin_Manufacturing_WorldDao.php");
require_once("Project/common/plugin_manufacturing_world.php");

require_once("Project/bussiness/Plugin_Manufacturing_World_GenDao.php");
require_once("Project/common/plugin_manufacturing_world_gen.php");

require_once("Project/bussiness/Plugin_Manufacturing_World_ImportDao.php");
require_once("Project/common/plugin_manufacturing_world_import.php");

require_once("Project/bussiness/Plugin_Manufacturing_World_ExportDao.php");
require_once("Project/common/plugin_manufacturing_world_export.php");

require_once("Project/bussiness/Plugin_Manufacturing_World_Export_ConsulateDao.php");
require_once("Project/common/plugin_manufacturing_world_export_consulate.php");

require_once("Project/bussiness/Plugin_PlantedDao.php");
require_once("Project/common/plugin_planted.php");

require_once("Project/bussiness/Plugin_Planted_CisnerosDao.php");
require_once("Project/common/plugin_planted_cisneros.php");

require_once("Project/bussiness/Plugin_ProphecyDao.php");
require_once("Project/common/plugin_prophecy.php");

require_once("Project/bussiness/Plugin_Prophecy_DataDao.php");
require_once("Project/common/plugin_prophecy_data.php");

require_once("Project/bussiness/Plugin_Costs_RiceDao.php");
require_once("Project/common/plugin_costs_rice.php");

require_once("Project/bussiness/Plugin_Costs_Rice_DataDao.php");
require_once("Project/common/plugin_costs_rice_data.php");

require_once("Project/bussiness/Plugin_SourceDao.php");
require_once("Project/common/plugin_source.php");


class  ShowData1 extends TForm
{
	 	
	function ShowData1()
	{
		global $ConfigPage;
		$this->Init("ShowData1","DataL3","",true);

		$topic=$this->getdata('topic');
		$sub=$this->getdata('sub');

		$pn_data=new TPanel();
        $pn_data->set("pn_data","","","",true,"","");
        $this->add($pn_data);

        $dao_source=new Plugin_SourceDao();

		if($topic=="1")
		{
			if($sub=="1")
			{
				$dao_manufacturing_world=new Plugin_Manufacturing_WorldDao();
					$o_manufacturing_world=$dao_manufacturing_world->selectAllByOpenLimit("1");

				

				$pn_data->append("
                <div class='post'>
                    <h3 class='title title-blog'>สถานการณ์ข้าวโลกและข้าวไทย ข้อมูล ณ วันที่ : ".$o_manufacturing_world[0]->worldYear."</h3>
                ");

				$dao_manufacturing_world_gen=new Plugin_Manufacturing_World_GenDao();
					$o_manufacturing_world_gen=$dao_manufacturing_world_gen->selectAllByWorldID($o_manufacturing_world[0]->worldID);

					$o_source_1=$dao_source->selectAllByDataID($o_manufacturing_world[0]->worldID."_1_1");

					$stringtable="<p>";
					$stringtable.="<center><h4 class='title title-blog'>การผลิตและการบริโภคข้าวของต่างประเทศ</h4></center>";
					$stringtable.="<p>แหล่งที่มาของข้อมูล : ".$o_source_1[0]->sourceName."</p>";
					$stringtable.="<hr />";
					$stringtable.="<table class='table table-striped'>";
					$stringtable.="<thead><tr><th>ประเทศ</th><th>ผลิตข้าว (ล้านตันข้าวสาร)</th><th>บริโภคข้าว (ล้านตันข้าวสาร)</th></tr></thead>";
					$stringtable.="<tbody>";
					for($i=0;$i<count($o_manufacturing_world_gen);$i++)
					{
						$stringtable.="<tr><td>".$o_manufacturing_world_gen[$i]->country."</td><td>".$o_manufacturing_world_gen[$i]->generate."</td><td>".$o_manufacturing_world_gen[$i]->consume."</td></tr>";
					}
					$stringtable.="</tbody>";
					$stringtable.="</table>";
					$stringtable.="</p>";
				$pn_data->append($stringtable);

				$dao_manufacturing_world_import=new Plugin_Manufacturing_World_ImportDao();
					$o_manufacturing_world_import=$dao_manufacturing_world_import->selectAllByWorldID($o_manufacturing_world[0]->worldID);

					$o_source_2=$dao_source->selectAllByDataID($o_manufacturing_world[0]->worldID."_1_5");

					$stringtable1="<p>";
					$stringtable1.="<center><h4 class='title title-blog'>การนำเข้าข้าวของต่างประเทศ</h4></center>";
					$stringtable1.="<p>แหล่งที่มาของข้อมูล : ".$o_source_2[0]->sourceName."</p>";
					$stringtable1.="<hr />";
					$stringtable1.="<table class='table table-striped'>";
					$stringtable1.="<thead><tr><th>ประเทศ</th><th>ปริมาณ (ล้านตันข้าวสาร)</th></tr></thead>";
					$stringtable1.="<tbody>";
					for($i=0;$i<count($o_manufacturing_world_import);$i++)
					{
						$stringtable1.="<tr><td>".$o_manufacturing_world_import[$i]->country."</td><td>".$o_manufacturing_world_import[$i]->ricevalues."</td></tr>";
					}
					$stringtable1.="</tbody>";
					$stringtable1.="</table>";
					$stringtable1.="</p>";
				$pn_data->append($stringtable1);

				$dao_manufacturing_world_export=new Plugin_Manufacturing_World_ExportDao();
					$o_manufacturing_world_export=$dao_manufacturing_world_export->selectAllByWorldID($o_manufacturing_world[0]->worldID);

					$o_source_3=$dao_source->selectAllByDataID($o_manufacturing_world[0]->worldID."_1_2");

					$stringtable2="<p>";
					$stringtable2.="<center><h4 class='title title-blog'>การส่งออกข้าวของต่างประเทศ</h4></center>";
					$stringtable2.="<p>แหล่งที่มาของข้อมูล : ".$o_source_3[0]->sourceName."</p>";
					$stringtable2.="<hr />";
					$stringtable2.="<table class='table table-striped'>";
					$stringtable2.="<thead><tr><th>ประเทศ</th><th>ปริมาณ (ล้านตันข้าวสาร)</th></tr></thead>";
					$stringtable2.="<tbody>";
					for($i=0;$i<count($o_manufacturing_world_export);$i++)
					{
						$stringtable2.="<tr><td>".$o_manufacturing_world_export[$i]->country."</td><td>".$o_manufacturing_world_export[$i]->ricevalues."</td></tr>";
					}
					$stringtable2.="</tbody>";
					$stringtable2.="</table>";
					$stringtable2.="</p>";
				$pn_data->append($stringtable2);

				$dao_manufacturing_world_export_consulate=new Plugin_Manufacturing_World_Export_ConsulateDao();
					$o_manufacturing_world_export_consulate=$dao_manufacturing_world_export_consulate->selectAllByWorldID($o_manufacturing_world[0]->worldID);

					$o_source_4=$dao_source->selectAllByDataID($o_manufacturing_world[0]->worldID."_1_3");

					$stringtable3="<p>";
					$stringtable3.="<center><h4 class='title title-blog'>การส่งออกข้าวของไทย (ข้อมูลกรมศุลกากร)</h4></center>";
					$stringtable3.="<p>แหล่งที่มาของข้อมูล : ".$o_source_4[0]->sourceName."</p>";
					$stringtable3.="<hr />";
					$stringtable3.="<table class='table table-striped'>";
					$stringtable3.="<thead><tr><th>ประเทศ</th><th>ปริมาณ (ก.ก)</th><th>มูลค่า (เหรียญสหรัฐ)</th><th>% Share</th></tr></thead>";
					$stringtable3.="<tbody>";
					for($i=0;$i<count($o_manufacturing_world_export_consulate);$i++)
					{
						$stringtable2.="<tr><td>".$o_manufacturing_world_export_consulate[$i]->country."</td><td>".$o_manufacturing_world_export_consulate[$i]->quantity."</td><td>".$o_manufacturing_world_export_consulate[$i]->consulateValue."</td><td>".$o_manufacturing_world_export_consulate[$i]->consulateShare."</td></tr>";
					}
					$stringtable3.="</tbody>";
					$stringtable3.="</table>";
					$stringtable3.="</p>";
				$pn_data->append($stringtable3);


				$pn_data->append("
                </div>
				");
			}
			if($sub=="2")
			{
				$dao_planted=new Plugin_PlantedDao();
					$o_planted=$dao_planted->selectAllByOpenLimit("1");

				$pn_data->append("
                <div class='post'>
                    <h3 class='title title-blog'>เนื้อที่เพาะปลูกและผลผลิตต่อไร่ ข้อมูล ณ วันที่ : ".$o_planted[0]->plantedYear."</h3>
                ");

				$dao_planted_cisneros=new Plugin_Planted_CisnerosDao();
					$o_planted_cisneros=$dao_planted_cisneros->selectAllByPlantedID($o_planted[0]->plantedID,"1");

					$o_source_2_1=$dao_source->selectAllByDataID($o_planted[0]->plantedID."_2_1");

					$stringtable="<p>";
					$stringtable.="<center><h4 class='title title-blog'>เนื้อที่เพาะปลูกและผลผลิตต่อไร่ ข้าวนาปี</h4></center>";
					$stringtable.="<p>แหล่งที่มาของข้อมูล : ".$o_source_2_1[0]->sourceName."</p>";
					$stringtable.="<hr />";
					$stringtable.="<table class='table table-striped'>";
					$stringtable.="<thead><tr><th>จังหวัด</th><th>ประเภทข้าว</th><th>เนื้อเพาะปลูก(ไร่)</th><th>เนื้อที่เก็บเกี่ยว(ไร่)</th><th>ผลผลิต(ตัน)</th><th>ผลผลิต/ไร่เพาะปลูก(ก.ก)</th><th>ผลผลิต/ไร่เก็บเกี่ยว (ก.ก)</th><th>ร้อยละเนื้อที่เพาะปลูก</th></tr></thead>";
					$stringtable.="<tbody>";
					for($i=0;$i<count($o_planted_cisneros);$i++)
					{
						$stringtable.="<tr><td>".$o_planted_cisneros[$i]->province."</td><td>".$o_planted_cisneros[$i]->typerice."</td><td>".$o_planted_cisneros[$i]->areaFarming."</td><td>".$o_planted_cisneros[$i]->areaHarvest."</td><td>".$o_planted_cisneros[$i]->product."</td><td>".$o_planted_cisneros[$i]->productFarming."</td><td>".$o_planted_cisneros[$i]->productHarvest."</td><td>".$o_planted_cisneros[$i]->percent."</td></tr>";
					}
					$stringtable.="</tbody>";
					$stringtable.="</table>";
					$stringtable.="</p>";
				$pn_data->append($stringtable);


				$dao_planted_cisneros=new Plugin_Planted_CisnerosDao();
					$o_planted_cisneros=$dao_planted_cisneros->selectAllByPlantedID($o_planted[0]->plantedID,"2");

					$o_source_2_2=$dao_source->selectAllByDataID($o_planted[0]->plantedID."_2_2");

					$stringtable1="<p>";
					$stringtable1.="<center><h4 class='title title-blog'>เนื้อที่เพาะปลูกและผลผลิตต่อไร่ ข้าวนาปรัง</h4></center>";
					$stringtable1.="<p>แหล่งที่มาของข้อมูล : ".$o_source_2_2[0]->sourceName."</p>";
					$stringtable1.="<hr />";
					$stringtable1.="<table class='table table-striped'>";
					$stringtable1.="<thead><tr><th>จังหวัด</th><th>ประเภทข้าว</th><th>เนื้อเพาะปลูก(ไร่)</th><th>เนื้อที่เก็บเกี่ยว(ไร่)</th><th>ผลผลิต(ตัน)</th><th>ผลผลิต/ไร่เพาะปลูก(ก.ก)</th><th>ผลผลิต/ไร่เก็บเกี่ยว(ก.ก)</th><th>ร้อยละเนื้อที่เพาะปลูก</th></tr></thead>";
					$stringtable1.="<tbody>";
					for($i=0;$i<count($o_planted_cisneros);$i++)
					{
						$stringtable1.="<tr><td>".$o_planted_cisneros[$i]->province."</td><td>".$o_planted_cisneros[$i]->typerice."</td><td>".$o_planted_cisneros[$i]->areaFarming."</td><td>".$o_planted_cisneros[$i]->areaHarvest."</td><td>".$o_planted_cisneros[$i]->product."</td><td>".$o_planted_cisneros[$i]->productFarming."</td><td>".$o_planted_cisneros[$i]->productHarvest."</td><td>".$o_planted_cisneros[$i]->percent."</td></tr>";
					}
					$stringtable1.="</tbody>";
					$stringtable1.="</table>";
					$stringtable1.="</p>";
				$pn_data->append($stringtable1);

                $pn_data->append("
                </div>
				");
			}
			if($sub=="3")
			{
				$dao_prophecy=new Plugin_ProphecyDao();
					$o_prophecy=$dao_prophecy->selectAllByOpenLimit("1");

				$pn_data->append("
                <div class='post'>
                    <h3 class='title title-blog'>พยากรณ์การผลิตข้าว ข้อมูล ณ วันที่ : ".$o_prophecy[0]->prophecyYear."</h3>
                ");

				$dao_prophecy_data=new Plugin_Prophecy_DataDao();
					$o_prophecy_data=$dao_prophecy_data->selectAllByProphecyID($o_prophecy[0]->prophecyID);

					$o_source_3_1=$dao_source->selectAllByDataID($o_prophecy[0]->prophecyID."_3_1");

					$stringtable="<p>";
					$stringtable.="<center><h4 class='title title-blog'>พยากรณ์การผลิตข้าว นาปี/นาปรัง</h4></center>";
					$stringtable.="<p>แหล่งที่มาของข้อมูล : ".$o_source_3_1[0]->sourceName."</p>";
					$stringtable.="<hr />";
					$stringtable.="<table class='table table-striped'>";
					$stringtable.="<thead><tr><th>นาปี/นาปรัง</th><th>เนื้อที่เพาะปลูก(ไร่)</th><th>ปริมาณ เพิ่ม-ลด จากปีที่ผ่านมา</th><th>ร้อยละ เพิ่ม-ลด จากปีที่ผ่านมา</th><th>ผลผลิต(ตัน)</th><th>ปริมาณ เพิ่ม-ลด จากปีที่ผ่านมา</th><th>ร้อยละ เพิ่ม-ลด จากปีที่ผ่านมา</th><th>ผลผลิต/ไร่(ก.ก)</th><th>ปริมาณ เพิ่ม-ลด จากปีที่ผ่านมา</th><th>ร้อยละ เพิ่ม-ลด จากปีที่ผ่านมา</th></tr></thead>";
					$stringtable.="<tbody>";
					for($i=0;$i<count($o_prophecy_data);$i++)
					{
						if($o_prophecy_data[$i]->typePlanted=="1")
							$Planted="นาปี";
						if($o_prophecy_data[$i]->typePlanted=="2")
							$Planted="นาปรัง";
						$stringtable.="<tr><td>".$Planted."</td><td>".$o_prophecy_data[$i]->areaFarming."</td><td>".$o_prophecy_data[$i]->areaFarmingValue."</td><td>".$o_prophecy_data[$i]->areaFarmingPercent."</td><td>".$o_prophecy_data[$i]->product."</td><td>".$o_prophecy_data[$i]->productValue."</td><td>".$o_prophecy_data[$i]->productPercent."</td><td>".$o_prophecy_data[$i]->productFarming."</td><td>".$o_prophecy_data[$i]->productFarmingValue."</td><td>".$o_prophecy_data[$i]->productFarmingPercent."</td></tr>";
					}
					$stringtable.="</tbody>";
					$stringtable.="</table>";
					$stringtable.="</p>";
				$pn_data->append($stringtable);

                $pn_data->append("
                </div>
				");
			}
			if($sub=="4")
			{
				$pn_data->append("
                <div class='post'>
                    <h3 class='title title-blog'>ต้นทุนการผลิตข้าวของชาวนา</h3>
                ");

				$dao_costs_rice=new Plugin_Costs_RiceDao();
					$o_costs_rice=$dao_costs_rice->selectAllByOpen();

				$dao_costs_rice_data=new Plugin_Costs_Rice_DataDao();

				

				for($j=0;$j<count($o_costs_rice);$j++)
				{
					$o_source_4_1=$dao_source->selectAllByDataID($o_costs_rice[$j]->costsID."_4_1");

				$stringtable="<p>";
				$stringtable.="<center><h4 class='title title-blog'>".$o_costs_rice[$j]->costsName."</h4></center>";
				$stringtable.="<p>แหล่งที่มาของข้อมูล : ".$o_source_4_1[0]->sourceName."</p>";
				$stringtable.="<h5>".$o_costs_rice[$j]->province."</h5>";
				$stringtable.="<hr />";
				$stringtable.="<table class='table table-striped'>";
				$stringtable.="<thead><tr><th>รายการ</th><th>ค่าใช้จ่าย (บาท/ไร่)</th></tr></thead>";
				$stringtable.="<tbody>";
				
				$o_costs_rice_data=$dao_costs_rice_data->selectAllBycostsID($o_costs_rice[$i]->costsID);

				for($i=0;$i<count($o_costs_rice_data);$i++)
				{
					$stringtable.="<tr><td>".$o_costs_rice_data[$i]->dataItem."</td><td>".$o_costs_rice_data[$i]->dataPrice."</td></tr>";
				}
				$stringtable.="</tbody>";
				$stringtable.="</table>";
				$stringtable.="</p>";
				$pn_data->append($stringtable);
				}

                $pn_data->append("
                </div>
				");
			}
		}
		$this->waitevent();
	}	
}

?>