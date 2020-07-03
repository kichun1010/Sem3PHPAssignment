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
<?php
$orderID = $_GET['orderID'];
$conn = mysqli_connect("127.0.0.1", "root", "", "projectdb")
or die(mysqli_connect_error());
$sql = "SELECT orders.orderID,dealer.dealerID,name,orderDate, deliveryAddress,partNumber,quantity,price,status FROM orders,orderpart,dealer where orders.orderID=orderpart.orderID AND orders.dealerID = dealer.dealerID AND orders.orderID ='$orderID' ;";
$rs = mysqli_query($conn, $sql)
or die(mysqli_error($conn));
$rc = mysqli_fetch_assoc($rs);
$s = $rc['status'];
if($s==0){
    $check0 = "checked";
    $check1 = "";
    $check2 = "";
    $check3 = "";
}
    elseif($s == 1){
    $check0 = "";
    $check1 = "checked";
    $check2 = "";
    $check3 = "";
}elseif($s==2){
    $check0 = "";
    $check1 = "";
    $check2 = "checked";
    $check3 = "";
}else{
    $check0 = "";
    $check1 = "";
    $check2 = "";
    $check3 = "checked";
}
?>
<form name="form1" method="post" action="">
    <p>
        <label for="orderID">Order ID : </label>
        <input name="orderID" type="text" value="<?php echo $rc['orderID']?>" readonly>
    </p>
    <p>
        <label for="dealerID">Dealer ID : </label>
        <input name="dealerID" type="text" value="<?php echo $rc['dealerID']?>"readonly>
    </p>
    <p>
        <label for="name">Dealer Name : </label>
        <input name="name" type="text" value="<?php echo $rc['name']?>"readonly>
    </p>
    <p>
        <label for="orderDate">Order Date : </label>
        <input name="orderDate" type="text" value="<?php echo $rc['orderDate']?>">
    </p>
    <p>
        <label for="deliveryAddress">Delivery Address : </label>
        <input name="deliveryAddress" type="text" value="<?php echo $rc['deliveryAddress']?>">
    </p>

    <p>
        <label for="partNumber">Part Number : </label>
        <input name="partNumber" type="text" value="<?php echo $rc['partNumber']?>"readonly>
    </p>

    <p>
        <label for="quantity">Quantity : </label>
        <input name="quantity" type="text" value="<?php echo $rc['quantity']?>">
    </p>

    <p>
        <label for="price">Price : </label>
        <input name="price" type="text" value="<?php echo $rc['price']?>">
    </p>
    <p>
        <label for="status">Status :</label>
        <label><input type="checkbox" name="status" value="0" <?php echo $check0 ?> disabled>In Processing</label>
        <label><input type="checkbox" name="status" value="1" <?php echo $check1 ?> disabled>Delivering</label>
        <label><input type="checkbox" name="status" value="2" <?php echo $check2 ?> disabled>Canceled</label>
        <label><input type="checkbox" name="status" value="3" <?php echo $check3 ?> disabled>Completed</label>
    </p>
    <input type="submit" value="Update Record" name="update_btn">
    <input type="button" value="Cancel" onclick="window.location.href='ManageOrder.php';" />
    <br>
</form>

<?php
if(isset($_POST['update_btn'])) {
    extract($_POST);

    $sql = "UPDATE orders,orderpart,dealer SET orderDate='$orderDate',deliveryAddress= '$deliveryAddress',quantity = '$quantity',price = '$price' WHERE orders.orderID = '$orderID' AND partNumber = '$partNumber'";
    $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    mysqli_close($conn);
    echo '<script type="text/javascript">alert("The information are updated")</script>';
    header("Location:ManageOrder.php");
}
?>
</body>
</html>