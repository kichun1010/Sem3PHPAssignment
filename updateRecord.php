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
$partNumber = $_GET['partNumber'];
    $conn = mysqli_connect("127.0.0.1", "root", "", "projectdb")
    or die(mysqli_connect_error());
    $sql = "SELECT * FROM part WHERE partNumber = '$partNumber';";
    $rs = mysqli_query($conn, $sql)
    or die(mysqli_error($conn));
    $rc = mysqli_fetch_assoc($rs);
    $s = $rc['stockStatus'];
    if($s==0){
        $check0 = "checked";
        $check1 = "";
    }
    else {
        $check0 = "checked";
        $check1 = "";
    }

?>
<form name="form1" method="post" action="">
    <p>
        <label for="partNumber">Part Number : </label>
        <input name="partNumber" type="text" value="<?php echo $rc['partNumber']?>" readonly>
    </p>
    <p>
        <label for="partName">Part Name : </label>
        <input name="partName" type="text" value="<?php echo $rc['partName']?>" readonly>
    </p>
    <p>
        <label for="stockPrice">stockPrice : </label>
        <input name="stockPrice" type="text" value="<?php echo $rc['stockPrice']?>">
    </p>
    <p>
        <label for="stockQuantity">stockQuantity : </label>
        <input name="stockQuantity" type="text" value="<?php echo $rc['stockQuantity']?>">
    </p>

    <p>
        <label for="status">Status :</label>
        <label><input type="checkbox" name="status"value=0 <?php echo $check0 ?> disabled>Unavailable</label>
        <label><input type="checkbox" name="status" value=1 <?php echo $check1 ?> disabled>Available</label>
    </p>

    <input type="submit" value="Update Record" name="update_btn">
    <input type="button" value="Cancel" onclick="window.location.href='PartsInformation.php';" />
    <br>
</form>

<?php
if(isset($_POST['update_btn'])) {
    $email = $_COOKIE['staffEmail'];
    session_start();
    extract($_POST);
    date_default_timezone_set('Asia/Hong_Kong');
    //set timezone be HK
    $sql = "UPDATE part
	SET partNumber = '$partNumber'
	,partName='$partName',
	stockPrice='$stockPrice',
	stockQuantity='$stockQuantity',editPerson = '$email',editTime=NOW() WHERE partNumber = '$partNumber'";
    $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    mysqli_close($conn);
    setcookie("editPerson$partNumber","$email");
    setcookie("editTime$partNumber",date("Y-m-d h:i:sa"));
    echo '<script type="text/javascript">alert("The information are updated")</script>';
    header("Location:PartsInformation.php");
}
?>
</body>
</html>