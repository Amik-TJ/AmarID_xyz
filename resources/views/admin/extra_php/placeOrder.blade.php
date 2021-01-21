<?php
$front = base64_decode($_POST['front']);
$back = base64_decode($_POST['back']);
$userID = (int)($_POST['user_id']);
$packageID = (int)($_POST['package_id']);
$glossy = (int)($_POST['glossy']);
$spot = (int)($_POST['spot']);
$rounded = (int)($_POST['rounded']);
$total_price = (double)($_POST['total_price']);
$phone = $_POST['phone'];
$address = $_POST['address'];
$label = $_POST['label'];
///
$images = json_decode($_POST['images']);
//echo $images;
// echo "<br>".gettype($images);

///


$servername = "localhost";
$username = $_POST['db_user'];
$password = $_POST['db_pass'];
$dbname = $_POST['db_name'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";

$sql = "INSERT INTO orders (userID, packageID, glossy, spot, rounded, total_price) VALUES(" . $userID . "," . $packageID . "," . $glossy . "," . $spot . "," . $rounded . "," . $total_price . ")";


if ($conn->query($sql) === TRUE) {
    $orderID = $conn->insert_id;

    //
    $upload_dir = 'uploads/orders/' . $orderID;
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    file_put_contents($upload_dir . '/front.jpg', $front);
    file_put_contents($upload_dir . '/back.jpg', $back);

//
    //$tmp = 1
    foreach ($images as &$img) {
        file_put_contents($upload_dir . '/img' . $tmp . 'jpg', base64_decode($img));
        $tmp = $tmp + 1;
    }

//
    $sql = "UPDATE orders SET orderUrl = '" . $upload_dir . "' WHERE orderID=" . $orderID;
    $conn->query($sql);
    $sql_delivery = "INSERT INTO delivery_address(orderID, label, address, phone) VALUES (" . $orderID . ",'" . $label . "','" . $address . "','" . $phone . "')";
    $conn->query($sql_delivery);
    echo $orderID;
    //
} else {
    die("Connection failed: ");
}
?>



