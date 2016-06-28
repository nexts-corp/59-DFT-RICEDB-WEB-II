<?php
	class TInputdate extends TControl
	{
		//var $ID;
		//var $Value;
		var $size;
		var $max;
		var $enable;
		var $Event_onChange;		
		
		//Edit by aek 20-07-2009 : แก้ไขแสดงปุ่มปฎิทิน และDisable สี Textbox
		function show()
		{
			$att=$this->addAttribute();
			//msgbox("att ".$att);
			$att_count = substr_count($att, "disabled='1'");
			//msgbox("count ".$att_count);
			if($att_count == "1")
			{
				$enable = "class=\"NonDisplay\"";
			}
			else
			{
				$enable = "";
			}
			$ev=$this->addEvent("this.value");

			$vname="Y";
             if($this->validate==false)
                   $vname="N";
              $vname="VALIDATE_".$vname."_TB_".$this->formname."_".$this->id;
			$chk="this.value=format".$this->FiledType."(this.value,'".$vname."');";

				$str="<input type=\"text\" id=\"$this->id\" name=\"$this->id\"  value=\"$this->values\"  onblur=\"".$chk."\"	class=\"inputTextDateDis\">&nbsp;<IMG SRC='images/ew_calendar.png' WIDTH='16' HEIGHT='15' BORDER='0'    onclick=\"javascript:showCalendar('$this->id')\" $enable $ev>";

			//$html="<table>";
			//$html.="<tr><td>";
			

			$html.=$str;
			
			//$html.="</td>";
			//$html.="<td><span id='".$vname."'></span></td></tr></table>";
			return $html;

			//return $str;
		}
	}
	class TInputdatejquery extends TControl
	{
		//var $ID;
		//var $Value;
		var $size;
		var $max;
		var $enable;
		var $Event_onChange;		
		
		//Edit by aek 20-07-2009 : แก้ไขแสดงปุ่มปฎิทิน และDisable สี Textbox
		function show()
		{
			$att=$this->addAttribute();
			$ev=$this->addEvent("this.value");

			$str.="	<script type=\"text/javascript\">
						 $(document).ready(function () {
							$('#$this->id').datepicker();
						 });
						 </script>
					 ";
				$str.="<input type=\"text\" id=\"$this->id\" />";

		
			$html.=$str;
			
			return $html;

		}
	}
?>