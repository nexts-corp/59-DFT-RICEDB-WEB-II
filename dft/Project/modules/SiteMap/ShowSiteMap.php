<?php

require_once("./Project/bussiness/Config_Page_Menu_BarDao.php");
require_once("./Project/common/config_page_menu_bar.php");

require_once("./Project/bussiness/Config_Page_Menu_Bar_SubDao.php");
require_once("./Project/common/config_page_menu_bar_sub.php");


class  ShowSiteMap extends TForm
 {
	 	
		function ShowSiteMap()
		{
			global $orm;
			global $ConfigPage;
			$this->Init("ShowSiteMap","SiteMap","",true);
				
			$page=$this->getdata("page");

		
			 	$dao = new Config_Page_Menu_BarDao();
				$o=$dao->selectAllOpen();



			$dao_SubMenu=new Config_Page_Menu_Bar_SubDao();

				$pn=new TPanel();
				$pn->set("pn","","","",true,"","");
				$this->add($pn);



				for($i=0;$i<count($o);$i++)
				{
						$menubarID=$o[$i]->menubarID;
						
						if($o[$i]->menubarType =="Linkout"){
						
						$pn->append( '<li><a href="'.$o[$i]->menubarLink.'" >'.$o[$i]->menubarName.'</a></li>');

						}elseif($o[$i]->menubarType=="Linkin"){

							$pn->append ('<li><a href="?page=ViewMenu.frmViewMenu&menubarID='.$o[$i]->menubarID.'" >'.$o[$i]->menubarName.'</a></li>');

						}elseif($o[$i]->menubarType=="SubMenu"){

						$pn->append('<li class="dropdown"><a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">'.$o[$i]->menubarName.'</a> <ul class="dropdown-menu">');

						$o_D=$dao_SubMenu->selectAllByMenuBar($o[$i]->menubarID);

						for($j=0;$j<count($o_D);$j++){
						
					if($o_D[$j]->menubarsubType =="Linkout"){
						$pn->append( '<li><a href="'.$o_D[$j]->menubarsubLink.'" style="color:#fff" >'.$o_D[$j]->menubarsubName.'</a></li>');

						}elseif($o_D[$j]->menubarsubType=="Linkin"){
					
						$pn->append('<li><a href="?page=ViewSubMenu.frmViewSub&menubarsubID='.$o_D[$j]->menubarsubID.'" style="color:#fff"  >'.$o_D[$j]->menubarsubName.'</a></li>');

						}

						}

						$pn->append('
						</ul>
                </li>');
						
						
						}
					
						
						

				}

		
			
			$this->waitevent();
		}
		

 }

?>