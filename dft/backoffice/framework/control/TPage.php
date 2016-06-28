<?php
	class TPage extends TControl
	{
		//var $ID;
		//var $Value;
	//	var $size;
		//var $max;
		//var $enable;
		//var $Event_onChange;		
		var $page;
		//var $pagename;
		function show()
		{

			$p=explode(".",$this->page);
			$plugin=explode("/",$this->page);
			if($p)
			{
				
				$fn="Project/modules/".$p[0]."/".$p[1].".php";
					if(file_exists($fn))
					{
						include($fn);
						$f=new $p[1];
						$html=$f->show2();
						//echo $html;
						//$att=$this->addAttribute();
						//$ev=$this->addEvent("this.value");
						//return "<INPUT TYPE='Button' id='$this->id' NAME='$this->id' value='$this->values' $att $ev>";
					}
			}
			if($plugin)
			{
				$fn="Project/plugins/".$plugin[0]."/".$plugin[1].".php";
					if(file_exists($fn))
					{
						include($fn);
						$f=new $plugin[1];
						$html=$f->show3();
					}
			}
			return $html;
		}
	}	
?>