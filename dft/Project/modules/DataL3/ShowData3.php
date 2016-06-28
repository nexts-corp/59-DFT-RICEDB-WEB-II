<?php

require_once("Project/bussiness/Plugin_Price_Rice_WorldDao.php");
require_once("Project/common/plugin_price_rice_world.php");

require_once("Project/bussiness/Plugin_Price_Rice_World_FobDao.php");
require_once("Project/common/plugin_price_rice_world_fob.php");

require_once("Project/bussiness/Plugin_Price_Rice_World_ChamberDao.php");
require_once("Project/common/plugin_price_rice_world_chamber.php");

require_once("Project/bussiness/Plugin_Price_Rice_ThaiDao.php");
require_once("Project/common/plugin_price_rice_thai.php");

require_once("Project/bussiness/Plugin_Price_Rice_Thai_PaddyDao.php");
require_once("Project/common/plugin_price_rice_thai_paddy.php");

require_once("Project/bussiness/Plugin_Price_Rice_Thai_Paddy_DataDao.php");
require_once("Project/common/plugin_price_rice_thai_paddy_data.php");

require_once("Project/bussiness/Plugin_Price_Rice_Thai_RiceDao.php");
require_once("Project/common/plugin_price_rice_thai_rice.php");
class  ShowData3 extends TForm
{
	 	
	function ShowData3()
	{
		global $ConfigPage;
		$this->Init("ShowData3","DataL3","",true);

		$topic=$this->getdata('topic');
		$sub=$this->getdata('sub');

		$pn_data=new TPanel();
        $pn_data->set("pn_data","","","",true,"","");
        $this->add($pn_data);

		if($topic=="3")
		{
			if($sub=="1")
			{
				$dao_price_rice_world=new Plugin_Price_Rice_WorldDao();
					$o_price_rice_world=$dao_price_rice_world->selectAllByOpenLimit("1","1");
					$o_price_rice_world1=$dao_price_rice_world->selectAllByOpenLimit("1","2");

				$pn_data->append("
                <div class='post'>
                    <h3 class='title title-blog'>ราคาข้าวโลก ข้อมูลจากต่างประเทศ ข้อมูล ณ วันที่ ".$o_price_rice_world[0]->worldData."</h3>
                ");

				$dao_price_rice_world_fob=new Plugin_Price_Rice_World_FobDao();
					$o_price_rice_world_fob=$dao_price_rice_world_fob->selectAllByWorldID($o_price_rice_world[0]->worldID);

				$stringtable="<p>";
				$stringtable.="<center><h4 class='title title-blog'>ข้อมูลจากต่างประเทศ</h4></center>";
				$stringtable.="<hr />";
				$stringtable.="<table class='table table-striped'>";
				$stringtable.="<thead><tr><th>ชนิดข้าว</th><th>ประเทศ</th><th>ราคา FOB (เหรียญสหรัฐ)</th></tr></thead>";
				$stringtable.="<tbody>";
				for($i=0;$i<count($o_price_rice_world_fob);$i++)
				{
					$stringtable.="<tr><td>".$o_price_rice_world_fob[$i]->fobType."</td><td>".$o_price_rice_world_fob[$i]->fobCountry."</td><td>".$o_price_rice_world_fob[$i]->fobValue."</td></tr>";
				}
				$stringtable.="</tbody>";
				$stringtable.="</table>";
				$stringtable.="</p>";
				$pn_data->append($stringtable);


				$dao_price_rice_world_chamber=new Plugin_Price_Rice_World_ChamberDao();
					$o_price_rice_world_chamber=$dao_price_rice_world_chamber->selectAllByWorldID($o_price_rice_world1[0]->worldID);

				$stringtable1="<h3 class='title title-blog'>ราคาข้าวโลก ข้อมูลจากสภาหอการค้า ข้อมูล ณ วันที่ ".$o_price_rice_world1[0]->worldData."</h3>";
				$stringtable1.="<p>";
				$stringtable1.="<center><h4 class='title title-blog'>ข้อมูลสภาหอการค้าแห่งประเทศไทย</h4></center>";
				$stringtable1.="<hr />";
				$stringtable1.="<table class='table table-striped'>";
				$stringtable1.="<thead><tr><th>ชนิดข้าว</th><th>ราคา FOB ต่อเมตริกตัน งวดก่อน</th><th>ราคา FOB ต่อเมตริกตัน งวดนี้</th></tr></thead>";
				$stringtable1.="<tbody>";
				for($i=0;$i<count($o_price_rice_world_chamber);$i++)
				{
					$stringtable1.="<tr><td>".$o_price_rice_world_chamber[$i]->riceType."</td><td>".$o_price_rice_world_chamber[$i]->fobBefore."</td><td>".$o_price_rice_world_chamber[$i]->fobAfter."</td></tr>";
				}
				$stringtable1.="</tbody>";
				$stringtable1.="</table>";
				$stringtable1.="</p>";
				$pn_data->append($stringtable1);

				$pn_data->append("
                	</div>
				");
			}
			if($sub=="2")
			{
				$dao_price_rice_thai=new Plugin_Price_Rice_ThaiDao();
				$dao_price_rice_thai_paddy=new Plugin_Price_Rice_Thai_PaddyDao();
				$dao_price_rice_thai_paddy_data=new Plugin_Price_Rice_Thai_Paddy_DataDao();

				$pn_data->append("
                <div class='post'>
                    <h3 class='title title-blog'>ราคาข้าวไทย</h3>
                    <hr />
                ");

				
				$o_price_rice_thai_1=$dao_price_rice_thai->selectAllByTypeLimit("1","1");

				
				$o_price_rice_thai_paddy_1=$dao_price_rice_thai_paddy->selectAllByThaiID($o_price_rice_thai_1[0]->thaiID,"1");

				$stringtable_1="<p>";
				$stringtable_1.="<h4 class='title'>ราคาข้าวเปลือกภูมิภาค (กรมการค้าภายใน)</h4>";
				$stringtable_1.="<h5 class='title'>ข้อมูล ณ วันที่ : ".$o_price_rice_thai_1[0]->thaiDate."</h5>";
				//$stringtable_1.="<hr />";
				$stringtable_1.="<table class='table table-striped'>";
				$stringtable_1.="<thead>
									<tr>
										<th>ชนิดข้าวเปลือก</th>
										<th>สัปดาห์ก่อน ต่ำ-สูง</th>
										<th>จันทร์</th>
										<th>อังคาร</th>
										<th>พุธ</th>
										<th>พฤหัสบดี</th>
										<th>ศุกร์</th>
										<th>สัปดาห์นี้ ต่ำ-สูง</th>
									</tr>
								</thead>";
				$stringtable_1.="<tbody>";
				for($i=0;$i<count($o_price_rice_thai_paddy_1);$i++)
				{
					$stringtable_1.="<tr>
										<td colspan='8'><h5>".$o_price_rice_thai_paddy_1[$i]->paddyType."</h5></td>
									</tr>";
					$o_price_rice_thai_paddy_data_1=$dao_price_rice_thai_paddy_data->selectAllByPaddyID($o_price_rice_thai_paddy_1[$i]->paddyID);
					for($j=0;$j<count($o_price_rice_thai_paddy_data_1);$j++)
					{
						$stringtable_1.="<tr>
											<td>".$o_price_rice_thai_paddy_data_1[$j]->data1."</td>
											<td>".$o_price_rice_thai_paddy_data_1[$j]->data2."</td>
											<td>".$o_price_rice_thai_paddy_data_1[$j]->data3."</td>
											<td>".$o_price_rice_thai_paddy_data_1[$j]->data4."</td>
											<td>".$o_price_rice_thai_paddy_data_1[$j]->data5."</td>
											<td>".$o_price_rice_thai_paddy_data_1[$j]->data6."</td>
											<td>".$o_price_rice_thai_paddy_data_1[$j]->data7."</td>
											<td>".$o_price_rice_thai_paddy_data_1[$j]->data8."</td>
										</tr>";
					}
				}
				$stringtable_1.="</tbody>";
				$stringtable_1.="</table>";
				$stringtable_1.="</p>";
				$stringtable_1.="<hr />";
				$pn_data->append($stringtable_1);

				//
				$o_price_rice_thai_2=$dao_price_rice_thai->selectAllByTypeLimit("2","1");

				
				$o_price_rice_thai_paddy_2=$dao_price_rice_thai_paddy->selectAllByThaiID($o_price_rice_thai_2[0]->thaiID,"2");

				$stringtable_1="<p>";
				$stringtable_1.="<h4 class='title'>ราคาข้าวเปลือกเฉลี่ย (สมาคมโรงสีข้าวไทย)</h4>";
				$stringtable_1.="<h5 class='title'>ข้อมูล ณ วันที่ : ".$o_price_rice_thai_2[0]->thaiDate."</h5>";
				$stringtable_1.="<table class='table table-striped'>";
				$stringtable_1.="<thead>
									<tr>
										<th>ชนิดข้าว/เดือน</th>
										<th>ม.ค.</th>
										<th>ก.พ.</th>
										<th>มี.ค.</th>
										<th>เม.ย.</th>
										<th>พ.ค.</th>
										<th>มิ.ย.</th>
										<th>ก.ค.</th>
										<th>ส.ค.</th>
										<th>ก.ย.</th>
										<th>ต.ค.</th>
										<th>พ.ย.</th>
										<th>ธ.ค.</th>
										<th>เฉลี่ย</th>
									</tr>
								</thead>";
				$stringtable_1.="<tbody>";
				for($i=0;$i<count($o_price_rice_thai_paddy_2);$i++)
				{
					$stringtable_1.="<tr>
										<td colspan='14'><h5>".$o_price_rice_thai_paddy_2[$i]->paddyType."</h5></td>
									</tr>";
					$o_price_rice_thai_paddy_data_2=$dao_price_rice_thai_paddy_data->selectAllByPaddyID($o_price_rice_thai_paddy_2[$i]->paddyID);
					for($j=0;$j<count($o_price_rice_thai_paddy_data_2);$j++)
					{
						$stringtable_1.="<tr>
											<td>".$o_price_rice_thai_paddy_data_2[$j]->data1."</td>
											<td>".$o_price_rice_thai_paddy_data_2[$j]->data2."</td>
											<td>".$o_price_rice_thai_paddy_data_2[$j]->data3."</td>
											<td>".$o_price_rice_thai_paddy_data_2[$j]->data4."</td>
											<td>".$o_price_rice_thai_paddy_data_2[$j]->data5."</td>
											<td>".$o_price_rice_thai_paddy_data_2[$j]->data6."</td>
											<td>".$o_price_rice_thai_paddy_data_2[$j]->data7."</td>
											<td>".$o_price_rice_thai_paddy_data_2[$j]->data8."</td>
											<td>".$o_price_rice_thai_paddy_data_2[$j]->data9."</td>
											<td>".$o_price_rice_thai_paddy_data_2[$j]->data10."</td>
											<td>".$o_price_rice_thai_paddy_data_2[$j]->data11."</td>
											<td>".$o_price_rice_thai_paddy_data_2[$j]->data12."</td>
											<td>".$o_price_rice_thai_paddy_data_2[$j]->data13."</td>
											<td>".$o_price_rice_thai_paddy_data_2[$j]->data14."</td>
										</tr>";
					}
				}
				$stringtable_1.="</tbody>";
				$stringtable_1.="</table>";
				$stringtable_1.="</p>";
				$stringtable_1.="<hr />";
				$pn_data->append($stringtable_1);

				//
				$o_price_rice_thai_3=$dao_price_rice_thai->selectAllByTypeLimit("3","1");

				
				$o_price_rice_thai_paddy_3=$dao_price_rice_thai_paddy->selectAllByThaiID($o_price_rice_thai_3[0]->thaiID,"3");

				$stringtable_1="<p>";
				$stringtable_1.="<h4 class='title'>ราคาที่เกษตรกรขายได้ที่ไร่-นาเฉลี่ยทั้งประเทศ (สำนักงานเศรษฐกิจการเกษตร)</h4>";
				$stringtable_1.="<h5 class='title'>ข้อมูล ณ วันที่ : ".$o_price_rice_thai_3[0]->thaiDate."</h5>";
				$stringtable_1.="<table class='table table-striped'>";
				$stringtable_1.="<thead>
									<tr>
										<th>สัปดาห์ที่ 1</th>
										<th>สัปดาห์ที่ 2</th>
										<th>สัปดาห์ที่ 3</th>
										<th>สัปดาห์ที่ 4</th>
										<th>สัปดาห์ที่ 5</th>
										<th>เฉลี่ย</th>
									</tr>
								</thead>";
				$stringtable_1.="<tbody>";
				for($i=0;$i<count($o_price_rice_thai_paddy_3);$i++)
				{
					$stringtable_1.="<tr>
										<td colspan='6'><h5>".$o_price_rice_thai_paddy_3[$i]->paddyType."</h5></td>
									</tr>";
					$o_price_rice_thai_paddy_data_3=$dao_price_rice_thai_paddy_data->selectAllByPaddyID($o_price_rice_thai_paddy_3[$i]->paddyID);
					for($j=0;$j<count($o_price_rice_thai_paddy_data_3);$j++)
					{
						$stringtable_1.="<tr>
											<td>".$o_price_rice_thai_paddy_data_3[$j]->data1."</td>
											<td>".$o_price_rice_thai_paddy_data_3[$j]->data2."</td>
											<td>".$o_price_rice_thai_paddy_data_3[$j]->data3."</td>
											<td>".$o_price_rice_thai_paddy_data_3[$j]->data4."</td>
											<td>".$o_price_rice_thai_paddy_data_3[$j]->data5."</td>
											<td>".$o_price_rice_thai_paddy_data_3[$j]->data6."</td>
										</tr>";
					}
				}
				$stringtable_1.="</tbody>";
				$stringtable_1.="</table>";
				$stringtable_1.="</p>";
				$stringtable_1.="<hr />";
				$pn_data->append($stringtable_1);

				//
				$o_price_rice_thai_4=$dao_price_rice_thai->selectAllByTypeLimit("4","1");

				
				$o_price_rice_thai_paddy_4=$dao_price_rice_thai_paddy->selectAllByThaiID($o_price_rice_thai_4[0]->thaiID,"4");

				$stringtable_1="<p>";
				$stringtable_1.="<h4 class='title'>ราคารับซื้อรายวันที่ตลาดกลางและตลาดสำคัญ (สำนักงานเศรษฐกิจการเกษตร)</h4>";
				$stringtable_1.="<h5 class='title'>ข้อมูล ณ วันที่ : ".$o_price_rice_thai_4[0]->thaiDate."</h5>";
				$stringtable_1.="<table class='table table-striped'>";
				$stringtable_1.="<thead>
									<tr>
										<th>เดือน/วันที่</th>
										<th>ท่าข้าว ธ.ก.ส.</th>
										<th>ตลาดกลางพืชไร่</th>
										<th>โรงสีอุดมศิริโชค</th>
										<th>โรงสีกิจทวียโสธร</th>
										<th>โรงสีสหพัฒนา</th>
										<th>โรงสีไฟไทยเจริญวัฒนา</th>
										<th>โรงสีเต็งเฮง</th>
										<th>โรงสีสหกรณ์การเกษตร เกษตรวิสัย จำกัด</th>
									</tr>
								</thead>";
				$stringtable_1.="<tbody>";
				for($i=0;$i<count($o_price_rice_thai_paddy_4);$i++)
				{
					$stringtable_1.="<tr>
										<td colspan='9'><h5>".$o_price_rice_thai_paddy_4[$i]->paddyType."</h5></td>
									</tr>";
					$o_price_rice_thai_paddy_data_4=$dao_price_rice_thai_paddy_data->selectAllByPaddyID($o_price_rice_thai_paddy_4[$i]->paddyID);
					for($j=0;$j<count($o_price_rice_thai_paddy_data_4);$j++)
					{
						$stringtable_1.="<tr>
											<td>".$o_price_rice_thai_paddy_data_4[$j]->data1."</td>
											<td>".$o_price_rice_thai_paddy_data_4[$j]->data2."</td>
											<td>".$o_price_rice_thai_paddy_data_4[$j]->data3."</td>
											<td>".$o_price_rice_thai_paddy_data_4[$j]->data4."</td>
											<td>".$o_price_rice_thai_paddy_data_4[$j]->data5."</td>
											<td>".$o_price_rice_thai_paddy_data_4[$j]->data6."</td>
											<td>".$o_price_rice_thai_paddy_data_4[$j]->data7."</td>
											<td>".$o_price_rice_thai_paddy_data_4[$j]->data8."</td>
											<td>".$o_price_rice_thai_paddy_data_4[$j]->data9."</td>
										</tr>";
					}
				}
				$stringtable_1.="</tbody>";
				$stringtable_1.="</table>";
				$stringtable_1.="</p>";
				$stringtable_1.="<hr />";
				$pn_data->append($stringtable_1);

				//
				$o_price_rice_thai_5=$dao_price_rice_thai->selectAllByTypeLimit("5","1");

				
				$o_price_rice_thai_paddy_5=$dao_price_rice_thai_paddy->selectAllByThaiID($o_price_rice_thai_5[0]->thaiID,"5");

				$stringtable_1="<p>";
				$stringtable_1.="<h4 class='title'>ราคาขายปลีกตลาดกรุงเทพฯ (กรมการค้าภายใน)</h4>";
				$stringtable_1.="<h5 class='title'>ข้อมูล ณ วันที่ : ".$o_price_rice_thai_5[0]->thaiDate."</h5>";
				$stringtable_1.="<table class='table table-striped'>";
				$stringtable_1.="<thead>
									<tr>
										<th>ชนิดข้าวสาร</th>
										<th>สัปดาห์ก่อน ต่ำ-สูง</th>
										<th>จันทร์</th>
										<th>อังคาร</th>
										<th>พุธ</th>
										<th>พฤหัสบดี</th>
										<th>ศุกร์</th>
										<th>สัปดาห์นี้ ต่ำ-สูง</th>
									</tr>
								</thead>";
				$stringtable_1.="<tbody>";
				for($i=0;$i<count($o_price_rice_thai_paddy_5);$i++)
				{
					$stringtable_1.="<tr>
										<td colspan='8'><h5>".$o_price_rice_thai_paddy_5[$i]->paddyType."</h5></td>
									</tr>";
					$o_price_rice_thai_paddy_data_5=$dao_price_rice_thai_paddy_data->selectAllByPaddyID($o_price_rice_thai_paddy_5[$i]->paddyID);
					for($j=0;$j<count($o_price_rice_thai_paddy_data_5);$j++)
					{
						$stringtable_1.="<tr>
											<td>".$o_price_rice_thai_paddy_data_5[$j]->data1."</td>
											<td>".$o_price_rice_thai_paddy_data_5[$j]->data2."</td>
											<td>".$o_price_rice_thai_paddy_data_5[$j]->data3."</td>
											<td>".$o_price_rice_thai_paddy_data_5[$j]->data4."</td>
											<td>".$o_price_rice_thai_paddy_data_5[$j]->data5."</td>
											<td>".$o_price_rice_thai_paddy_data_5[$j]->data6."</td>
											<td>".$o_price_rice_thai_paddy_data_5[$j]->data7."</td>
											<td>".$o_price_rice_thai_paddy_data_5[$j]->data8."</td>
										</tr>";
					}
				}
				$stringtable_1.="</tbody>";
				$stringtable_1.="</table>";
				$stringtable_1.="</p>";
				$stringtable_1.="<hr />";
				$pn_data->append($stringtable_1);

				//
				$o_price_rice_thai_6=$dao_price_rice_thai->selectAllByTypeLimit("6","1");

				
				$o_price_rice_thai_paddy_6=$dao_price_rice_thai_paddy->selectAllByThaiID($o_price_rice_thai_6[0]->thaiID,"6");

				$stringtable_1="<p>";
				$stringtable_1.="<h4 class='title'>ราคาขายส่งตลาดกรุงเทพฯ (กรมการค้าภายใน)</h4>";
				$stringtable_1.="<h5 class='title'>ข้อมูล ณ วันที่ : ".$o_price_rice_thai_6[0]->thaiDate."</h5>";
				$stringtable_1.="<table class='table table-striped'>";
				$stringtable_1.="<thead>
									<tr>
										<th>ชนิดข้าวสาร</th>
										<th>สัปดาห์ก่อน ต่ำ-สูง</th>
										<th>จันทร์</th>
										<th>อังคาร</th>
										<th>พุธ</th>
										<th>พฤหัสบดี</th>
										<th>ศุกร์</th>
										<th>สัปดาห์นี้ ต่ำ-สูง</th>
									</tr>
								</thead>";
				$stringtable_1.="<tbody>";
				for($i=0;$i<count($o_price_rice_thai_paddy_6);$i++)
				{
					$stringtable_1.="<tr>
										<td colspan='8'><h5>".$o_price_rice_thai_paddy_6[$i]->paddyType."</h5></td>
									</tr>";
					$o_price_rice_thai_paddy_data_6=$dao_price_rice_thai_paddy_data->selectAllByPaddyID($o_price_rice_thai_paddy_6[$i]->paddyID);
					for($j=0;$j<count($o_price_rice_thai_paddy_data_6);$j++)
					{
						$stringtable_1.="<tr>
											<td>".$o_price_rice_thai_paddy_data_6[$j]->data1."</td>
											<td>".$o_price_rice_thai_paddy_data_6[$j]->data2."</td>
											<td>".$o_price_rice_thai_paddy_data_6[$j]->data3."</td>
											<td>".$o_price_rice_thai_paddy_data_6[$j]->data4."</td>
											<td>".$o_price_rice_thai_paddy_data_6[$j]->data5."</td>
											<td>".$o_price_rice_thai_paddy_data_6[$j]->data6."</td>
											<td>".$o_price_rice_thai_paddy_data_6[$j]->data7."</td>
											<td>".$o_price_rice_thai_paddy_data_6[$j]->data8."</td>
										</tr>";
					}
				}
				$stringtable_1.="</tbody>";
				$stringtable_1.="</table>";
				$stringtable_1.="</p>";
				$stringtable_1.="<hr />";
				$pn_data->append($stringtable_1);

				//
				$o_price_rice_thai_7=$dao_price_rice_thai->selectAllByTypeLimit("7","1");

				
				$o_price_rice_thai_paddy_7=$dao_price_rice_thai_paddy->selectAllByThaiID($o_price_rice_thai_7[0]->thaiID,"7");

				$stringtable_1="<p>";
				$stringtable_1.="<h4 class='title'>ราคาข้าวสารของสมาคมโรงสีข้าวไทย (สมาคมโรงสีข้าวไทย)</h4>";
				$stringtable_1.="<h5 class='title'>ข้อมูล ณ วันที่ : ".$o_price_rice_thai_7[0]->thaiDate."</h5>";
				$stringtable_1.="<table class='table table-striped'>";
				$stringtable_1.="<thead>
									<tr>
										<th>ชนิดข้าว/เดือน</th>
										<th>ม.ค.</th>
										<th>ก.พ.</th>
										<th>มี.ค.</th>
										<th>เม.ย.</th>
										<th>พ.ค.</th>
										<th>มิ.ย.</th>
										<th>ก.ค.</th>
										<th>ส.ค.</th>
										<th>ก.ย.</th>
										<th>ต.ค.</th>
										<th>พ.ย.</th>
										<th>ธ.ค.</th>
										<th>เฉลี่ย</th>
									</tr>
								</thead>";
				$stringtable_1.="<tbody>";
				for($i=0;$i<count($o_price_rice_thai_paddy_7);$i++)
				{
					$stringtable_1.="<tr>
										<td colspan='14'><h5>".$o_price_rice_thai_paddy_7[$i]->paddyType."</h5></td>
									</tr>";
					$o_price_rice_thai_paddy_data_7=$dao_price_rice_thai_paddy_data->selectAllByPaddyID($o_price_rice_thai_paddy_7[$i]->paddyID);
					for($j=0;$j<count($o_price_rice_thai_paddy_data_7);$j++)
					{
						$stringtable_1.="<tr>
											<td>".$o_price_rice_thai_paddy_data_7[$j]->data1."</td>
											<td>".$o_price_rice_thai_paddy_data_7[$j]->data2."</td>
											<td>".$o_price_rice_thai_paddy_data_7[$j]->data3."</td>
											<td>".$o_price_rice_thai_paddy_data_7[$j]->data4."</td>
											<td>".$o_price_rice_thai_paddy_data_7[$j]->data5."</td>
											<td>".$o_price_rice_thai_paddy_data_7[$j]->data6."</td>
											<td>".$o_price_rice_thai_paddy_data_7[$j]->data7."</td>
											<td>".$o_price_rice_thai_paddy_data_7[$j]->data8."</td>
											<td>".$o_price_rice_thai_paddy_data_7[$j]->data9."</td>
											<td>".$o_price_rice_thai_paddy_data_7[$j]->data10."</td>
											<td>".$o_price_rice_thai_paddy_data_7[$j]->data11."</td>
											<td>".$o_price_rice_thai_paddy_data_7[$j]->data12."</td>
											<td>".$o_price_rice_thai_paddy_data_7[$j]->data13."</td>
											<td>".$o_price_rice_thai_paddy_data_7[$j]->data14."</td>
										</tr>";
					}
				}
				$stringtable_1.="</tbody>";
				$stringtable_1.="</table>";
				$stringtable_1.="</p>";
				$stringtable_1.="<hr />";
				$pn_data->append($stringtable_1);

				//
				$o_price_rice_thai_8=$dao_price_rice_thai->selectAllByTypeLimit("8","1");

				
				$o_price_rice_thai_paddy_8=$dao_price_rice_thai_paddy->selectAllByThaiID($o_price_rice_thai_8[0]->thaiID,"8");

				$stringtable_1="<p>";
				$stringtable_1.="<h4 class='title'>ราคาข้าวตลาดกรุงเทพฯ (สมาคมค้าข้าวไทย)</h4>";
				$stringtable_1.="<h5 class='title'>ข้อมูล ณ วันที่ : ".$o_price_rice_thai_8[0]->thaiDate."</h5>";
				$stringtable_1.="<table class='table table-striped'>";
				$stringtable_1.="<thead>
									<tr>
										<th>ชนิดข้าว</th>
										<th>ราคากระสอบละ</th>
									</tr>
								</thead>";
				$stringtable_1.="<tbody>";
				for($i=0;$i<count($o_price_rice_thai_paddy_8);$i++)
				{
					$stringtable_1.="<tr>
										<td colspan='14'><h5>".$o_price_rice_thai_paddy_8[$i]->paddyType."</h5></td>
									</tr>";
					$o_price_rice_thai_paddy_data_8=$dao_price_rice_thai_paddy_data->selectAllByPaddyID($o_price_rice_thai_paddy_8[$i]->paddyID);
					for($j=0;$j<count($o_price_rice_thai_paddy_data_8);$j++)
					{
						$stringtable_1.="<tr>
											<td>".$o_price_rice_thai_paddy_data_8[$j]->data1."</td>
											<td>".$o_price_rice_thai_paddy_data_8[$j]->data2."</td>
										</tr>";
					}
				}
				$stringtable_1.="</tbody>";
				$stringtable_1.="</table>";
				$stringtable_1.="</p>";
				$stringtable_1.="<hr />";
				$pn_data->append($stringtable_1);

				//
				$o_price_rice_thai_9=$dao_price_rice_thai->selectAllByTypeLimit("9","1");

				
				$o_price_rice_thai_paddy_9=$dao_price_rice_thai_paddy->selectAllByThaiID($o_price_rice_thai_9[0]->thaiID,"9");

				$stringtable_1="<p>";
				$stringtable_1.="<h4 class='title'>ราคาข้าวถุง (สมาคมผู้ประกอบการข้าวถุงไทย)</h4>";
				$stringtable_1.="<h5 class='title'>ข้อมูล ณ วันที่ : ".$o_price_rice_thai_9[0]->thaiDate."</h5>";
				$stringtable_1.="<table class='table table-striped'>";
				$stringtable_1.="<thead>
									<tr>
										<th>ขนาด</th>
										<th>ราคา (บาท/ถุง)</th>
									</tr>
								</thead>";
				$stringtable_1.="<tbody>";
				for($i=0;$i<count($o_price_rice_thai_paddy_9);$i++)
				{
					$stringtable_1.="<tr>
										<td colspan='14'><h5>".$o_price_rice_thai_paddy_9[$i]->paddyType."</h5></td>
									</tr>";
					$o_price_rice_thai_paddy_data_9=$dao_price_rice_thai_paddy_data->selectAllByPaddyID($o_price_rice_thai_paddy_9[$i]->paddyID);
					for($j=0;$j<count($o_price_rice_thai_paddy_data_9);$j++)
					{
						$stringtable_1.="<tr>
											<td>".$o_price_rice_thai_paddy_data_9[$j]->data1."</td>
											<td>".$o_price_rice_thai_paddy_data_9[$j]->data2."</td>
										</tr>";
					}
				}
				$stringtable_1.="</tbody>";
				$stringtable_1.="</table>";
				$stringtable_1.="</p>";
				$stringtable_1.="<hr />";
				$pn_data->append($stringtable_1);

                $pn_data->append("
                </div>
				");
			}
		}
		$this->waitevent();
	}	
}

?>