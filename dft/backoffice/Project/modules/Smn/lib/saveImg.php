<?php
require_once("Project/module/Smn/Dao/Multi_MediaDao.php");
require_once("Project/module/Smn/Common/media_multi.php");

		function multi_img($parameter)
		{

				$o=new media_multi();
				$o->multiId="";
				$o->version="";
				$o->multiUrl=$parameter;

				$o->status="Open";
				$o->creationUser=$_SESSION["Session_User_UserID"];

				$dao=new Multi_MediaDao();
				$dao->save($o);
				
		}


?>