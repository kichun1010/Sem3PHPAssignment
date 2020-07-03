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
//$sql = "SELECT orders.orderID,dealer.dealerID,name,orderDate, deliveryAddress,partNumber,quantity,price,status FROM orders,orderpart,dealer where orders.orderID=orderpart.orderID AND orders.dealerID = dealer.dealerID AND orders.orderID ='$orderID' ;";
//$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
//$rc = mysqli_fetch_assoc($rs);
//$quantity = $rc['quantity'];
//if(mysqli_num_rows($rs)==1){
//    $sql = "DELETE FROM orderpart WHERE orderID ='$orderID' ;";
//    $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
//    $num = mysqli_affected_rows($conn);
//
//    if($num !=1){
//        $message ="Record for OrderID '$orderID' cannot be deleted!";
//    }
//} else {
//    $message = "Record is deleted by other users";
//}
//mysqli_close($conn);
//header("Location:ManageOrder.php?msg=".urlencode($message));
$email = $_COOKIE['staffEmail'];
    $up = "UPDATE orders,part SET status='2' WHERE orderID = '$orderID'";
    $rs = mysqli_query($conn, $up) or die(mysqli_error($conn));
    mysqli_close($conn);
    echo '<script type="text/javascript">alert("The order has been canceled")</script>';
    header("Location:ManageOrder.php");

?>
</body>
</html>