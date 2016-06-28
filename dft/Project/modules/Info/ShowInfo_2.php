<?php
class  ShowInfo_2 extends TForm
 {

		function ShowInfo_2()
		{
			global $ConfigPage;
				$this->Init("ShowInfo_2","Info","",true);

        $pn=new TPanel();
        $pn->set("pn","","","",true,"","");
        $this->add($pn);



        $pn_info=new TPanel();
        $pn_info->set("pn_info","","","",true,"","");
        $this->add($pn_info);

        $pn_tab=new TPanel();
        $pn_tab->set("pn_tab","","","",true,"","");
        $this->add($pn_tab);

        $obj=$this->getdata('inf');
        $tab=$this->getdata('tab');

        if(empty($obj))
              $obj="preview2_1_1";

        if($tab=="1")
        {
          $pn_tab->append("
          <section class='' style='background-color: #fff;'>

            <nav class='menu' style='background-color: #fff;'>
                <!-- start container -->
                <div class='container'>
                    <!-- start row -->
                    <div class='row'>
                        <div class='col-xs-12 col-sm-12 col-lg-12'>

                            <!-- start menu block (profile) -->
                            <a href='?page=Info.ShowInfo_2&inf=preview4_2_1&tab=1' class='menu-li' style='width: 100px;'>
                                <!-- img menu block -->
                                <span class='foto'>
                                    <img src='images/icon_set2_128px/Cambodia.png' class='' data-img-name='profile' width='70px' alt='Ukieweb'>
                                </span>
                                <!-- name menu block -->
                                <span class='name' style='color:#000'>กัมพูชา</span>
                            </a>
                            <!-- end menu block (profile) -->

                            <!-- start menu block (profile) -->
                            <a href='?page=Info.ShowInfo_2&inf=preview4_2_2&tab=1' class='menu-li' style='width: 100px;'>
                                <!-- img menu block -->
                                <span class='foto'>
                                    <img src='images/icon_set2_128px/India.png' class='' data-img-name='profile' width='70px' alt='Ukieweb'>
                                </span>
                                <!-- name menu block -->
                                <span class='name' style='color:#000'>อินเดีย</span>
                            </a>
                            <!-- end menu block (profile) -->

                            <!-- start menu block (profile) -->
                            <a href='?page=Info.ShowInfo_2&inf=preview4_2_3&tab=1' class='menu-li' style='width: 100px;'>
                                <!-- img menu block -->
                                <span class='foto'>
                                    <img src='images/icon_set2_128px/India.png' class='' data-img-name='profile' width='70px' alt='Ukieweb'>
                                </span>
                                <!-- name menu block -->
                                <span class='name' style='color:#000'>ปากีสถาน</span>
                            </a>
                            <!-- end menu block (profile) -->

                            <!-- start menu block (profile) -->
                            <a href='?page=Info.ShowInfo_2&inf=preview4_2_4&tab=1' class='menu-li' style='width: 100px;'>
                                <!-- img menu block -->
                                <span class='foto'>
                                    <img src='images/icon_set2_128px/USA.png' class='' data-img-name='profile' width='70px' alt='Ukieweb'>
                                </span>
                                <!-- name menu block -->
                                <span class='name' style='color:#000'>สหรัฐ</span>
                            </a>
                            <!-- end menu block (profile) -->

                            <!-- start menu block (profile) -->
                            <a href='?page=Info.ShowInfo_2&inf=preview4_2_5&tab=1' class='menu-li' style='width: 100px;'>
                                <!-- img menu block -->
                                <span class='foto'>
                                    <img src='images/icon_set2_128px/Vietnam.png' class='' width='70px' data-img-name='profile' alt='Ukieweb'>
                                </span>
                                <!-- name menu block -->
                                <span class='name' style='color:#000'>เวียดนาม</span>
                            </a>
                            <!-- end menu block (profile) -->


                        </div>
                    </div>
                    <!-- end row -->
                </div>
                <!-- end container -->
            </nav>
            <!-- End Menu section -->

          </section>
          <!-- Start Blog section -->
            ");
        }

        if($tab=="2")
        {
          $pn_tab->append("
          <section class='' style='background-color: #FFF;'>

            <nav class='menu' style='background-color: #FFF;'>
                <!-- start container -->
                <div class='container'>
                    <!-- start row -->
                    <div class='row'>
                        <div class='col-xs-12 col-sm-12 col-lg-12'>

                            <!-- start menu block (profile) -->
                            <a href='?page=Info.ShowInfo_2&inf=preview2_1_6&tab=2' class='menu-li' style='width: 150px;'>
                                <!-- img menu block -->
                                <span class='foto'>
                                    <img src='images/icon_set2_128px/rice06_128px.png' width='70px' class='' data-img-name='profile' alt='Ukieweb'>
                                </span>
                                <!-- name menu block -->
                                <span class='name' style='color:#000'>ราคาข้าวเปลือก</span>
                            </a>
                            <!-- end menu block (profile) -->

                            <!-- start menu block (profile) -->
                            <a href='?page=Info.ShowInfo_2&inf=preview2_1_3&tab=2' class='menu-li' style='width: 150px;'>
                                <!-- img menu block -->
                                <span class='foto'>
                                    <img src='images/icon_set2_128px/rice01_128px.png' width='70px' class='' data-img-name='profile' alt='Ukieweb'>
                                </span>
                                <!-- name menu block -->
                                <span class='name' style='color:#000'>ราคาข้าวสาร</span>
                            </a>
                            <!-- end menu block (profile) -->

                            <!-- start menu block (profile) -->
                            <a href='?page=Info.ShowInfo_2&inf=preview2_1_4&tab=2' class='menu-li' style='width: 150px;'>
                                <!-- img menu block -->
                                <span class='foto'>
                                    <img src='images/icon_set2_128px/rice05_128px.png' width='70px' class='' data-img-name=
                                    'profile' alt='Ukieweb'>
                                </span>
                                <!-- name menu block -->
                                <span class='name' style='color:#000'>ราคาข้าวนึ่ง</span>
                            </a>
                            <!-- end menu block (profile) -->

                            <!-- start menu block (profile) -->
                            <a href='?page=Info.ShowInfo_2&inf=preview2_1_8&tab=2' class='menu-li' style='width: 150px;'>
                                <!-- img menu block -->
                                <span class='foto'>
                                    <img src='images/icon_set2_128px/rice08_128px.png' width='70px' class='' data-img-name=
                                    'profile' alt='Ukieweb'>
                                </span>
                                <!-- name menu block -->
                                <span class='name' style='color:#000'>ราคาข้าวถุง</span>
                            </a>
                            <!-- end menu block (profile) -->

                        </div>
                    </div>
                    <!-- end row -->
                </div>
                <!-- end container -->
            </nav>
            <!-- End Menu section -->

          </section>
          <!-- Start Blog section -->
            ");
        }
        if($tab=="3")
        {
          $pn_tab->append("
          <section class='' style='background-color: #FBA931;'>

            <nav class='menu' style='background-color: #FBA931;'>
                <!-- start container -->
                <div class='container'>
                    <!-- start row -->
                    <div class='row'>
                        <div class='col-xs-12 col-sm-12 col-lg-12'>

                            <!-- start menu block (profile) -->
                            <a href='?page=Info.ShowInfo_2&inf=preview2_3_1&tab=3' class='menu-li' style='width: 200px;'>
                                <!-- img menu block -->
                                <span class='foto'>
                                    <img src='images/icon_set2_128px/rice01_128px.png' class='' data-img-name='profile' alt='Ukieweb'>
                                </span>
                                <!-- name menu block -->
                                <span class='name' style='color:#EEE'>ราคาข้าวหอมมะลิ</span>
                            </a>
                            <!-- end menu block (profile) -->

                            <!-- start menu block (profile) -->
                            <a href='?page=Info.ShowInfo_2&inf=preview2_1_2&tab=3' class='menu-li' style='width: 200px;'>
                                <!-- img menu block -->
                                <span class='foto'>
                                    <img src='images/icon_set2_128px/rice02_128px.png' class='' data-img-name='profile' alt='Ukieweb'>
                                </span>
                                <!-- name menu block -->
                                <span class='name' style='color:#EEE'>ราคาข้าวหอมปทุมฯ</span>
                            </a>
                            <!-- end menu block (profile) -->

                            <!-- start menu block (profile) -->
                            <a href='?page=Info.ShowInfo_2&inf=preview2_1_3&tab=3' class='menu-li' style='width: 200px;'>
                                <!-- img menu block -->
                                <span class='foto'>
                                    <img src='images/icon_set2_128px/rice03_128px.png' class='' data-img-name='profile' alt='Ukieweb'>
                                </span>
                                <!-- name menu block -->
                                <span class='name' style='color:#EEE'>ราคาข้าวขาว</span>
                            </a>
                            <!-- end menu block (profile) -->

                            <!-- start menu block (profile) -->
                            <a href='?page=Info.ShowInfo_2&inf=preview2_1_5&tab=3' class='menu-li' style='width: 200px;'>
                                <!-- img menu block -->
                                <span class='foto'>
                                    <img src='images/icon_set2_128px/rice05_128px.png' class='' data-img-name='profile' alt='Ukieweb'>
                                </span>
                                <!-- name menu block -->
                                <span class='name' style='color:#EEE'>ราคาข้าวเหนียว</span>
                            </a>
                            <!-- end menu block (profile) -->

                        </div>
                    </div>
                    <!-- end row -->
                </div>
                <!-- end container -->
            </nav>
            <!-- End Menu section -->

          </section>
          <!-- Start Blog section -->
            ");
        }
        //หัวข้อที่ 1
        if($obj=="preview2_1_1"){
          $src="<object data='./images/info/job4_1x/web/job4_1x.html' style='height:4300px;width:100%;overflow:hidden;'></object>";
          $src.="<object data='./images/info/job3_2x/web/job3_2x.html' style='height:2500px;width:100%;overflow:hidden;'></object>";
          //$keyword="ต้นทุนในการผลิตข้าวของชาวนาต่อ 1 ไร่";
          $pn->append($src);
          $pn_info->append($keyword);

        }
        elseif($obj=="preview4_2_1"){
          $src="<object data='./images/info/job4_2/nation1/web/nation1.html' style='height:800px;width:100%;overflow:hidden;'></object>";
          //$keyword="ต้นทุนในการผลิตข้าวของชาวนาต่อ 1 ไร่";
          $pn->append($src);
          $pn_info->append($keyword);

        }
        elseif($obj=="preview4_2_2"){
          $src="<object data='./images/info/job4_2/nation2/web/nation2.html' style='height:800px;width:100%;overflow:hidden;'></object>";
          //$keyword="ต้นทุนในการผลิตข้าวของชาวนาต่อ 1 ไร่";
          $pn->append($src);
          $pn_info->append($keyword);

        }
        elseif($obj=="preview4_2_3"){
          $src="<object data='./images/info/job4_2/nation3/web/nation3.html' style='height:800px;width:100%;overflow:hidden;'></object>";
          //$keyword="ต้นทุนในการผลิตข้าวของชาวนาต่อ 1 ไร่";
          $pn->append($src);
          $pn_info->append($keyword);

        }
        elseif($obj=="preview4_2_4"){
          $src="<object data='./images/info/job4_2/nation4/web/nation4.html' style='height:800px;width:100%;overflow:hidden;'></object>";
          //$keyword="ต้นทุนในการผลิตข้าวของชาวนาต่อ 1 ไร่";
          $pn->append($src);
          $pn_info->append($keyword);

        }
        elseif($obj=="preview4_2_5"){
          $src="<object data='./images/info/job4_2/nation5/web/nation5.html' style='height:800px;width:100%;overflow:hidden;'></object>";
          //$keyword="ต้นทุนในการผลิตข้าวของชาวนาต่อ 1 ไร่";
          $pn->append($src);
          $pn_info->append($keyword);

        }
        //หัวข้อที่ 2
        elseif($obj=="preview2_2_1"){
          $src="<object data='./images/info/job2_1/rice6/web/job2_1_rice_6.html' style='height:1100px;width:100%;overflow:hidden;'></object>";
          //$keyword="ต้นทุนในการผลิตข้าวของชาวนาต่อ 1 ไร่";
          $pn->append($src);
          $pn_info->append($keyword);

        }
        elseif($obj=="preview2_1_6"){
          $src="<object data='./images/info/job2_1/rice6/web/job2_1_rice_6.html' style='height:1100px;width:100%;overflow:hidden;'></object>";
          //$keyword="ต้นทุนในการผลิตข้าวของชาวนาต่อ 1 ไร่";
          $pn->append($src);
          $pn_info->append($keyword);

        }
        elseif($obj=="preview2_1_4"){
          $src="<object data='./images/info/job2_1/rice4/web/job2_1_rice_4.html' style='height:1100px;width:100%;overflow:hidden;'></object>";
          //$keyword="ต้นทุนในการผลิตข้าวของชาวนาต่อ 1 ไร่";
          $pn->append($src);
          $pn_info->append($keyword);

        }
        elseif($obj=="preview2_1_7"){
          $src="<object data='./images/info/job2_1/rice7/web/job2_1_rice_7.html' style='height:1100px;width:100%;overflow:hidden;'></object>";
          //$keyword="ต้นทุนในการผลิตข้าวของชาวนาต่อ 1 ไร่";
          $pn->append($src);
          $pn_info->append($keyword);

        }
        //หัวข้อที่ 3
        elseif($obj=="preview2_3_1"){
          $src="<object data='./images/info/job2_1/rice1/web/job2_1_rice_1.html' style='height:1100px;width:100%;overflow:hidden;'></object>";
          //$keyword="ต้นทุนในการผลิตข้าวของชาวนาต่อ 1 ไร่";
          $pn->append($src);
          $pn_info->append($keyword);

        }
        elseif($obj=="preview2_1_2"){
          $src="<object data='./images/info/job2_1/rice2/web/job2_1_rice_2.html' style='height:1100px;width:100%;overflow:hidden;'></object>";
          //$keyword="ต้นทุนในการผลิตข้าวของชาวนาต่อ 1 ไร่";
          $pn->append($src);
          $pn_info->append($keyword);

        }
        elseif($obj=="preview2_1_3"){
          $src="<object data='./images/info/job2_1/rice3/web/job2_1_rice_3.html' style='height:1100px;width:100%;overflow:hidden;'></object>";
          //$keyword="ต้นทุนในการผลิตข้าวของชาวนาต่อ 1 ไร่";
          $pn->append($src);
          $pn_info->append($keyword);

        }
        elseif($obj=="preview2_1_5"){
          $src="<object data='./images/info/job2_1/rice5/web/job2_1_rice_5.html' style='height:1100px;width:100%;overflow:hidden;'></object>";
          //$keyword="ต้นทุนในการผลิตข้าวของชาวนาต่อ 1 ไร่";
          $pn->append($src);
          $pn_info->append($keyword);

        }
        //หัวข้อที่ 4
        elseif($obj=="preview2_1_8"){
          $src="<object data='./images/info/job2_1/rice8/web/job2_1_rice_8.html' style='height:1100px;width:100%;overflow:hidden;'></object>";
          //$keyword="ต้นทุนในการผลิตข้าวของชาวนาต่อ 1 ไร่";
          $pn->append($src);
          $pn_info->append($keyword);

        }




			$this->waitevent();
		}
 }

?>
