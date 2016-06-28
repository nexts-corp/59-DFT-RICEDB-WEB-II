<?php
require_once("Project/common/module.php");
require_once("Project/bussiness/ModuleDao.php");

require_once("Project/common/submodule.php");
require_once("Project/bussiness/SubModuleDao.php");

require_once("Project/bussiness/UserTypeDao.php");
require_once("Project/common/usertype.php");

require_once("Project/bussiness/PermissDao.php");
require_once("Project/common/permiss.php");


class  ViewMenuBar extends TForm
 {
	 	
		function ViewMenuBar()
		{
			global $orm;
			global $ConfigPage;
			$this->Init("ViewMenuBar","MainMenu","",true);
					
					$p=new TPage();
					$p->set("UserInfo","","","",true,"","");
					$p->page="Login.UserInfo";
					$this->add($p);
				
					
					$pnmunubar=new TPanel();
					$pnmunubar->set("pnmunubar","","","",true,"","");
					$this->add($pnmunubar);

					if($_SESSION["Session_User_SuperID"])
					{
							$pnmunubar->append('
								<li>
									<a href="?page=Module.ShowModule">
										<i class="icon-folder-open"></i> Modules
									</a>
								</li>
								
								<li class="dropdown hidden-xs hidden-sm">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<i class="icon-cogs"></i> ตั้งค่าเว็บไซต์
										<i class="icon-caret-down small"></i>
									</a>
									<ul class="dropdown-menu">
										<li><a href="?page=Config_Page.frmConfigPage"><i class="icon-wrench"></i> จัดการเว็บไซต์</a></li>
										<li><a href="?page=Config_Page.frmAboutUs"><i class="icon-book"></i> จัดการเกี่ยวกับเรา</a></li>
										<li><a href="?page=Config_Page.frmContactUs"><i class="icon-envelope-alt"></i> จัดการติดต่อเรา</a></li>
										<li><a href="?page=Config_Page.ShowMenuBar"><i class="icon-list-ul"></i> จัดการเมนูบาร์</a></li>
									
										<li class="divider"></li>
									</ul>
								</li>
								<li class="dropdown hidden-xs hidden-sm">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<i class="icon-user-md"></i> จัดการผู้ใช้งาน
										<i class="icon-caret-down small"></i>
									</a>
									<ul class="dropdown-menu">
										<li><a href="?page=Register.ShowRegister"><i class="icon-user"></i> จัดการผู้ใช้งาน</a></li>
										<li><a href="?page=Register.ShowUserType"><i class="icon-group"></i> จัดการประเภทผู้ใช้งาน</a></li>
									</ul>
								</li>
							');
					}
				
			
			if($_SESSION["Session_User_UsertypeID"]=="2")
			{
				$pnmenu2=new TPanel();
				$pnmenu2->set("pnmenu2","","","",true,"","");
				$this->add($pnmenu2);

				$pnmenu2->append("
				<!--=== Project Switcher ===-->
				<div id='project-switcher' class='container project-switcher'>
					<div id='scrollbar'>
						<div class='handle'></div>
					</div>

					<div id='frame'>
						<ul class='project-list'>
							<li>
								<a href='?page=Plugin_Measure/ShowMeasureUser'>
									<span class='image'><i class='icon-desktop'></i></span>
									<span class='title'>มาตรการช่วยเหลือเกษตรกรผู้ปลูกข้าว</span>
								</a>
							</li>
							<li>
								<a href='?page=Plugin_Price_Rice_Thai/ShowPriceRiceThai1'>
									<span class='image'><i class='icon-desktop'></i></span>
									<span class='title'>ราคาข้าวเปลือกภูมิภาค</span>
								</a>
							</li>
							<li>
								<a href='?page=Plugin_Price_Rice_Thai/ShowPriceRiceThai5'>
									<span class='image'><i class='icon-desktop'></i></span>
									<span class='title'>ราคาขายปลีกกรุงเทพฯ</span>
								</a>
							</li>
							<li>
								<a href='?page=Plugin_Price_Rice_Thai/ShowPriceRiceThai6'>
									<span class='image'><i class='icon-desktop'></i></span>
									<span class='title'>ราคาขายส่งกรุงเทพฯ</span>
								</a>
							</li>
						</ul>
					</div> <!-- /#frame -->
				</div> <!-- /#project-switcher -->

				");
			}
			
			
						

			$this->waitevent();
		}

 }

?>