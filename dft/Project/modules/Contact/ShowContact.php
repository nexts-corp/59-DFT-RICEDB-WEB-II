<?php


class  ShowContact extends TForm
 {
	 	
		function ShowContact()
		{
			global $orm;
				$this->Init("ShowContact","Contact","",true);

		
			$this->waitevent();
		}
 }

?>