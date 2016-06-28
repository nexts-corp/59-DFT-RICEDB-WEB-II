<?php
	class TTextckeditor extends TControl
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

			$str="<textarea cols='20' id='$this->id' name='$this->id' rows='10' >$this->values</textarea>";

			$str.="<script type=\"text/javascript\"> CKEDITOR.replace( '$this->id',{enterMode : CKEDITOR.ENTER_BR,skin : 'moono',height   : 150,
width    : 600,uiColor: '#CCCCCC',toolbar :
        [
            ['Source','-','Templates','Cut','Copy','Paste','PasteText'],
            ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
			['Styles','Format','Font','FontSize','Image','Flash','Smiley'],
            ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','TextColor','BGColor'],
            ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','Maximize'],

        ],
	filebrowserBrowseUrl : './framework/ckfinder/ckfinder.html',
    filebrowserImageBrowseUrl : './framework/ckfinder/ckfinder.html?Type=Images',
    filebrowserFlashBrowseUrl : './framework/ckfinder/ckfinder.html?Type=Flash',
    filebrowserUploadUrl : './framework/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserImageUploadUrl : './framework/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
    filebrowserFlashUploadUrl : './framework/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'});
	
	</script>";
			return $str;

		?>

		
		<?php

		}
	}	
class TTextckeditorForwebbroad extends TControl
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

			$str="<textarea cols='20' id='$this->id' name='$this->id' rows='10'>$this->values</textarea>";

			$str.="<script type=\"text/javascript\"> 
			
			CKEDITOR.replace( '$this->id',{
				extraPlugins    : 'uicolor',
				uiColor : '#CCC',
				height  : 200,
				width   : 550,

		toolbar :
        [
					['Source','-','Templates'],
                    ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
                    ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
                    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                    ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],

        ],
    filebrowserFlashUploadUrl : './framework/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'});</script>";
			return $str;

		?>

		
		<?php

		}
	}	
?>
