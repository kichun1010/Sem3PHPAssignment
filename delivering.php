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
//$sql = "SELECT orders.orderID,dealer.dealerID,name,orderDate, deliveryAddress,part.partNumber,quantity,price,status,stockQuantity FROM orders,orderpart,dealer,part where part.partNumber = orderpart.partNumber AND orders.orderID=orderpart.orderID AND orders.dealerID = dealer.dealerID AND orders.orderID ='$orderID' ;";
//$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
//$rc = mysqli_fetch_assoc($rs);

$qty = "SELECT orderID,part.partNumber,quantity,stockQuantity FROM orderpart,part WHERE orderID = $orderID AND part.partNumber = orderpart.partNumber";
$r = mysqli_query($conn, $qty) or die(mysqli_error($conn));
while($ra = mysqli_fetch_assoc($r)){
    $quantity = $ra['quantity'];
    $stockquantity = $ra['stockQuantity'];
    $partNumber = $ra['partNumber'];
    $total = $stockquantity-$quantity;
    $qty = "UPDATE part SET stockQuantity = $total where partNumber = $partNumber";
    $r = mysqli_query($conn, $qty) or die(mysqli_error($conn));
    print_r($quantity);
}




$sql = "UPDATE orders SET status='1' WHERE orderID = '$orderID'";
$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
mysqli_close($conn);
echo '<script type="text/javascript">alert("The status is set to be deliveried")</script>';
header("Location:ManageOrder.php");

?>
</body>
</html>