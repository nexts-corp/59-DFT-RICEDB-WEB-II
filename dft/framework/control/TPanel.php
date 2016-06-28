<?php
	class TPanel extends TControl
	{
		//var $ID;
		//var $Value;
	//	var $size;
		//var $max;
		//var $enable;
		//var $Event_onChange;		
		var $html;
		//var $pagename;
		function append($html)
		{
			$this->html=$this->html."".$html;
		}
		function show()
		{
			//$p=explode(".",$this->page);
			//include("Project/modules/".$p[0]."/".$p[1].".php");
			//$f=new $p[1];
			//$html=$f->show2();
			//$att=$this->addAttribute();
			//$ev=$this->addEvent("this.value");
			//return "<INPUT TYPE='Button' id='$this->id' NAME='$this->id' value='$this->values' $att $ev>";
			return $this->html;
		}
	}	
?>