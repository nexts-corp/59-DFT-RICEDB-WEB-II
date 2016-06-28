<?php
//require_once("backend/Project/bussiness/Config_Page_Menu_FooterDao.php");
//require_once("backend/Project/common/config_page_menu_footer.php");

class  ViewMenuFoot extends TForm
 {
	 	
		function ViewMenuFoot()
		{
			global $orm;
			global $ConfigPage;
			$this->Init("ViewMenuFoot","MainMenu","",true);
					
			
			$this->waitevent();
		}

 }

?>