<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors',true);
require_once("framework/control/TControl.php");
require_once("framework/control/TForm.php");
require_once("framework/orm/ormdao.php");
require_once("framework/Library/Public.php");
require_once("framework/Library/Standard.php");
require_once("framework/configpage/config.php");

require_once("framework/ThirdParty/Classes/PHPExcel.php");
require_once("framework/ThirdParty/Classes/PHPExcel/IOFactory.php");

require_once("Project/bussiness/SubModuleDao.php");
require_once("Project/common/submodule.php");

require_once("Project/bussiness/PermissDao.php");
require_once("Project/common/permiss.php");

 class  index extends TForm
 {
	 public $my_var;
		function index()
		{
			global $orm;
			global $ConfigPage;
			global $_SESSION;

			
			
			if(array_key_exists("Session_User_UsertypeID",$_SESSION)  && $_SESSION["Session_User_UsertypeID"])
			{

				if($_SESSION["Session_User_UsertypeID"]=="1")
				{
					$this->Init("".$ConfigPage["Template"]."page","","",false);
				}
				else
				{
					$this->Init("".$ConfigPage["Template"]."pageuser","","",false);


				}

			}
			
			else
			{
				$this->Init("".$ConfigPage["Template"]."login","","",false);
			}
			

					$Style3Party=new TLabel();
					$Style3Party->set("Style3Party",$ConfigPage["Style"],"","",true,"","");
					$this->Add($Style3Party);

					//$JavaScriptPage=new TLabel();
					//$JavaScriptPage->set("JavaScriptPage",$ConfigPage["JavaScriptPage"],"","",true,"","");
					//$this->Add($JavaScriptPage);
					
				
					
					$TitleView=new TLabel();
					$TitleView->set("TitleView",$ConfigPage["Title"],"","",true,"","");
					$this->Add($TitleView);

					$DescriptionView=new TLabel();
					$DescriptionView->set("DescriptionView",$ConfigPage["Description"],"","",true,"","");
					$this->Add($DescriptionView);

					$KeywordsView=new TLabel();
					$KeywordsView->set("KeywordsView",$ConfigPage["Keywords"],"","",true,"","");
					$this->Add($KeywordsView);
			
					
					$ShortcutView=new TLabel();
					$ShortcutView->set("ShortcutView",$ConfigPage["Shortcut"],"","",true,"","");
					$this->Add($ShortcutView);

					$LogoView=new TLabel();
					$LogoView->set("LogoView",$ConfigPage["Logo"],"","",true,"","");
					$this->Add($LogoView);

					$ColorView=new TLabel();
					$ColorView->set("ColorView",$ConfigPage["Color"],"","",true,"","");
					$this->Add($ColorView);

					$GoogleAnalyticView=new TLabel();
					$GoogleAnalyticView->set("GoogleAnalyticView",$ConfigPage["GoogleAnalytic"],"","",true,"","");
					$this->Add($GoogleAnalyticView);
					
				


				if(!empty($_SESSION["Session_User_UserID"]))
					{
						$p=new TPage();
						$p->set("info","","","",true,"","");
						$p->page="Login.info";
						$this->add($p);
					}
				else
					{
						$p=new TPage();
						$p->set("Login","","","",true,"","");
						$p->page="Login.PageLogin";
						$this->add($p);
					}
					
					$newsalertcheck=$_COOKIE["newsalertcheck"];
					
					if($_SESSION["Session_User_UsertypeID"]=="1")
					{
						$p=new TPage();
						$p->set("menuleft","","","",true,"","");
						$p->page="MainMenu.ViewMenuLeft";
						$this->add($p);
					}
					


					$p=new TPage();
					$p->set("header","","","",true,"","");
					$p->page="MainMenu.ViewMenuBar";
					$this->add($p);

					$p=new TPage();
					$p->set("footer","","","",true,"","");
					$p->page="MainMenu.ViewMenuFoot";
					$this->add($p);
					

			$page=$this->getdata("page");


			/*
				if(empty($newsalertcheck) or empty($page))
			{
					$p=new TPage();
					$p->set("NewAlertView","","","",true,"","");
					$p->page="News.NewsAlert";
					$this->add($p);
			}
			*/
			if($page)
			{
				
				$_SESSION["PAGE"]=$page;
				
			}
			
			if(empty($page))
			{
				//header( 'Location:?page=MainPage.HomePage' ) ;
				$page="MainPage.HomePage";
			}

			$p=new TPage();
			$p->set("mains","","","",true,"","");
			$p->page=$page;
			$this->add($p);
		}
		
 }

		$index=new index();
		$index->show();

?> 
  
