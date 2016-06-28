<?php

// require_once("./Project/bussiness/Config_Page_Menu_FooterDao.php");
// require_once("./Project/common/config_page_menu_footer.php");



class  ViewMenuFoot extends TForm
 {
	 	
		function ViewMenuFoot()
		{
			global $orm;
			global $ConfigPage;
			$this->Init("ViewMenuFoot","MainMenu","",true);

				
				$pn_f=new TPanel();
				$pn_f->set("pn_f","","","",true,"","");
				$this->add($pn_f);


				


		$pn=new TPanel();
		$pn->set("pn","","","",true,"","");
		$this->add($pn);

		

		

	   


				$this->waitevent();

		}

 }

?>