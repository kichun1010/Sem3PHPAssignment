<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>deleteRecord.php</title>
</head>

<body>
<?php
$orderID = $_GET['orderID'];
$conn = mysqli_connect("127.0.0.1", "root", "", "projectdb")
or die(mysqli_connect_error());

$sql = "UPDATE orders SET status='3' WHERE orderID = '$orderID'";
$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
mysqli_close($conn);
header("Location:ManageOrder.php");

?>
</body>
</html>