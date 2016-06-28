<?php
class TConfigPage extends TControl
{		
		function show()
		{
			global $ConfigPage;
			//$att=$this->addAttribute();
			//$ev=$this->addEvent("this.value");

			//echo $this->values."<br>";
			return $ConfigPage[$this->values];
		}
}	
?>