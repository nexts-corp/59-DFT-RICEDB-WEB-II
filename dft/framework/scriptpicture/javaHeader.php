<script language="JavaScript">  
var page;
var type;
 var imageDir = "banner/"; 
<?
echo "page='".$_GET[page]."';";
echo "type='".$_GET[type]."';";
?>
 </script>  
<script type="text/javascript" src="framework/scriptpicture/jquery.min.js"></script> 
<script type="text/javascript" src="framework/scriptpicture/fadeslideshow.js"></script>
 
 <script type="text/javascript"> 
if(page=="data/content/categoryType.php" && type=='1'){
var mygallery=new fadeSlideShow({
	wrapperid: "fadeshow1", //ID of blank DIV on page to house Slideshow
	dimensions: [930, 300], //width/height of gallery in pixels. Should reflect dimensions of largest image
	imagearray: [
		[imageDir+"02.jpg", "?page=home.php", "_new", "ANNUAL SALE ช้อปสุดทาง เซลสุดแรง กว่า 5,000 ร้านค้า ปลุกกระแสช็อป ลดสูงสุด 70% (25 มิ.ย.- 1 ส.ค. 53)"],
		[imageDir+"04.jpg", "indexforuser.php?category=1", "_new", "เอาใจคนชอบ ทานอาหาร บุฟเฟ่ต์ ให้วันจันทร์ถึงวันพฤหัสบดีเป็น วันพิเศษของคุณ"]
	],
	displaymode: {type:'auto', pause:5500, cycles:0, wraparound:false},
	persist: false, //remember last viewed slide and recall within same session?
	fadeduration: 1000, //transition duration (milliseconds)
	descreveal: "peekaboo",
	togglerid: "",
	oninit:function(curimage, index){
	
		var setting=this.setting
		var showid="<b>Slideshow ID:</b> " + setting.wrapperid + "<br />"
		var showdimensions="<b>Slideshow Dimensions:</b> " + setting.dimensions + "<br />"
		var totalimages="<b>Total Images:</b> " + setting.imagearray.length + "<br />"
		var firstimagelink="<b>First slide is hyperlinked to:</b> " + setting.imagearray[0][1] + "<br />"
	}
})
}else if(page=="data/content/categoryType.php" && type=='2'){
var mygallery=new fadeSlideShow({
	wrapperid: "fadeshow1", //ID of blank DIV on page to house Slideshow
	dimensions: [930, 300], //width/height of gallery in pixels. Should reflect dimensions of largest image
	imagearray: [
		[imageDir+"02.jpg", "?page=home.php", "_new", "ANNUAL SALE ช้อปสุดทาง เซลสุดแรง กว่า 5,000 ร้านค้า ปลุกกระแสช็อป ลดสูงสุด 70% (25 มิ.ย.- 1 ส.ค. 53)"],
		[imageDir+"06.jpg", "indexforuser.php?category=17", "_new", "รวบรวมคอลเลคชั่นหวานๆ แบบสาวเกาหลี กับช่วงลดกระหน่ำต้อนรับหน้าฝน"]
	],
	displaymode: {type:'auto', pause:5500, cycles:0, wraparound:false},
	persist: false, //remember last viewed slide and recall within same session?
	fadeduration: 1000, //transition duration (milliseconds)
	descreveal: "peekaboo",
	togglerid: "",
	oninit:function(curimage, index){
	
		var setting=this.setting
		var showid="<b>Slideshow ID:</b> " + setting.wrapperid + "<br />"
		var showdimensions="<b>Slideshow Dimensions:</b> " + setting.dimensions + "<br />"
		var totalimages="<b>Total Images:</b> " + setting.imagearray.length + "<br />"
		var firstimagelink="<b>First slide is hyperlinked to:</b> " + setting.imagearray[0][1] + "<br />"
	}
})
}
else if(page=="data/content/categoryType.php" && type=='3'){
var mygallery=new fadeSlideShow({
	wrapperid: "fadeshow1", //ID of blank DIV on page to house Slideshow
	dimensions: [930, 300], //width/height of gallery in pixels. Should reflect dimensions of largest image
	imagearray: [
		[imageDir+"02.jpg", "?page=home.php", "_new", "ANNUAL SALE ช้อปสุดทาง เซลสุดแรง กว่า 5,000 ร้านค้า ปลุกกระแสช็อป ลดสูงสุด 70% (25 มิ.ย.- 1 ส.ค. 53)"],
		[imageDir+"07.jpg", "indexforuser.php?category=16", "_new", "จำหน่ายรองเท้าหลากหลายรูปแบบ ไม่ซ้ำสไตล์ใคร มาทางนี้..."]
	],
	displaymode: {type:'auto', pause:5500, cycles:0, wraparound:false},
	persist: false, //remember last viewed slide and recall within same session?
	fadeduration: 1000, //transition duration (milliseconds)
	descreveal: "peekaboo",
	togglerid: "",
	oninit:function(curimage, index){
	
		var setting=this.setting
		var showid="<b>Slideshow ID:</b> " + setting.wrapperid + "<br />"
		var showdimensions="<b>Slideshow Dimensions:</b> " + setting.dimensions + "<br />"
		var totalimages="<b>Total Images:</b> " + setting.imagearray.length + "<br />"
		var firstimagelink="<b>First slide is hyperlinked to:</b> " + setting.imagearray[0][1] + "<br />"
	}
})
}else if(page=="data/content/categoryType.php" && type=='4'){
var mygallery=new fadeSlideShow({
	wrapperid: "fadeshow1", //ID of blank DIV on page to house Slideshow
	dimensions: [930, 300], //width/height of gallery in pixels. Should reflect dimensions of largest image
	imagearray: [
		[imageDir+"02.jpg", "?page=home.php", "_new", "ANNUAL SALE ช้อปสุดทาง เซลสุดแรง กว่า 5,000 ร้านค้า ปลุกกระแสช็อป ลดสูงสุด 70% (25 มิ.ย.- 1 ส.ค. 53)"],
		[imageDir+"08.jpg", "indexforuser.php?category=18", "_new", "เครื่องสำอางเทรนเกาหลี มีส่วนลด 15% และพร้อมรับสิทธิพิเศษอีกมากมาย"]
	],
	displaymode: {type:'auto', pause:5500, cycles:0, wraparound:false},
	persist: false, //remember last viewed slide and recall within same session?
	fadeduration: 1000, //transition duration (milliseconds)
	descreveal: "peekaboo",
	togglerid: "",
	oninit:function(curimage, index){
	
		var setting=this.setting
		var showid="<b>Slideshow ID:</b> " + setting.wrapperid + "<br />"
		var showdimensions="<b>Slideshow Dimensions:</b> " + setting.dimensions + "<br />"
		var totalimages="<b>Total Images:</b> " + setting.imagearray.length + "<br />"
		var firstimagelink="<b>First slide is hyperlinked to:</b> " + setting.imagearray[0][1] + "<br />"
	}
})
}else if(page=="data/content/categoryType.php" && type=='5'){
var mygallery=new fadeSlideShow({
	wrapperid: "fadeshow1", //ID of blank DIV on page to house Slideshow
	dimensions: [930, 300], //width/height of gallery in pixels. Should reflect dimensions of largest image
	imagearray: [
		[imageDir+"02.jpg", "?page=home.php", "_new", "ANNUAL SALE ช้อปสุดทาง เซลสุดแรง กว่า 5,000 ร้านค้า ปลุกกระแสช็อป ลดสูงสุด 70% (25 มิ.ย.- 1 ส.ค. 53)"],
		[imageDir+"09.jpg", "indexforuser.php?category=29", "_new", "เอาใจคนชอบ ทานอาหาร บุฟเฟ่ต์ ให้วันจันทร์ถึงวันพฤหัสบดีเป็น วันพิเศษของคุณ"]
	],
	displaymode: {type:'auto', pause:5500, cycles:0, wraparound:false},
	persist: false, //remember last viewed slide and recall within same session?
	fadeduration: 1000, //transition duration (milliseconds)
	descreveal: "peekaboo",
	togglerid: "",
	oninit:function(curimage, index){
	
		var setting=this.setting
		var showid="<b>Slideshow ID:</b> " + setting.wrapperid + "<br />"
		var showdimensions="<b>Slideshow Dimensions:</b> " + setting.dimensions + "<br />"
		var totalimages="<b>Total Images:</b> " + setting.imagearray.length + "<br />"
		var firstimagelink="<b>First slide is hyperlinked to:</b> " + setting.imagearray[0][1] + "<br />"
	}
})
}
else{
var mygallery=new fadeSlideShow({
	wrapperid: "fadeshow1", //ID of blank DIV on page to house Slideshow
	dimensions: [874, 300], //width/height of gallery in pixels. Should reflect dimensions of largest image
	imagearray: [
		<?
			echo "[imageDir+\"02.jpg\", \"?page=home.php\", \"_new\", \"ANNUAL SALE ช้อปสุดทาง เซลสุดแรง กว่า 5,000 ร้านค้า ปลุกกระแสช็อป ลดสูงสุด 70% (25 มิ.ย.- 1 ส.ค. 53)\"],";
		echo "[imageDir+\"04.jpg\", \"indexforuser.php?category=1\", \"_new\", \"เอาใจคนชอบ ทานอาหาร บุฟเฟ่ต์ ให้วันจันทร์ถึงวันพฤหัสบดีเป็น วันพิเศษของคุณ\"],";
		echo "[imageDir+\"10.jpg\", \"indexforuser.php?category=23\", \"_new\", \"ขนมหวานแสนอร่อย ไขมันต่ำ 0% สำหรับคนรักสุขภาพเช่นคุณ เมื่อซื้อสินค้าภายในร้าน ทุกๆ 200 บาท รับส่วนลดทันที่ 20% \"],";
		echo "[imageDir+\"09.jpg\", \"indexforuser.php?category=29\", \"_new\", \"ทุกครั้งที่มาใช้บริการและแสดงข้อความส่วนลด รับส่วนลดทันที 30% ทุกวันอังคารที่ 2 ของทุกเดือน\"],";
		echo "[imageDir+\"08.jpg\", \"indexforuser.php?category=18\", \"_new\", \"เครื่องสำอางเทรนเกาหลี มีส่วนลด 15% และพร้อมรับสิทธิพิเศษอีกมากมาย\"]";
						
		?>
		
	
	],
	displaymode: {type:'auto', pause:5500, cycles:0, wraparound:false},
	persist: false, //remember last viewed slide and recall within same session?
	fadeduration: 1000, //transition duration (milliseconds)
	descreveal: "peekaboo",
	togglerid: "",
	oninit:function(curimage, index){
	
		var setting=this.setting
		var showid="<b>Slideshow ID:</b> " + setting.wrapperid + "<br />"
		var showdimensions="<b>Slideshow Dimensions:</b> " + setting.dimensions + "<br />"
		var totalimages="<b>Total Images:</b> " + setting.imagearray.length + "<br />"
		var firstimagelink="<b>First slide is hyperlinked to:</b> " + setting.imagearray[0][1] + "<br />"
	}
})
}

 
</script>