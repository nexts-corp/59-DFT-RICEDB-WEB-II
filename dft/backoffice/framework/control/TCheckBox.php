<?php
	class TCheckBox extends TControl
	{
		//var $ID;
		//var $value;
		var $size;
		var $max;
		var $enable;
		var $Event_onChange;		
		var $item;
		function additem($values,$Display)
		{
				$n=count($this->item);
				$this->item[$n]["values"]=$values;
				$this->item[$n]["display"]=$Display;
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
			$cv=explode(",",$this->values);
			for($i=0;$i<$n;$i++)
			{
				$v=$this->item[$i]["values"];
				$d=$this->item[$i]["display"];
				//$nv=count($cv);
				//echo $nv;
				$chk=false;
				for($j=0;$j<=$n;$j++)
				{
					//echo $v;
						if($v==$cv[$j])
					{
							$chk=true;
							break;
					}
							else
								$chk=false;
				}
				if($chk)
				{
					
					$str= $str."<label class='checkbox'><INPUT TYPE='checkbox' id='$this->id' NAME='".$this->id."[]' value='$v'  $att $ev checked> $d</label>";
				}
				else
				{
					$str= $str."<label class='checkbox'><INPUT TYPE='checkbox' id='$this->id' NAME='".$this->id."[]' value='$v'  $att $ev> $d</label>";
				}
			}
			//	$html="<table>";
			//$html.="<tr><td>";
			$html.=$str;
			$vname="Y";
             if($this->validate==false)
                   $vname="N";
              $vname="VALIDATE_".$vname."_TB_".$this->formname."_".$this->id;
				
			//$html.="</td>";
			$html.="<span id='".$vname."'></span>";
			//$html.="<td></td></tr></table>";
			return $html;
			//return $str;
		}
	}	

?>