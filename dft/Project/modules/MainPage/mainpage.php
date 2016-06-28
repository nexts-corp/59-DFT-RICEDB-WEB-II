<?php

class  mainpage extends TForm
{

	function mainpage()
	{
		global $orm;
		global $ConfigPage;
		$this->Init("mainpage","MainPage","",true);


		$this->waitevent();
	}
}

?>
