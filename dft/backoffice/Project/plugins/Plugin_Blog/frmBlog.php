<?php
require_once("Project/plugins/Plugin_Blog/Dao/Plugin_BlogDao.php");
require_once("Project/plugins/Plugin_Blog/Common/plugin_blog.php");

require_once("Project/plugins/Plugin_Blog_Type/Dao/Plugin_Blog_TypeDao.php");
require_once("Project/plugins/Plugin_Blog_Type/Common/plugin_blog_type.php");

require_once("Project/plugins/Plugin_Blog/Dao/Plugin_HistoryDao.php");
require_once("Project/plugins/Plugin_Blog/Common/plugin_history.php");

 class frmBlog extends TForm
 {
	 	
		function frmBlog()
		{
			$dao_submodule=new SubModuleDao();
				$o_submodule=$dao_submodule->selectAllBySystem("plugin_blog");

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
				
			if($o_per[0]->permissAdd=="true")
				$this->Init("frmBlog","Plugin_Blog","form-horizontal row-border",true);
			
			$obj=$this->getdata("object_id");
			
			$dao=new Plugin_BlogDao();
			$o=$dao->selectById($obj);
			
			$form=new THidden();
			$form->set('blogID',$o->blogID,30,30,true,"String",false); 
			$this->add($form);

			$version=new THidden();
			$version->set('version',$o->version,30,30,true,"String",false); 
			$this->add($version);

			
			
			$form=new TListBox();
			$form->set('blogtypeID',$o->blogtypeID,"","",true,"String",true); 
				
				$dao_blog_type=new Plugin_Blog_TypeDao();
				$o_blog_type=$dao_blog_type->selectAllByOpen();

				$form->addobjects($o_blog_type,"blogtypeID","blogtypeName");

			$form->setAttribute("class","form-control");
			$this->add($form);

			$form=new TTextBox();
			$form->set('blogName',$o->blogName,"","",true,"String",true); 
			$form->setAttribute("class","form-control input-width-xxlarge");
			$form->setAttribute("placeholder","หัวข้อบทความ");
			$this->add($form);

			$blogDetails=htmlspecialchars($o->blogDetail);

			$form=new TSummereditor();
			$form->set('blogDetail',$blogDetails,"","",true,"String",true);
			$this->add($form);
			
			$form=new TTextBox();
			$form->set('blogTag',$o->blogTag,"","",true,"String",true); 
			$form->setAttribute("class","form-control tags");
			$this->add($form);

			$form=new TInputfile();
			$form->set('blogImg',$o->blogImg,"","",true,"String",false);
			$this->add($form);

			$form=new TListBox();
			$form->set('status',$o->status,"","",true,"String",true); 
			$form->additem("Open","เปิดการใช้งาน");
			$form->additem("Close","ปิดการใช้งาน");
			$form->setAttribute("class","form-control");
			$this->add($form);
			
			
			$bn=new TButton();
			$bn->set("bn","บันทึกข้อมูล","","",true,"String",true);
			$bn->setEvent("onclick","frmAction");
			$bn->setAttribute("class","btn btn-primary");
			$this->Add($bn);

			$bnreset=new TResets();
			$bnreset->set("bnreset","ล้างข้อมูล","","",true,"String",true);
			$bnreset->setAttribute("class","btn");
			$this->Add($bnreset);

			$this->waitevent();
		}
		function frmAction($parameter,$sender)
		{
				$o=new plugin_blog();
				$o->blogID=$sender->getvalue('blogID');
				$o->version=$sender->getvalue('version');
				$o->blogtypeID=$sender->getvalue('blogtypeID');
				$o->blogName=$sender->getvalue('blogName');
				$blogDetail=str_replace("'", "\'", $sender->getvalue('blogDetail'));
				$o->blogDetail=$blogDetail;

				$o->blogTag=$sender->getvalue('blogTag');

					$userfile=$sender->getvalue('blogImg');
					$Datef=Date("d-m-y");
					$Timef=Date("H-i-s");
					$Datef=ereg_replace("-","",$Datef);
					$Timef=ereg_replace("-","",$Timef); 
					$Fname="fileimg_".$Datef."_".$Timef;

				$o->blogImg=uploadFileTwo(0,"./Upload/Img",$Fname,$userfile);


				$o->status=$sender->getvalue('status');
				$o->creationUser=$_SESSION["Session_User_UserID"];
				
				$dao=new Plugin_BlogDao();

				if($o->blogID)
			{
				$dao->update($o);
				Refreshs("Plugin_Blog/ShowBlog","alert","update");
			}
				else
			{

				$dao->save($o);


				$dao_h=new Plugin_HistoryDao();
				$o_h=new plugin_history();
				$o_h->historyID=$o_h->historyID;
				$o_h->plugin_ID=$o->blogID;
				$o_h->plugin_Name="blogID";
				$o_h->totalUser="1";
				$o_h->version="";
				$o_h->creationUser="1";
				$o_h->status="Open";
				$dao_h->save($o_h);
				


				Refreshs("Plugin_Blog/ShowBlog","alert","save");
					
			}
		}
 }

?>