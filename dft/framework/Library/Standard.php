<?php
	function alerts($keys)
	{
			if($keys=="save")
		{

				return "<script>
		(function($){
		noty({
				text: '<strong>แจ้งเตือนจากระบบ!</strong><br>บันทึกข้อมูลสำเร็จ.',
				type: 'success',
				timeout: 2000
			});
		})(jQuery);
					</script>";
			}
			elseif($keys=="update")
		{
				return "<script>
		(function($){
		noty({
				text: '<strong>แจ้งเตือนจากระบบ!</strong><br>อัพเดตข้อมูลสำเร็จ.',
				type: 'warning',
				timeout: 2000
			});
		})(jQuery);
					</script>";
			}
			elseif($keys=="del")
		{
				
				return "<script>
		(function($){
		noty({
				text: '<strong>แจ้งเตือนจากระบบ!</strong><br>ลบข้อมูลสำเร็จ.',
				type: 'error',
				timeout: 2000
			});
		})(jQuery);
					</script>";
			}
			else
		{
				return "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button><strong>".$keys."</strong></div>";
			}
			
	}

	
	function breadcrumbs($separator = ' / ', $home = 'หน้าแรก')
	{
		
	

		//return $navi;
	}
	
	function convertsize($size)
 {
    $unit=array('b','kb','mb','gb','tb','pb');
    return @round($size/pow(1024,($i=floor(log($size,1024)))),6).' '.$unit[$i];
 }
 function diff2time($time_a,$time_b){  
    $now_time1=strtotime(date("Y-m-d ".$time_a));  
    $now_time2=strtotime(date("Y-m-d ".$time_b));  
    $time_diff=abs($now_time2-$now_time1);  
	return $time_diff;
}
 function difftime($time_diff)
{
	 $time_diff_h=floor($time_diff/3600); // จำนวนชั่วโมงที่ต่างกัน  
    $time_diff_m=floor(($time_diff%3600)/60); // จำวนวนนาทีที่ต่างกัน  
    $time_diff_s=($time_diff%3600)%60; // จำนวนวินาทีที่ต่างกัน  
    return $time_diff_h." ชั่วโมง ".$time_diff_m." นาที ".$time_diff_s." วินาที";  
}
 function difftime_m($time_diff)
{
	 $time_diff_h=floor($time_diff/3600); // จำนวนชั่วโมงที่ต่างกัน  
    $time_diff_m=floor(($time_diff%3600)/60); // จำวนวนนาทีที่ต่างกัน  
    $time_diff_s=($time_diff%3600)%60; // จำนวนวินาทีที่ต่างกัน  
    return $time_diff_m;
}
 function makedir($dir)
{
	 mkdir($dir,0755,true);
}
function get_random($matches)
{
	//echo $matches[1]."<br>";
    $rand = array_rand($split = explode("|", $matches[1]));
    return $split[$rand];
}
 
function show_randomized($str)
{
    $new_str = preg_replace_callback('/\{([^{}]*)\}/im', "get_random", $str);
    if ($new_str !== $str) $str = show_randomized($new_str);
    return $str;
}


?>