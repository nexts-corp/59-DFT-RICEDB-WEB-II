<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
require_once ("framework/control/TControl.php");
require_once ("framework/control/TForm.php");
require_once("framework/orm/ormdao.php");
require_once("framework/Library/Public.php");
require_once("framework/Library/Standard.php");
require_once("framework/configpage/config.php");
require_once("framework/Library/Email.php");

 class  index extends TForm
 {
	 public $my_var;
		function index()
		{
			global $orm;
			global $ConfigPage;


				 $this->Init("".$ConfigPage["Template"]."page","","",false);

					$Style3Party=new TLabel();
					$Style3Party->set("Style3Party",$ConfigPage["Style"],"","",true,"","");
					$this->Add($Style3Party);

					$JavaScriptPage=new TLabel();
					$JavaScriptPage->set("JavaScriptPage",$ConfigPage["JavaScriptPage"],"","",true,"","");
					$this->Add($JavaScriptPage);

					$Style=new TLabel();
					$Style->set("Style",$ConfigPage["Style"],"","",true,"","");
					$this->Add($Style);

					$p=new TPage();
					$p->set("header","","","",true,"","");
					$p->page="MainMenu.ViewMenuBar";
					$this->add($p);


					$p=new TPage();
					$p->set("footer","","","",true,"","");
					$p->page="MainMenu.ViewMenuFoot";
					$this->add($p);


			$page=$this->getdata("page");

			if(empty($page) or $page=="MainPage.HomePage")
			{
				$checkhome=new TLabel();
				$checkhome->set("checkhome","home","","",true,"","");
				$this->Add($checkhome);
			}

			if($page)
			{

				$_SESSION["PAGE"]=$page;

			}

			if(empty($page))
			{
				$page="MainPage.mainpage";
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
