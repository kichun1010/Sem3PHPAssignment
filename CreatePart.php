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
$conn = mysqli_connect("127.0.0.1", "root", "", "projectdb")
or die(mysqli_connect_error());
?>
<form name="form1" method="post" action="">
    <p>
        <label for="partName">Part Name : </label>
        <input name="partName" type="text" >
    </p>
    <p>
        <label for="stockPrice">stockPrice : </label>
        <input name="stockPrice" type="text" >
    </p>
    <p>
        <label for="stockQuantity">stockQuantity : </label>
        <input name="stockQuantity" type="text" >
    </p>
    <p>
        <label for="status">Status :</label>
        <label><input type="checkbox" name="status" value="0" >Unavailable</label>
        <label><input type="checkbox" name="status" value="1" >Available</label>
    </p>
    <input type="submit" value="Create Part" name="update_btn">
    <input type="button" value="Cancel" onclick="window.location.href='PartsInformation.php';" />
    <br>
</form>

<?php
$email = $_COOKIE['staffEmail'];
date_default_timezone_set('Asia/Hong_Kong');
if(isset($_POST['update_btn'])) {
    extract($_POST);

    $sql = "INSERT INTO part(email, partName, stockQuantity, stockPrice, stockStatus,editPerson,editTime) VALUES ('$email','$partName','$stockQuantity','$stockPrice','$status','$email',NOW())";
    $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    mysqli_close($conn);
    echo '<script type="text/javascript">alert("The new part is recorded")</script>';
    header("Location:PartsInformation.php");
}
?>
</body>
</html>