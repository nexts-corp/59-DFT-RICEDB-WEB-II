<?php
	class TDialogBox extends TControl
	{

		var $Title;
		var $Detail;

		function show()
		{
			$att=$this->addAttribute();
			$ev=$this->addEvent("this.value");

			$str.="
					<script type=\"text/javascript\">
						$(document).ready(function () {
							 setupDialogBox(\"$this->id\",\"$this->Title\");
						});
					 </script>
				     ";
			
			$str.="
					<div id=\"$this->id\" title=\"$this->Title\">
                                    <p>$this->Detail</p>
                                </div>
					 ";
			$str.="
					 <button id=\"$this->Title\">$this->values</button>
					 ";
			$html=$str;
			return $html;
		}
	}	
?>