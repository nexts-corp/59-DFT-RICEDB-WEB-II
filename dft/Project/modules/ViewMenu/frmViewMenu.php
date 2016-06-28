<?php
require_once("./Project/bussiness/Config_Page_Menu_BarDao.php");
require_once("./Project/common/config_page_menu_bar.php");

class frmViewMenu extends TForm
	{
		function frmViewMenu()
		{
			global $ConfigPage;
			$this->Init("frmViewMenu","ViewMenu","",true);
			
				$menubarID=$this->getdata("menubarID");

				 $dao = new Config_Page_Menu_BarDao();
				 $o=$dao->selectById($menubarID);
			
				$pn=new TPanel();
				$pn->set("pn","","","",true,"","");
				$this->add($pn);

			$menubarDetail=str_replace("Upload","backend/Upload", $o->menubarDetail);
				
			$img=str_replace("<img","<img class='img-responsive'",$menubarDetail,$x);

				$pn->append('

				                            <div class="widget-main-title">
				                            <div class="headline headline-md">
							<h4 class="widget-title">'.$o->menubarName.' </h4>
	            </div>

			

				</div>

                            <p>'.$img.'</p>


				');
				
				$pn_bar=new TPanel();
				$pn_bar->set("pn_bar","","","",true,"","");
				$this->add($pn_bar);
				
			$pn_bar->append('



		 <li><a href="?page=MainPage.HomePage">หน้าแรก</a></li>
  	<li class="active"><a href="#">'.$o->menubarName.'</a></li>



				');
	

			$this->waitevent();

		}
	}



?>