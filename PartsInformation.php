<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Parts Information</title>
    <link rel="stylesheet" href="Style.css" />
    <script type="text/javascript">
        function createItem() {

        }
    </script>
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
<h1>Information of Parts</h1>
<?php
$conn = mysqli_connect("127.0.0.1", "root", "", "projectdb")
or die(mysqli_connect_error());

?>
<table class="partInfo" width="100%" border="1">
    <form action="CreatePart.php" method="post" >
        <input type="submit" value="Add Part" id="add">
    </form>
    <form action="" method="post">
    <select class="search" name="dropDown">
        <option value="partNumber">Part Number</option>
        <option value="partName">Name</option>
    </select>
    <input type="text" placeholder="Search " name="search" id="searchBar">
        <input type="submit" value="search" name="submit" id="su">

    </form>
    <tr>
        <th>Part Number</th>
        <th>Name</th>
        <th>Unit Price($)</th>
        <th>Quantity In Stock</th>
<!--        <th>Location</th>-->
        <th>Last Edit Time</th>
        <th>Last Edit Person</th>
        <th>Stock Status</th>
        <th>Edit Information</th>
        <th>Add Part</th>
        <th>Remove Part</th>
<!--        <th>Description</th>-->

    </tr>

    <?php
    session_start();
    if(isset($_POST['submit'])) {
        if (!empty($_POST['dropDown']) && !empty($_POST['search'])) {
            $option = $_POST['dropDown'];
            $search = $_POST['search'];
            $sql = "SELECT * FROM part where $option LIKE '%$search%';";
            $rs = mysqli_query($conn, $sql)
            or die(mysqli_error($conn));
        } else {
            $sql = "SELECT * FROM part ;";
            $rs = mysqli_query($conn, $sql)
            or die(mysqli_error($conn));

        }
        while ($rc = mysqli_fetch_assoc($rs)) {
            $partNumber = $rc['partNumber'];
            if ($rc['stockStatus']==0){
                $status = "Unavailable";
            }
            else $status = "Available";
            ?>
            <tr>
                <td><?php echo $rc['partNumber'] ?></td>
                <td><?php echo $rc['partName'] ?></td>
                <td><?php echo $rc['stockPrice'] ?></td>
                <td><?php echo $rc['stockQuantity'] ?></td>
                <td><?php echo $rc['editTime'] ?></td>
                <td><?php echo $rc['editPerson'] ?></td>
                <td><?php echo $status ?></td>
                <td><a href="updateRecord.php?partNumber=<?php echo $rc['partNumber']?>">Edit Part</a></td>
                <td><a href="AddPart.php?partNumber=<?php echo $rc['partNumber']?>">Add Part</a></td>
                <td><a href="deleteRecord.php?partNumber=<?php echo $rc['partNumber']?>">Delete Part</a></td>
            </tr>
            <?php
        };
    }else{
            $sql = "SELECT * FROM part ;";
            $rs = mysqli_query($conn, $sql)
            or die(mysqli_error($conn));


        while ($rc = mysqli_fetch_assoc($rs)) {
            $partNumber = $rc['partNumber'];

            if ($rc['stockStatus']==0){
                $status = "Unavailable";
            }
            else $status = "Available";
            ?>
            <tr>
                <td><?php echo $rc['partNumber'] ?></td>
                <td><?php echo $rc['partName'] ?></td>
                <td><?php echo $rc['stockPrice'] ?></td>
                <td><?php echo $rc['stockQuantity'] ?></td>
                <td><?php echo $rc['editTime'] ?></td>
                <td><?php echo $rc['editPerson'] ?></td>
                <td><?php echo $status ?></td>
                <td><a href="updateRecord.php?partNumber=<?php echo $rc['partNumber']?>">Edit Part</a></td>
                <td><a href="AddPart.php?partNumber=<?php echo $rc['partNumber']?>">Add Part</a></td>
                <td><a href="deleteRecord.php?partNumber=<?php echo $rc['partNumber']?>">Remove Part</a></td>
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