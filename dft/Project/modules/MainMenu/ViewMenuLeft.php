<?php

class  ViewMenuLeft extends TForm
 {
	 	
    function ViewMenuLeft()
    {
            global $ConfigPage;
            $this->Init("ViewMenuLeft","MainMenu","",true);

            $pn=new TPanel();
            $pn->set("pn","","","",true,"","");
            $this->add($pn);
			
			

            $this->waitevent();
    }

 }

?>