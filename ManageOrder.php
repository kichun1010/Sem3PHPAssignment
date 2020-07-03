<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Order</title>
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
<h1>Order Management</h1>
<?php
$conn = mysqli_connect("127.0.0.1", "root", "", "projectdb")
or die(mysqli_connect_error());
?>
<form>
<select class="search" name="dropDown" size="1">
    <option value="">All</option>
    <option value="orderID">OrderID</option>
    <option value="dealerID">DealerID</option>
    <option value="status">Status</option>
</select>
<input type="text" placeholder="Search " name="search" id="searchBar">
    <input type="submit"value="search" name="submitbtn">
</form>
<input name="orderID" type="hidden" id="orderID">
<table width="100%" border="1" class="orderMan">

    <tr>
        <th scope="col">Order ID</th>
        <th scope="col">Dealer ID</th>
        <th scope="col">Dealer Name</th>
        <th scope="col">Order Date</th>
        <th scope="col">Delivery Address</th>
        <th scope="col">Status</th>
        <th>Order Detail</th>
        <th>Delivery Order</th>
        <th>Cancel Order</th>
    </tr>
<?php
if(isset($_POST['submitbtn'])) {
    if (!empty($_POST['dropDown']) && !empty($_POST['search'])) {
            $option = $_POST['dropDown'];
            $search = $_POST['search'];
        if ($option == 'dealerID') {
            $sql = "SELECT orderID,dealer.dealerID,name,orderDate, deliveryAddress,status FROM orders,dealer where orders.dealerID = dealer.dealerID AND dealer.dealerID LIKE '%$search%' ;";
        } else {
            $sql = "SELECT orders.orderID,dealer.dealerID,name,orderDate, deliveryAddress,status FROM orders,dealer where orders.dealerID = dealer.dealerID AND $option LIKE '%$search%' ;";
        }
        $rs = mysqli_query($conn, $sql)
        or die(mysqli_error($conn));
        
    } else {
        $sql = "SELECT orders.orderID,dealer.dealerID,name,orderDate, deliveryAddress,status FROM orders,dealer where orders.dealerID = dealer.dealerID;";
        $rs = mysqli_query($conn, $sql)
        or die(mysqli_error($conn));
    }

    while ($rc = mysqli_fetch_assoc($rs)) {

        if($rc['status']==0)
            $status = "In Processing";
        else if($rc['status']==1)
            $status = "Delivering";
        else if($rc['status']==2)
            $status = "Canceled";
        else $status = "Completed";
        ?>
        <tr>
            <td><?php echo $rc['orderID'] ?></td>
            <td><?php echo $rc['dealerID']; ?></td>
            <td><?php echo $rc['name']; ?></td>
            <td><?php echo $rc['orderDate']; ?></td>
            <td><?php echo $rc['deliveryAddress']; ?></td>
            <td><?php echo $status ?></td>
            <td><input type="button" value="Order Detail" onClick="setValue('<?php echo $rc['orderID']?>');"></td>
            <td><a href="delivering.php?orderID=<?php echo $rc['orderID']?>">Delivery Order</a></td>
            <td><a href="deleteOrder.php?orderID=<?php echo $rc['orderID']?>">Cancel Order</a></td>
        </tr>
        <?php
    };
}else{
            $sql = "SELECT orderID,dealer.dealerID,name,orderDate, deliveryAddress,status FROM orders,dealer where  orders.dealerID = dealer.dealerID;";
            $rs = mysqli_query($conn, $sql)
            or die(mysqli_error($conn));

        while ($rc = mysqli_fetch_assoc($rs)) {
            if($rc['status']==0)
                $status = "In Processing";
            else if($rc['status']==1)
                $status = "Delivering";
            else if($rc['status']==2)
                $status = "Canceled";
            else $status = "Completed";
        ?>
    <tr>
        <td><?php echo $rc['orderID'] ?></td>
        <td><?php echo $rc['dealerID']; ?></td>
        <td><?php echo $rc['name']; ?></td>
        <td><?php echo $rc['orderDate']; ?></td>
        <td><?php echo $rc['deliveryAddress']; ?></td>
        <td><?php echo $status ; ?></td>
        <td><a href="OrderDetail.php?orderID=<?php echo $rc['orderID']?>">Order Detail</a></td>
        <td><a href="delivering.php?orderID=<?php echo $rc['orderID']?>">Delivery Order</a></td>
        <td><a href="deleteOrder.php?orderID=<?php echo $rc['orderID']?>">Cancel Order</a></td>
    </tr>
    <?php
    };
}
            mysqli_free_result($rs);
            mysqli_close($conn);
        ?>



</table>
</body>
</html>