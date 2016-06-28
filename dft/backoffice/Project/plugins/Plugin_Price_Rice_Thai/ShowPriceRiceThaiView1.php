<?php
require_once("Project/plugins/Plugin_Price_Rice_Thai/Dao/Plugin_Price_Rice_ThaiDao.php");
require_once("Project/plugins/Plugin_Price_Rice_Thai/Common/plugin_price_rice_thai.php");

require_once("Project/plugins/Plugin_Price_Rice_Thai/Dao/Plugin_Price_Rice_Thai_PaddyDao.php");
require_once("Project/plugins/Plugin_Price_Rice_Thai/Common/plugin_price_rice_thai_paddy.php");

require_once("Project/plugins/Plugin_Price_Rice_Thai/Dao/Plugin_Price_Rice_Thai_Paddy_DataDao.php");
require_once("Project/plugins/Plugin_Price_Rice_Thai/Common/plugin_price_rice_thai_paddy_data.php");

class  ShowPriceRiceThaiView1 extends TForm
{
	public static $Grid1;
	function ShowPriceRiceThaiView1()
	{
		$dao_submodule=new SubModuleDao();
			$o_submodule=$dao_submodule->selectAllBySystem("plugin_price_rice_thai");

		$form=new TLabel();
		$form->set("submoduleName",$o_submodule[0]->submoduleName,"","",true,"","");
		$this->add($form);

		$form=new TLabel();
		$form->set("submoduleDetail",$o_submodule[0]->submoduleDetail,"","",true,"","");
		$this->add($form);

		$form=new TLabel();
		$form->set("submoduleUrl",$o_submodule[0]->submoduleUrl,"","",true,"","");
		$this->add($form);

		$dao_per=new PermissDao();
			$o_per=$dao_per->selectAllByPermiss($o_submodule[0]->submoduleID,$_SESSION["Session_User_UsertypeID"]);
		
		if($o_per[0]->permissView=="true" or $_SESSION["Session_User_UsertypeID"]=="2")
			$this->Init("ShowPriceRiceThaiView1","Plugin_Price_Rice_Thai","form-horizontal row-border",true);
				
			$thaiID=$this->getdata("thaiID");

			$dao_price_rice_thai=new Plugin_Price_Rice_ThaiDao();
				$o_price_rice_thai=$dao_price_rice_thai->selectById($thaiID);

			if($o_price_rice_thai)
			{

				$form=new THidden();
				$form->set("thaiID",$o_price_rice_thai->thaiID,"","",true,"","");
				$this->add($form);

				$form=new TLabel();
				$form->set("thaiDate",$o_price_rice_thai->thaiDate,"","",true,"","");
				$this->add($form);
			}
			
			
			$dao_price_thai_paddy=new Plugin_Price_Rice_Thai_PaddyDao();
        	$dao_price_thai_paddy_data=new Plugin_Price_Rice_Thai_Paddy_DataDao();

        	

        	$pn=new TPanel();
			$pn->set("pn","","","",true,"","");
			$this->add($pn);

			$pn->append("
			<table class='table table-hover table-striped table-bordered table-highlight-head'>
			<thead>
				<tr>
					<th>ชนิดข้าวเปลือก</th>
					<th>จังหวัด</th>
					<th>สัปดาห์ก่อน ต่ำ-สูง</th>
					<th>จันทร์</th>
					<th>อังคาร</th>
					<th>พุธ</th>
					<th>พฤหัสบดี</th>
					<th>ศุกร์</th>
					<th>สัปดาห์นี้ ต่ำ-สูง</th>
				</tr>
			</thead>
			<tbody>
				");

			$o_price_thai_paddy=$dao_price_thai_paddy->selectAllByThaiID($thaiID,"1");
			for($i=0;$i<count($o_price_thai_paddy);$i++)
			{
				$pn->append("
				<tr>
					<td colspan='9'>".$o_price_thai_paddy[$i]->paddyType."</td>
				</tr>

				");

				$o_price_thai_paddy_data=$dao_price_thai_paddy_data->selectAllByPaddyID($o_price_thai_paddy[$i]->paddyID,"1");
				for($j=0;$j<count($o_price_thai_paddy_data);$j++)
				{
					$pn->append("
					<tr>
						<td></td>
						<td>".$o_price_thai_paddy_data[$j]->data1."</td>
						<td>".$o_price_thai_paddy_data[$j]->data2."</td>
						<td>".$o_price_thai_paddy_data[$j]->data3."</td>
						<td>".$o_price_thai_paddy_data[$j]->data4."</td>
						<td>".$o_price_thai_paddy_data[$j]->data5."</td>
						<td>".$o_price_thai_paddy_data[$j]->data6."</td>
						<td>".$o_price_thai_paddy_data[$j]->data7."</td>
						<td>".$o_price_thai_paddy_data[$j]->data8."</td>
					</tr>

					");
				}
				
			}
			
			$pn->append("
			</tbody>
		</table>
			");

			

	 	$this->waitevent();
	}
	
		
}
?>