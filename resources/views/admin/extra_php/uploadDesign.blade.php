<?php
	$front = base64_decode($_POST['front']);
	$back = base64_decode($_POST['back']);
	$json = $_POST['json'];
	$name = $_POST['name'];

    $servername = "localhost";
    $username = $_POST['db_user'];
    $password = $_POST['db_pass'];
    $dbname = $_POST['db_name'];

    $upload_dir = 'uploads/designs/'.$name;
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    file_put_contents($upload_dir.'/front.jpg', $front);
    file_put_contents($upload_dir.'/back.jpg', $back);

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    $json = $conn->real_escape_string($json);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    //echo "Connected successfully";
    $fu = $upload_dir . "/front.jpg";
    $bu = $upload_dir . "/back.jpg";

    $sql = "INSERT INTO predesigned (json, frontUrl, backUrl) VALUES('" . $json . "','" . $fu . "','" . $bu ."')";
    //echo $sql;
    $conn->query($sql);
?>
