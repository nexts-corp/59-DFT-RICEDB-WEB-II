<?php
	class TRadio extends TControl
	{
		//var $ID;
		//var $Value;
		var $size;
		var $max;
		var $enable;
		//var $Event_onChange;	
		var $item;
		function additem($values,$Display)
		{
				$n=count($this->item);
				//echo $values;
				$this->item[$n]["values"]=$values;
				$this->item[$n]["display"]=$Display;
				//echo $this->item[0]["values"];
		}
		function additems($item)
		{
			$this->item=$item;
		}
		function addobjects($objects,$fieldvalus,$fieldname)
		{
			$n=count($objects);
			for($i=0;$i<$n;$i++)
			{
				$this->item[$i]["values"]=$objects[$i]->$fieldvalus;
				$this->item[$i]["display"]=$objects[$i]->$fieldname;

			}
		}
		function show()
		{
			$att=$this->addAttribute();
			$ev=$this->addEvent("this.value");
			$n=count($this->item);
			$str="";
			//echo $n;
			for($i=0;$i<$n;$i++)
			{
				$v=$this->item[$i]["values"];
				$d=$this->item[$i]["display"];
				$str=$str."<label class='radio'>";
				if($v==$this->values)
					$str=$str."<INPUT TYPE='radio' ID='$this->id' NAME='$this->id' value='$v' checked $att $ev>&nbsp;<span style='margin-left:50px'>$d</span><br>";
				else
						$str=$str."<INPUT TYPE='radio' ID='$this->id' NAME='$this->id' value='$v' $att $ev>&nbsp;<span style='margin-left:50px'>$d</span><br>";
				$str=$str."</label>";
				$str=$str."<div style='clear:both'></div>";
			}
			//echo $str;
			//	$html="<table>";
		//	$html.="<tr><td>";
			$html.=$str;
			$vname="Y";
             if($this->validate==false)
                   $vname="N";
              $vname="VALIDATE_".$vname."_TB_".$this->formname."_".$this->id;
				
			//$html.="</td>";
			$html.="<span id='".$vname."'></span>";
			//$html.="<td><span id='".$vname."'></span></td></tr></table>";
			return $html;
			//return $str;
		}
	}	
?>