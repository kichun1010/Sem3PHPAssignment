<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Order Detail</title>
    <link rel="stylesheet" href="Style.css" />

</head>

<body>
    <div class="menu">
        <nav class="navbar">
            <ul class="right-menu">
                <li><a href="HomePage.php" target="content"><img src="picture/HomePage.png" alt=""><br> Home</a></li>
                <li><a href="PartsInformation.php" target="content"><img src="picture/folder-128.png" alt=""><br> Parts Information</a></li>
                <li><a href="ManageOrder.php" target="content"><img src="picture/order-128.png" alt=""> <br>Manage Order</a></li>
                <li><a href="javascript://" onclick="self.parent.location='Login.php'" target=""><img src="picture/LogOut.jpg" alt=""> <br>Log Out</a></li>
            </ul>
        </nav>
    </div>
    <a href="HomePage.php"><img src="picture/CompanyName.png" alt=""></a>
    <h1>Order Detail</h1>

    <?php
$orderID = $_GET['orderID'];
$conn = mysqli_connect("127.0.0.1", "root", "", "projectdb")
or die(mysqli_connect_error());
$sql = "SELECT orders.orderID,dealer.dealerID,name,orderDate, deliveryAddress,partNumber,quantity,price,status FROM orders,orderpart,dealer where orders.orderID=orderpart.orderID AND orders.dealerID = dealer.dealerID AND orders.orderID ='$orderID';";
$rs = mysqli_query($conn, $sql)
or die(mysqli_error($conn));
$rc = mysqli_fetch_assoc($rs);
$dealerID = $rc['dealerID'];
$name = $rc['name'];
$orderDate = $rc['orderDate'];
$deliveryAddress = $rc['deliveryAddress'];
            if($rc['status']==0)
                $status = "In Processing";
            else if($rc['status']==1)
                $status = "Delivering";
            else if($rc['status']==2)
                $status = "Canceled";
            else $status = "Completed";

            echo "<h3>Order ID : $orderID</h3>";
            echo "<h3>Dealer ID : $dealerID</h3>";
            echo "<h3>Dealer Name : $name</h3>";
            echo "<h3>Order Date : $orderDate</h3>";
            echo "<h3>Delivery Address : $deliveryAddress</h3>";
            echo "<h3>Status : $status</h3>";

?>

    <table width="100%" border="1" class="orderMan">

        <tr>
            <th scope="col">Part Number</th>
            <th scope="col">Quantity</th>
            <th scope="col">Total Price</th>
            <th scope="col">Edit Order</th>
        </tr>
        <?php
        $sql = "SELECT orders.orderID,dealer.dealerID,name,orderDate, deliveryAddress,partNumber,quantity,price,status FROM orders,orderpart,dealer where orders.orderID=orderpart.orderID AND orders.dealerID = dealer.dealerID AND orders.orderID ='$orderID';";
$result = mysqli_query($conn, $sql)
or die(mysqli_error($conn));
        while ($rd = mysqli_fetch_assoc($result)) {

            ?>
        <tr>
            <td>
                <?php echo $rd['partNumber']; ?>
            </td>
            <td>
                <?php echo $rd['quantity']; ?>
            </td>
            <td>
                <?php echo $rd['price']; ?>
            </td> 
                <td><a href="updateOrder.php?orderID=<?php echo $rc['orderID']?>">Edit Order</a></td>
        </tr>
        <?php
        };
    mysqli_free_result($rs);
    mysqli_close($conn);
    ?>



    </table>

</body>

</html>
