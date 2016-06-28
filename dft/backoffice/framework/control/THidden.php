<?php
	class THidden extends TControl
	{
		//var $ID;
		//var $Value;
		var $size;
		var $max;
		var $enable;
		//var $Event_onChange;		
		function show()
		{
			$att=$this->addAttribute();
			$ev=$this->addEvent("this.value");
			$str="<INPUT TYPE='hidden' id='$this->id' name='$this->id' value='$this->values'>";
			return $str;
		}
	}	
?>