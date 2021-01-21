<?php
	$root = $_SERVER["DOCUMENT_ROOT"];



	$image = $_POST['image'];
	$name = $_POST['name'];
	$message_photo = $_POST['message_photo'];
	$realImage = base64_decode($image);
//	echo $message_photo."<br/>";
	if ($message_photo == "1"){
	    $upload_dir = $root.'public/uploads/messages/';
	    //echo $upload_dir."<br/>";
	    if (!is_dir($upload_dir)) {
          // dir doesn't exist, make it
            mkdir($upload_dir, 0777, true);
        }
	}
	else{
	    $upload_dir = $root.'public/uploads/photos/';
	     //echo $upload_dir."<br/>";
	    if (!is_dir($upload_dir)) {
          // dir doesn't exist, make it
            mkdir($upload_dir, 0777, true);
        }
	}

	file_put_contents($upload_dir.$name, $realImage);
    echo "Image Uploaded Successfully.";
?>
