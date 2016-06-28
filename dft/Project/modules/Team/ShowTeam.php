<?php

// new


//end new

class  ShowTeam extends TForm
 {
	 	
		function ShowTeam()
		{
			global $ConfigPage;
				$this->Init("ShowTeam","Team","",true);

				// $dao=new RegisterDao();
				// 	$o=$dao->selectAllByOpen();


				// $pn=new TPanel();
				// $pn->set("pn","","","",true,"","");
				// $this->add($pn);

					
				// $pn->append('
				// 			<div class="row">
    //                           <div class="col-xs-6 col-md-4"></div> 
				// 	<div class="col-xs-6 col-md-4">
					

				// 	<div class="list-event-item">
    //                         <div class="box-content-inner clearfix">
    //                             <div class="list-event">
    //                                 <img src="'.$ConfigPage["PathImages"].$o[0]->registerFile.'" class="img-responsive" alt="img"  style="height:200px; margin-left:30%;"   />
    //                                <br>
				// 			<h5> ชื่อ-นามสกุล :  '.$o[0]->registerName.' </h5>
				// 			<h5> ตำแหน่งงาน  :  '.$o[0]->registerPositions.' </h5>
    //                            </div>
    //                            </div>
    //                            </div>

    //                </div>
								
    //                           <div class="col-xs-6 col-md-4"></div> 
                                
				// </div>
				
				// 	');

				// for($i=1;$i<count($o);$i++)
				// {				
					
				// 	$pn->append('
						
				// 		<div class="col-md-4">');
					
					
							
				// 		$pn->append('
			

			 // <div class="list-event-item">
    //                         <div class="box-content-inner clearfix">
    //                             <div class="list-event" style="text-align:center;">
    //                                 <img src="'.$ConfigPage["PathImages"].$o[$i]->registerFile.'" class="img-responsive" alt="img"  style="height:200px; margin-left:30%;" />
    //                                <br>
				// 			<h5> ชื่อ-นามสกุล :  '.$o[$i]->registerName.' </h5>
				// 			<p> ตำแหน่งงาน  :  '.$o[$i]->registerPositions.' </p>
    //                            </div>
								
                               
                               


    //                         </div> <!-- /.box-content-inner -->
    //                     </div> <!-- /.list-event-item -->


			
				

				// ');

				
					
						
				// 		$pn->append('</div>');
						
						
				// }

				// $pn->append('<div class="clearfix margin-bottom-1"><hr></div>');
               
               
			$this->waitevent();
		}
 }

?>