<?php
class  HomePage extends TForm
 {
	 	
	function HomePage()
	{
		global $orm;
		$this->Init("HomePage","MainPage","",true);

		if($_SESSION["Session_User_UsertypeID"]=="2")
		{
			$pn2=new TPanel();
			$pn2->set("pn2","","","",true,"","");
			$this->add($pn2);

			$pn2->append("
			<a href='?page=Plugin_Measure/ShowMeasureUser' class='btn btn-info btn-block'>มาตรการช่วยเหลือเกษตรกรผู้ปลูกข้าว</a>
			<a href='?page=Plugin_Price_Rice_Thai/ShowPriceRiceThai1' class='btn btn-info btn-block'>ราคาข้าวเปลือกภูมิภาค</a>
			<a href='?page=Plugin_Price_Rice_Thai/ShowPriceRiceThai5' class='btn btn-info btn-block'>ราคาขายปลีกกรุงเทพฯ</a>
			<a href='?page=Plugin_Price_Rice_Thai/ShowPriceRiceThai6' class='btn btn-info btn-block'>ราคาขายส่งกรุงเทพฯ</a>
				");
		}
		$this->waitevent();
	}
 }

?>