<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TTab
 *
 * @author SOMCHIT
 */
class TTab {
		var $item;
		function additem($pagename,$pagetitle,$selected)
		{
				$n=count($this->item);
				$this->item[$n]["pagename"]=$pagename;
				$this->item[$n]["pagetitle"]=$pagetitle;
                $this->item[$n]["selected"]=$selected;
		}
        function show()
		{
            $n=count($this->item);
            $str=$str."<div id='tabsBar'>";
            $str=$str." <ul>";
            for($i=0;$i<$n;$i++)
			{
                    $v=$this->item[$i]["pagename"];
                    $d=$this->item[$i]["pagetitle"];
                    $s=$this->item[$i]["selected"];
                    if($s)
                    {

                         $str=$str." <li class='selectedTab'><span >".$d."</span></li>";
                    }
                   else
                   {
                          $str=$str." <li> <a href='?page=".$v."'><span>".$d."</span></a></li>";
                   }
            }
            $str=$str."</ul>";
            $str=$str."</div>";
			return $str;
		}
}
?>
