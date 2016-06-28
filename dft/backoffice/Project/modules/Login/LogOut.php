<?php
//require_once("Project/common/user.php");
//require_once("Project/bussiness/UserDao.php");
class  LogOut extends TForm
 {
	 	
		function LogOut()
		{
			global $orm;
			$this->Init("LogOut","Login","",true);
				session_destroy();
				fRefresh("","page","MainPage.HomePage");

			$this->waitevent();
		}

 }

?>