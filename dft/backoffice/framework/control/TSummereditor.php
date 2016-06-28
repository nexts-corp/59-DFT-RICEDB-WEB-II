<?php
	class TSummereditor extends TControl
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


  <!-- include libraries BS3 -->
  <link rel=\"stylesheet\" href=\"./framework/summernote/support/bootstrap.css\" />

  <link rel=\"stylesheet\" href=\"//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css\" />

	<link rel='stylesheet'  href='./framework/ThirdParty/NextPage/nextpage.css' type='text/css' media='screen' />
	<script type=\"text/javascript\">
					$(document).ready(function() {

				        $('.summernote".$this->id."').summernote({
				        	 
				             height: 400,
				             prettifyHtml:false,
           					toolbar: [
							            ['edit',['undo','redo']],
							            ['headline', ['style']],
							            ['style', ['bold', 'italic', 'underline', 'clear']],
									    ['font', ['strikethrough', 'superscript', 'subscript']],
									    ['fontsize', ['fontsize']],
									    ['color', ['color']],
									    ['para', ['ul', 'ol', 'paragraph']],
									    ['height', ['height']],
							            ['alignment', ['ul', 'ol', 'paragraph', 'lineheight']],
							            ['table', ['table']],
							            ['insert', ['link','picture','video','hr']],
							            ['view', ['fullscreen', 'codeview']],
							       
       									['group', [ 'video' ]]
   
							            //['help', ['help']]
							        ],
							         
  

				            	onImageUpload: function(files) {
					                for (i = 0; i < files.length; i++) { 
					                sendFile(files[i]);
									 }
					            }
				        });
				        function sendFile(file, editor, welEditable) {
				            data = new FormData();
				            data.append(\"file\", file);
				           
				            $.ajax({
				                data: data,
				                type: \"POST\",
				                url: './Project/modules/Smn/lib/imagesUp.php',
				                cache: false,
				                contentType: false,
				                processData: false,
				                success: function(url) {
				                	var url = \"Upload/Smn/\"+url;
				          			$('.summernote".$this->id."').summernote('editor.insertImage', url);
				                }
				            });
				        }
				    });
					  </script>



  <link rel=\"stylesheet\" href=\"./framework/summernote/dist/summernote.css\">
  <script type=\"text/javascript\" src=\"./framework/summernote/dist/summernote.js\"></script>
  <script src=\"./framework/summernote/plugin/summernote-ext-video.js\"></script> 

					
				     ";
			$str.="<textarea class=\"summernote".$this->id."\" id='$this->id' name='$this->id'>$this->values</textarea>";
			$html=$str;
			return $html;
			//return $html ;
		}
	}	
?>