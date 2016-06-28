<?php 
include("../../../../../framework/datasource/connect.php");
include ("../../../../../framework/datasource/config.php");

 session_start();	
class imagesUp
{
	
	function images($obj)
	{
				global $Config ;
				$this->mdb=new ConnectDB;
		
				if($_SESSION["Session_User_UserID"]){
					$array=$_FILES['file'];
					if ($array['name']) {
		            if (!$array['error']) {
						date_default_timezone_set('Asia/Bangkok');
		            	$tims =time();
						$Datef=Date("Y-m-d");
						$Timef=Date("H-i-s");
						$Fname="file_".$Datef."_".$Timef;

		                $name = $Fname."".md5(rand(001, 2999));
		                $ext = explode('.', $array['name']);
		                $filename = $name . '.' . $ext[1];
		                $destination = '../../../../Upload/Smn/' . $filename; //change this directory
		                $location = $array["tmp_name"];
		                $check = move_uploaded_file($location, $destination);
		                
		                if($check){
		                	
		            $servername = $Config["hostname_connect"];
					$username = $Config["username_connect"];
					$password = $Config["password_connect"];
					$dbname = $Config["database_connect"];

					// Create connection
					$conn = mysqli_connect($servername, $username, $password, $dbname);
					// Check connection
					if (!$conn) {
					    die("Connection failed: " . mysqli_connect_error());
					}
					$user=$_SESSION["Session_User_UserID"];
					$sql="insert into multi_media(multiUrl,status,version,Owner,creationTime,creationUser,whenModified) values('$filename','Open',1,'deedev',now(),'$user',now())";

					if (mysqli_query($conn, $sql)) {

				    	echo $filename;
					
					}else{
				    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
						}

					mysqli_close($conn);

					}

		            }
		            else
		            {
		              echo  $message = 'Ooops!  Your upload triggered the following error:  '.$array['error'];
		            }
		        }
		    }else{
		    	echo "";
		    }

	}

}
	$array=$_FILES['file'];
	$newImages= new imagesUp();
	$oImages=$newImages->images($array);


 ?>