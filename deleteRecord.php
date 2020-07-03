<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>deleteRecord.php</title>
</head>

<body>
<?php
$partNumber = $_GET['partNumber'];
        date_default_timezone_set('Asia/Hong_Kong');
$conn = mysqli_connect("127.0.0.1", "root", "", "projectdb")
or die(mysqli_connect_error());
//$sql = "SELECT * FROM part WHERE partNumber = '$partNumber';";
//$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
//if(mysqli_num_rows($rs)==1){
//    $sql = "DELETE FROM part WHERE partNumber = '$partNumber';";
//    $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
//    $num = mysqli_affected_rows($conn);
//
//    if($num !=1){
//        $message ="Record for partNumber '$partNumber' cannot be deleted!";
//    }
//} else {
//    $message = "Record is deleted by other users";
//}
//mysqli_close($conn);
    $email = $_COOKIE['staffEmail'];
$up = "UPDATE part SET stockStatus='0', editPerson = '$email',editTime=NOW() WHERE partNumber = '$partNumber'";
$rs = mysqli_query($conn, $up) or die(mysqli_error($conn));
mysqli_close($conn);
    
    setcookie("editPerson$partNumber","$email");
    setcookie("editTime$partNumber",date("Y-m-d h:i:sa"));
echo '<script type="text/javascript">alert("The part is now unavailable now")</script>';
header("Location:PartsInformation.php");
?>

</body>
</html>