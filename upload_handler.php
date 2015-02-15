
<?php
//file upload

session_start();
$user_id = $_SESSION['user_id'];
echo $user_id;

$file=$_FILES["file"];
$check_file = ($file["type"]=="image/jpeg"||$file["type"]=="image/png"||$file["type"]=="image/bmp"||$file["type"]=="image/pjpeg")&&($file["size"]<2000000);
if($check_file)
{
	if($file["error"]>0)
	{
		echo "error: ".$file["error"];
	}
	else
	{
		if(file_exists("upload")==false)
		{
			mkdir("upload");
		}
		$timestamp = time();
		$file_dir = "./upload/".$timestamp."-".rand().".jpg";
		move_uploaded_file($file["tmp_name"],$file_dir);
		include "analyse.php";

//test codes
/*
		include_once "gray.php";
		$grayimg = 'gray/'.sha1($file_dir).'.jpg';
		grayjpg($file_dir, $grayimg);
		include "test.php";
		include_once "xml.php";
		$locs = array(' F',' LE',' Re',' N',' M');
		foreach($locs as $key=>$loc)
		{
			$newfile = face_compare($grayimg,$xml[$key],$loc);
			echo <<<EOT
				<img src="{$newfile}"><br>
EOT;

		}
		echo <<<EOT
			<form action="analyze.php" method="post">
			<input type="hidden" name="file_dir" value="{$file_dir}">
			<input type="submit" value="analyze">
			</form>
EOT;
*/
//test codes
	}
}
else
{
	echo "invalid file!";
}




?>

