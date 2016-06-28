<?php
	class TResets extends TControl
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
			$str= "<INPUT TYPE='reset' id='$this->id' NAME='$this->id' value='$this->values' $att $ev>";
			return $str;
		}
	}	
?>