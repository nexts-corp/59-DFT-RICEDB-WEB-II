<?php
	class TTexteditor extends TControl
	{
		//var $ID;
		//var $Value;
		var $size;
		var $max;
		var $enable;
		var $widhts;
		var $heights;
		var $Toolbar="Default";
		//var $Event_onChange;		
		function show()
		{
			$str.="
					<script type=\"text/javascript\">
					$(document).ready(function () {
						setupTinyMCE();
						});
					</script>
				     ";
			$str.="<textarea class=\"tinymce\" id='$this->id' name='$this->id'>$this->values</textarea>";
			$html=$str;
			return $html;
			//return $html ;
		}
	}	
?>