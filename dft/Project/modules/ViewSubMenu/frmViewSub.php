<?php

require_once("./Project/bussiness/Config_Page_Menu_Bar_SubDao.php");
require_once("./Project/common/config_page_menu_bar_sub.php");

class frmViewSub extends TForm
	{
		function frmViewSub()
		{
			global $ConfigPage;
			$this->Init("frmViewSub","ViewSubMenu","",true);
			
				$menubarsubID=$this->getdata("menubarsubID");
				
			

				 $dao = new Config_Page_Menu_Bar_SubDao();
				 $o=$dao->selectById($menubarsubID);
				
				$pn=new TPanel();
				$pn->set("pn","","","",true,"","");
				$this->add($pn);
				


				$pn->append('

				                            <div class="widget-main-title">

				<h4 class="widget-title">'.$o->menubarsubName.'</h4>

				</div>
                            <p>'.$o->menubarsubDetail.'</p>


				');

				$pn_bar=new TPanel();
				$pn_bar->set("pn_bar","","","",true,"","");
				$this->add($pn_bar);
				
			$pn_bar->append('



		<h6><span class="page-active">'.$o->menubarsubName.'</span></h6>



				');

			$this->waitevent();

		}
	}



?>