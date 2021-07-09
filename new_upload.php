<?php
if ($_POST) 
{
    define('UPLOAD_DIR', 'uploads/');
    $img = $_POST['image'];
    $img = str_replace('data:image/jpeg;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
	$filename=uniqid(). '.jpg';
    $file = 'uploads/' . $filename ;
    $success = file_put_contents($file, $data);
	if ($success)
	{
		$LOC = $_POST['LOC'];
		$date_taken = date('d-m-y');
		$conn = new COM("ADODB.Connection") or die("Cannot start ADO"); 
		//$conn->Open("DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=F:\\inetpub\\wwwroot\\sitephotos\\gallery.mdb");
		//$sql = "insert into photo_gal_images(gal_id,img_filename,img_desc,img_date_taken) values($gal_id,'$filename','$img_desc','$date_taken') ";
		//$conn->Execute($sql);
	}
    print $success ? $file : 'Unable to save the file.';
}
?>