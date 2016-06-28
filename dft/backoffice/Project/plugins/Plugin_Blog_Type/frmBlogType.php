<?php
require_once("Project/plugins/Plugin_Blog_Type/Dao/Plugin_Blog_TypeDao.php");
require_once("Project/plugins/Plugin_Blog_Type/Common/plugin_blog_type.php");

 class frmBlogType extends TForm
 {
	 	
		function frmBlogType()
		{
			$dao_submodule=new SubModuleDao();
				$o_submodule=$dao_submodule->selectAllBySystem("plugin_blog_type");

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
				$this->Init("frmBlogType","Plugin_Blog_Type","form-horizontal row-border",true);
			
			$obj=$this->getdata("object_id");
			
			$dao=new Plugin_Blog_TypeDao();
			$o=$dao->selectById($obj);
			
			$form=new THidden();
			$form->set('blogtypeID',$o->blogtypeID,30,30,true,"String",false); 
			$this->add($form);

			$version=new THidden();
			$version->set('version',$o->version,30,30,true,"String",false); 
			$this->add($version);
			
			$form=new TTextBox();
			$form->set('blogtypeName',$o->blogtypeName,"","",true,"String",true); 
			$form->setAttribute("class","form-control input-width-xxlarge");
			$form->setAttribute("placeholder","ประเภทบทความ");
			$this->add($form);

			$form=new TInputfile();
			$form->set('blogtypeImg',$o->blogtypeImg,30,30,true,"String",false);
			$this->add($form);

			if($o->blogtypeImg)
				{
						$form=new TLabel();
						$form->set('blogtypeImgView',"<img src=".$o->blogtypeImg.">",30,30,true,"String",true);
						$this->add($form);
				}

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
				$o=new plugin_blog_type();
				$o->blogtypeID=$sender->getvalue('blogtypeID');
				$o->version=$sender->getvalue('version');
				$o->blogtypeName=$sender->getvalue('blogtypeName');

				$o->status=$sender->getvalue('status');
				$o->creationUser=$_SESSION["Session_User_UserID"];

				$userfile=$sender->getvalue('blogtypeImg');
			
					$Datef=Date("d-m-y");
					$Timef=Date("H-i-s");
					$Datef=ereg_replace("-","",$Datef);
					$Timef=ereg_replace("-","",$Timef); 
					$Fname="fileimg_".$Datef."_".$Timef;

				$o->blogtypeImg=uploadFileTwo(0,"./Upload/Img",$Fname,$userfile);
				
				$dao=new Plugin_Blog_TypeDao();

				if($o->blogtypeID)
			{
				$dao->update($o);
				
				
				Refreshs("Plugin_Blog_Type/ShowBlogType","alert","update");
			}
				else
			{
				$dao->save($o);
				Refreshs("Plugin_Blog_Type/ShowBlogType","alert","save");
					
			}
		}
 }

?>