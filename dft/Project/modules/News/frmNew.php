<?php
// news

//end news

class frmNew extends TForm
	{
		function frmNew()
		{
			global $ConfigPage;
			$this->Init("frmNew","News","",true);
			
			// 	$newID=$this->getdata("newID");

			// 	 $dao = new Plugin_NewDao();
			// 	 $o=$dao->selectById($newID);

			// 	 $o_news=$dao->selectAllByOpen();


			// 	$pn=new TPanel();
			// 	$pn->set("pn","","","",true,"","");
			// 	$this->add($pn);
				
			// 	if(!empty($o->newImg)){
			// 					$img_Check='<img src="'.$ConfigPage["PathImages"].$o->newImg.'" class="img-responsive" style="display:block" />';
			// 	}

			// 	if(!empty($o->newFile)){
			// 		$file='<a href="'.$ConfigPage["PathImages"].$o->newFile.'"> Download </a>';
			// 	}

			// 	$pn->append('

			// 	                            <div class="widget-main-title">

			// 	<h4 class="widget-title">'.$o->newName.'</h4></div><br>

				
   //                           <p>'.$img_Check.'</p>
			// 					<p>'.$o->newDetail.'</p>
			// 				'.$file.'


			// 	');
				
			// 	$pn_news=new TPanel();
			// 	$pn_news->set("pn_news","","","",true,"","");
			// 	$this->add($pn_news);

			// 	for($i=0;$i<count($o_news);$i++){
			// 	$newID=$o_news[$i]->newID;

			// 	$pn_news->append('
			
			// <dl class="dl-horizontal">
   //                      <dt><a href="?page=News.frmNew&newID='.$newID.'"><img src="'.$ConfigPage["PathImages"].$o_news[$i]->newImg.'" class="img-responsive" style="display:block" alt=""></a></dt>
   //                      <dd>
   //                          <p><a href="?page=News.frmNew&newID='.$newID.'">'.$o_news[$i]->newName.'</a></p> 
   //                      </dd>
   //                  </dl>
		
			// 		');

			//}	
				

			$this->waitevent();

		}
	}



?>