<?php
class TLabel extends TControl
{		
		function show()
		{
			$att=$this->addAttribute();
			$ev=$this->addEvent("this.value");

			return "$this->values";
		}
}	
class TLabelnumber_format extends TControl
{		
		function show()
		{
			$att=$this->addAttribute();
			$ev=$this->addEvent("this.value");

			return number_format($this->values,2);
		}
}	
?>