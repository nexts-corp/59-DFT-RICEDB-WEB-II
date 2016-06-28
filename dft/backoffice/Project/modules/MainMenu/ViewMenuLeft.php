<?php
require_once("Project/common/module.php");
require_once("Project/bussiness/ModuleDao.php");

require_once("Project/common/submodule.php");
require_once("Project/bussiness/SubModuleDao.php");

require_once("Project/bussiness/UserTypeDao.php");
require_once("Project/common/usertype.php");

require_once("Project/bussiness/PermissDao.php");
require_once("Project/common/permiss.php");

class  ViewMenuLeft extends TForm
 {
	 	
		function ViewMenuLeft()
		{
			global $orm;
			$this->Init("ViewMenuLeft","MainMenu","",true);
			
					$pn=new TPanel();
					$pn->set("pn","","","",true,"","");
					$this->add($pn);
					
					$dao=new ModuleDao();
					$dao_submodule=new SubModuleDao();
					$o=$dao->selectAllByOpenPosition("Left");
					
					$dao_per=new PermissDao();
					
					$page=$this->getdata("page");
						$chkeckpage=explode("/",$page);
					
			
					if($_SESSION["Session_User_SuperID"]=="1")
					{
						/*
							$pn->append("<li class='current open'>");
								$pn->append("<a href='javascript:void(0);'>
																สำหรับผู้ดูแลระบบ
															</a>
															");
									$pn->append("<ul class='sub-menu'>");
										if($chkeckpage[0]=="Module")
											$pn->append("<li class='current'><a href='?page=Module.ShowModule'>Module</a></li>");
										else
											$pn->append("<li><a href='?page=Module.ShowModule'>Module</a></li>");
							
									$pn->append("</ul>");
								$pn->append("</li>");


							
							if($chkeckpage[0]=="Config_Page")
								{	
									$pn->append("<li class='hasSubmenu active'>");
										$pn->append("<a data-toggle='collapse' class='glyphicons cogwheel' href='#configpage'><i></i><span>Config Page</span></a>");
											$pn->append("<ul class='collapse in' id='configpage'>");
								}
							else
								{
									$pn->append("<li class='hasSubmenu'>");
										$pn->append("<a data-toggle='collapse' class='glyphicons cogwheel' href='#configpage'><i></i><span>Config Page</span></a>");
											$pn->append("<ul class='collapse' id='configpage'>");
								}
												$pn->append("<li class=''><a href='?page=Config_Page.frmConfigPage'><i></i><span>โครงสร้างหน้าแรก</span></a></li>");
												$pn->append("<li class=''><a href='?page=Config_Page.ShowMenuBar'><i></i><span>จัดการเมนูบาร์</span></a></li>");
												$pn->append("<li class=''><a href='?page=Config_Page.ShowMenuFooter'><i></i><span>จัดการเมนูด้านล่าง</span></a></li>");
											$pn->append("</ul>");
									$pn->append("</li>");

								if($chkeckpage[0]=="Register")
								{	
									$pn->append("<li class='hasSubmenu active'>");
										$pn->append("<a data-toggle='collapse' class='glyphicons user' href='#user'><i></i><span>ผู้ใช้งานระบบ</span></a>");
											$pn->append("<ul class='collapse in' id='user'>");
								}
							else
								{
									$pn->append("<li class='hasSubmenu'>");
										$pn->append("<a data-toggle='collapse' class='glyphicons user' href='#user'><i></i><span>ผู้ใช้งานระบบ</span></a>");
											$pn->append("<ul class='collapse' id='user'>");
								}

												$pn->append("<li class=''><a href='?page=Register.ShowRegister'><i></i><span>จัดการผู้ใช้งาน</span></a></li>");
												$pn->append("<li class=''><a href='?page=Register.ShowUserType'><i></i><span>จัดการประเภทผู้ใช้งาน</span></a></li>");
											$pn->append("</ul>");
									$pn->append("</li>");
							$pn->append("</ul>");
							*/

					}
					
					

				
	
					for($i=0;$i<count($o);$i++)
						{
							
							$chkpermiss=permission($_SESSION["Session_User_UsertypeID"],$o[$i]->usertypeID);
							if($chkpermiss)
							{
										$o_submodule=$dao_submodule->selectAllByModuleView($o[$i]->moduleID);
										
										
											
											$textmenu="";
											$checkopen=false;
											for($j=0;$j<count($o_submodule);$j++)
												{
													
													$dbcheckpage=explode("/",$o_submodule[$j]->submoduleUrl);

													$o_per=$dao_per->selectAllBySubModuleUser($o_submodule[$j]->submoduleID,$_SESSION["Session_User_UsertypeID"]);
														if($o_per[0]->permissView=="false")
														{
																	
														}
														else
														{			
																	if($dbcheckpage[0]==$chkeckpage[0])
															{
																	$textmenu.="<li class='current'><a href=?page=".$o_submodule[$j]->submoduleUrl.">".$o_submodule[$j]->submoduleName."</a></li>";
																	$checkopen=true;
															}
															else
															{
																	$textmenu.="<li><a href=?page=".$o_submodule[$j]->submoduleUrl.">".$o_submodule[$j]->submoduleName."</a></li>";
															}
														

														}
												}
										if($checkopen)
								{
										$pn->append("<li class='current open'>");
										$pn->append("<a href='javascript:void(0);'>
																         ".$o[$i]->moduleName."
																	  </a>
															");
											$pn->append("<ul class='sub-menu'>");
													$pn->append($textmenu);
											$pn->append("</ul>");
										$pn->append("</li>");
								}
								else
								{
										$pn->append("<li>");
										$pn->append("<a href='javascript:void(0);'>
																		".$o[$i]->moduleName."
																	  </a>
															");
											$pn->append("<ul class='sub-menu'>");
													$pn->append($textmenu);
											$pn->append("</ul>");
										$pn->append("</li>");
								}

							}
						}

			$this->waitevent();
		}

 }

?>