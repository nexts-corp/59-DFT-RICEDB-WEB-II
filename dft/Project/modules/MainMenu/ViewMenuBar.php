<?php

// require_once("./Project/bussiness/Config_Page_Menu_BarDao.php");
// require_once("./Project/common/config_page_menu_bar.php");

// require_once("./Project/bussiness/Config_Page_Menu_Bar_SubDao.php");
// require_once("./Project/common/config_page_menu_bar_sub.php");


class  ViewMenuBar extends TForm
 {

		function ViewMenuBar()
		{
			global $orm;
			global $ConfigPage;
			$this->Init("ViewMenuBar","MainMenu","",true);

		  $page=$this->getdata("page");

			$pn=new TPanel();
			$pn->set("pn","","","",true,"","");
			$this->add($pn);

      $ex_page=explode(".",$page);
      if($ex_page[0]=="MainPage")
      {
        $pn->append("
        <li  class='active'> <a class='dropdown-toggle' data-toggle='dropdown' href='?page=MainPage.HomePage' >หน้าแรก</a>
          <ul>
          </ul>
        </li>
        ");
      }
      else {
        $pn->append("
        <li> <a class='dropdown-toggle' data-toggle='dropdown' href='?page=MainPage.HomePage' >หน้าแรก</a>
          <ul>
          </ul>
        </li>
        ");
      }

      if($ex_page[0]=="AboutUs")
      {
        $pn->append("
        <li class='dropdown active'> <a class='dropdown-toggle' data-toggle='dropdown' href='?page=AboutUs.ShowAboutUs'>เกี่ยวกับองค์กร </a> </li>
        ");
      }
      else {
        $pn->append("
        <li> <a class='dropdown-toggle' data-toggle='dropdown' href='?page=AboutUs.ShowAboutUs'>เกี่ยวกับองค์กร </a> </li>
        ");
      }

      if($ex_page[0]=="Info")
      {
        $pn->append("
        <li class='dropdown active'> <a href='?page=Info.ShowInfo' class='dropdown-toggle' data-toggle='dropdown'>การผลิตและการค้าข้าวของไทย <i class='fa fa-fw fa-angle-down'></i></a>
          <ul class='dropdown-menu yamm-dropdown'>
            <li>
              <div class='yamm-content'>
                <div class='row'>
                  <div class='col-sm-6'> <span class='navbar-title'> Info Graphic </span>
                    <ul class='list-unstyled'>
                      <li><a href='?page=Info.ShowInfo&keyword=ข้าวเปลือกภูมิภาค&inf=preview1_0'><i class='fa fa-fw fa-angle-right'></i>ข้าวเปลือกภูมิภาค</a></li>
                      <li><a href='?page=Info.ShowInfo&keyword=สถานการณ์ข้าวโลก ข้าวไทย และเป้าหมายการส่งออก&inf=preview1_1_1'><i class='fa fa-fw fa-angle-right'></i> สถานการณ์ข้าวโลก ข้าวไทย และเป้าหมายการส่งออก </a></li>
                      <li><a href='?page=Info.ShowInfo&keyword=เนื้อที่เพาะปลูกและผลิตผลต่อไร่ของชาวนาปี&inf=preview1_1_2'><i class='fa fa-fw fa-angle-right'></i> เนื้อที่เพาะปลูกและผลิตผลต่อไร่ของชาวนาปี </a></li>
                      <li><a href='?page=Info.ShowInfo&keyword=เนื้อที่เพาะปลูกและผลิตผลต่อไร่ของชาวนาปรัง&inf=preview1_1_3'><i class='fa fa-fw fa-angle-right'></i> เนื้อที่เพาะปลูกและผลิตผลต่อไร่ของชาวนาปรัง</a></li>
                      <li><a href='?page=Info.ShowInfo&keyword=พยากรณ์การผลิตข้าว นาปี/นาปรัง&inf=preview1_1_4'><i class='fa fa-fw fa-angle-right'></i>พยากรณ์การผลิตข้าว นาปี/นาปรัง </a></li>
                      <li><a href='?page=Info.ShowInfo&keyword=ขั้นตอนการปลูกข้าว&inf=preview1_1_5'><i class='fa fa-fw fa-angle-right'></i>ขั้นตอนการปลูกข้าว</a></li>
                      <li><a href='?page=Info.ShowInfo&keyword=การช่วยเหลือผู้ปลูกข้าว&inf=preview1_2'><i class='fa fa-fw fa-angle-right'></i> การช่วยเหลือผู้ปลูกข้าว</a></li>
                    </ul>
                  </div>
                  <div class='col-sm-6'> <span class='navbar-title'> Info Graphic </span>
                    <ul class='list-unstyled'>
                      <li><a href='?page=Info.ShowInfo&keyword=ราคาข้าวถุง&inf=preview2_3'><i class='fa fa-fw fa-angle-right'></i> ราคาข้าวถุง </a></li>
                      <li><a href='?page=Info.ShowInfo&keyword=ปริมาณและข้อมูลการส่งออก&inf=preview3_1_1'><i class='fa fa-fw fa-angle-right'></i> ปริมาณและข้อมูลการส่งออก </a></li>
                      <li><a href='?page=Info.ShowInfo&keyword=ปริมาณและข้อมูลการส่งออก ข้าวหอมมะลิไทย&inf=preview3_1_2'><i class='fa fa-fw fa-angle-right'></i> ปริมาณและข้อมูลการส่งออก ข้าวหอมมะลิไทย </a></li>
                      <li><a href='?page=Info.ShowInfo&keyword=ราคา F.O.B แหล่งข้อมูลต่างประเทศ&inf=preview3_2_1'><i class='fa fa-fw fa-angle-right'></i> ราคา F.O.B แหล่งข้อมูลต่างประเทศ </a></li>
                      <li><a href='?page=Info.ShowInfo&keyword=ราคา F.O.B แหล่งข้อมูลต่างประเทศ ครั้งที่ 47&inf=preview3_2_2'><i class='fa fa-fw fa-angle-right'></i> ราคา F.O.B แหล่งข้อมูลต่างประเทศ ครั้งที่ 47 </a></li>
                      <li><a href='?page=Info.ShowInfo&keyword=การขายให้ COFCO &inf=preview3_3'><i class='fa fa-fw fa-angle-right'></i> การขายให้ COFCO </a></li>
                      <li><a href='?page=Info.ShowInfo&keyword=พื้นที่เพาะปลูก&inf=preview4_1'><i class='fa fa-fw fa-angle-right'></i> พื้นที่เพาะปลูก</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </li>
        ");
      }
      else {
        $pn->append("
        <li class='dropdown'> <a href='?page=Info.ShowInfo' class='dropdown-toggle' data-toggle='dropdown'>การผลิตและการค้าข้าวของไทย <i class='fa fa-fw fa-angle-down'></i></a>
          <ul class='dropdown-menu yamm-dropdown'>
            <li>
              <div class='yamm-content'>
                <div class='row'>
                  <div class='col-sm-6'> <span class='navbar-title'> Info Graphic </span>
                    <ul class='list-unstyled'>
                      <li><a href='?page=Info.ShowInfo&keyword=ข้าวเปลือกภูมิภาค&inf=preview1_0'><i class='fa fa-fw fa-angle-right'></i>ข้าวเปลือกภูมิภาค</a></li>
                      <li><a href='?page=Info.ShowInfo&keyword=สถานการณ์ข้าวโลก ข้าวไทย และเป้าหมายการส่งออก&inf=preview1_1_1'><i class='fa fa-fw fa-angle-right'></i> สถานการณ์ข้าวโลก ข้าวไทย และเป้าหมายการส่งออก </a></li>
                      <li><a href='?page=Info.ShowInfo&keyword=เนื้อที่เพาะปลูกและผลิตผลต่อไร่ของชาวนาปี&inf=preview1_1_2'><i class='fa fa-fw fa-angle-right'></i> เนื้อที่เพาะปลูกและผลิตผลต่อไร่ของชาวนาปี </a></li>
                      <li><a href='?page=Info.ShowInfo&keyword=เนื้อที่เพาะปลูกและผลิตผลต่อไร่ของชาวนาปรัง&inf=preview1_1_3'><i class='fa fa-fw fa-angle-right'></i> เนื้อที่เพาะปลูกและผลิตผลต่อไร่ของชาวนาปรัง</a></li>
                      <li><a href='?page=Info.ShowInfo&keyword=พยากรณ์การผลิตข้าว นาปี/นาปรัง&inf=preview1_1_4'><i class='fa fa-fw fa-angle-right'></i>พยากรณ์การผลิตข้าว นาปี/นาปรัง </a></li>
                      <li><a href='?page=Info.ShowInfo&keyword=ขั้นตอนการปลูกข้าว&inf=preview1_1_5'><i class='fa fa-fw fa-angle-right'></i>ขั้นตอนการปลูกข้าว</a></li>
                      <li><a href='?page=Info.ShowInfo&keyword=การช่วยเหลือผู้ปลูกข้าว&inf=preview1_2'><i class='fa fa-fw fa-angle-right'></i> การช่วยเหลือผู้ปลูกข้าว</a></li>
                    </ul>
                  </div>
                  <div class='col-sm-6'> <span class='navbar-title'> Info Graphic </span>
                    <ul class='list-unstyled'>
                      <li><a href='?page=Info.ShowInfo&keyword=ราคาข้าวถุง&inf=preview2_3'><i class='fa fa-fw fa-angle-right'></i> ราคาข้าวถุง </a></li>
                      <li><a href='?page=Info.ShowInfo&keyword=ปริมาณและข้อมูลการส่งออก&inf=preview3_1_1'><i class='fa fa-fw fa-angle-right'></i> ปริมาณและข้อมูลการส่งออก </a></li>
                      <li><a href='?page=Info.ShowInfo&keyword=ปริมาณและข้อมูลการส่งออก ข้าวหอมมะลิไทย&inf=preview3_1_2'><i class='fa fa-fw fa-angle-right'></i> ปริมาณและข้อมูลการส่งออก ข้าวหอมมะลิไทย </a></li>
                      <li><a href='?page=Info.ShowInfo&keyword=ราคา F.O.B แหล่งข้อมูลต่างประเทศ&inf=preview3_2_1'><i class='fa fa-fw fa-angle-right'></i> ราคา F.O.B แหล่งข้อมูลต่างประเทศ </a></li>
                      <li><a href='?page=Info.ShowInfo&keyword=ราคา F.O.B แหล่งข้อมูลต่างประเทศ ครั้งที่ 47&inf=preview3_2_2'><i class='fa fa-fw fa-angle-right'></i> ราคา F.O.B แหล่งข้อมูลต่างประเทศ ครั้งที่ 47 </a></li>
                      <li><a href='?page=Info.ShowInfo&keyword=การขายให้ COFCO &inf=preview3_3'><i class='fa fa-fw fa-angle-right'></i> การขายให้ COFCO </a></li>
                      <li><a href='?page=Info.ShowInfo&keyword=พื้นที่เพาะปลูก&inf=preview4_1'><i class='fa fa-fw fa-angle-right'></i> พื้นที่เพาะปลูก</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </li>
        ");
      }

      if($page=="News.ShowNews")
      {
        $pn->append("
        <li class='dropdown active'> <a href='?page=News.ShowNews' class='dropdown-toggle' data-toggle='dropdown'>ข่าวสารประชาสัมพันธ์ <i class='fa fa-fw fa-angle-down'></i></a>
          <ul class='dropdown-menu yamm-dropdown'>
            <li>
              <div class='yamm-content'>
                <div class='row'>
                  <div class='col-sm-4'> <span class='navbar-title'> ข่าวแนะนำ </span>
                    <ul class='list-unstyled'>
                      <li><a href='?page=News.frmNew'><i class='fa fa-fw fa-angle-right'></i> ข่าว 1</a></li>
                      <li><a href='?page=News.frmNew'><i class='fa fa-fw fa-angle-right'></i> ข่าว 2 </a></li>
                    </ul>
                  </div>
                  <div class='col-sm-4 nav-image'> <img src='./Template/html/assets/images/content/menu-portfolio.jpg' alt='Portfolio Image'/> </div>
                </div>
                <div class='row nav-bottom'>
                  <div class='col-md-12'> <span class='btm-sec'><img src='./Template/html/assets/images/content/logosmall.png' alt='logo' about='Corpress'></span> <span class='btm-sec'>Portfolio</span> </div>
                </div>
              </div>
            </li>
          </ul>
        </li>
        ");
      }
      else {
        $pn->append("
        <li class='dropdown'> <a href='?page=News.ShowNews' class='dropdown-toggle' data-toggle='dropdown'>ข่าวสารประชาสัมพันธ์ <i class='fa fa-fw fa-angle-down'></i></a>
          <ul class='dropdown-menu yamm-dropdown'>
            <li>
              <div class='yamm-content'>
                <div class='row'>
                  <div class='col-sm-4'> <span class='navbar-title'> ข่าวแนะนำ </span>
                    <ul class='list-unstyled'>
                      <li><a href='?page=News.frmNew'><i class='fa fa-fw fa-angle-right'></i> ข่าว 1</a></li>
                      <li><a href='?page=News.frmNew'><i class='fa fa-fw fa-angle-right'></i> ข่าว 2 </a></li>
                    </ul>
                  </div>
                  <div class='col-sm-4 nav-image'> <img src='./Template/html/assets/images/content/menu-portfolio.jpg' alt='Portfolio Image'/> </div>
                </div>
                <div class='row nav-bottom'>
                  <div class='col-md-12'> <span class='btm-sec'><img src='./Template/html/assets/images/content/logosmall.png' alt='logo' about='Corpress'></span> <span class='btm-sec'>Portfolio</span> </div>
                </div>
              </div>
            </li>
          </ul>
        </li>
        ");
      }
      if($ex_page[0]=="Team")
      {
        $pn->append("
          <li class='dropdown active'> <a href='?page=Team.ShowTeam' class='dropdown-toggle' data-toggle='dropdown'>ผู้บริหารและโครงสร้าง </a> </li>
        ");
      }
      else {
        $pn->append("
          <li class='dropdown'> <a href='?page=Team.ShowTeam' class='dropdown-toggle' data-toggle='dropdown'>ผู้บริหารและโครงสร้าง </a> </li>
        ");
      }
      if($ex_page[0]=="Contact")
      {
        $pn->append("
        <li class='active'><a href='?page=Contact.ShowContact'>ติดต่อเรา</a></li>
        ");
      }
      else {
        $pn->append("
        <li><a href='?page=Contact.ShowContact'>ติดต่อเรา</a></li>
        ");
      }




			$this->waitevent();
		}


 }

?>
