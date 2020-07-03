<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="Style.css" />
</head>

<body>
<?php
//if the remember me check box is checked, the cookies will create to store the ID  and expired after 3days
if(isset($_POST['remember'])){
    setcookie("id",$_POST['email'],time()+3600*72);
}else{
    //else the cookie will be empty string
    setcookie("id","");
}
?>
<img src="picture/CompanyName.png" alt="" id="Logo">
<form action="Login.php" method="post" class="login">
    <div class="loginForm">
        <div class="user">
            <label><b>Email</b></label>
            <input type="text" name="email" value="<?php if(isset($_COOKIE["id"])){ echo $_COOKIE["id"];}?>"/ required>
        </div>
        <label><b>Password</b></label>
        <input type="password" name="pw"  minlength="8" maxlength="16" required/>
        <label>
            <input type="checkbox" <?php if(isset($_COOKIE["id"])) echo "checked";?> name="remember"> Remember me
        </label>
        <button type="submit" name="submit">Login</button>
    </div>

    <div class="LoginForm">
        <span><a href="RegisterAccount.html">Register Account</a></span>
        <!--<span><a href="HomePage_D.html">Login to dealer page</a></span>-->
    </div>
</form>
<?php
if(isset($_POST['submit'])) {
    session_start();
    if (!empty($_POST['email']) && !empty($_POST['pw'])) {
        $email = $_POST['email'];
        $pw = $_POST['pw'];
        //connect the database
        $conn = mysqli_connect("127.0.0.1", "root", "", "projectdb")
        or die(mysqli_connect_error());
        $admin = "SELECT * FROM administrator where email = '$email' and password = '$pw';";
        $dealer = "SELECT * FROM dealer where dealerID = '$email' and password = '$pw';";
        // To  select the data which match with the email and password,

        $adminRs = mysqli_query($conn, $admin)
        or die(mysqli_error($conn));
        $dealerRs = mysqli_query($conn, $dealer)
        or die(mysqli_error($conn));

        $adminRc = mysqli_fetch_assoc($adminRs);
        $dealerRc = mysqli_fetch_assoc($dealerRs);

        //if the remember me check box is checked, the cookies will create to store the ID and Password and expired after 3days
        if(isset($_POST['remember'])){
            setcookie("id",$email,time()+3600*72);
            setcookie("pwd",$pw,time()+3600*72);
        }else{
            //else the cookie will be empty string
            setcookie("id","");
            setcookie("pwd","");
        }

        //check if the selected admin data = enter data ,then it is a admin account else it is a dealer account else the information is incorrect
        if ($adminRc['email'] == $email && $adminRc['password'] == $pw) {
            echo '<script type="text/javascript">alert("Login Successful")</script>';
            header("location:HomePage.php");
            $_SESSION['name'] = $adminRc['firstName'];
            setcookie("staffEmail",$email,time()+3600*72);
            //use session to store the name and pass it to the home page

        } elseif ($dealerRc['dealerID'] == $email && $dealerRc['password'] == $pw) {
            echo '<script type="text/javascript">alert("Login Successful")</script>';
            header("location:HomePage_D.html");
            $_SESSION['name'] = $dealerRc['name'];
            $_SESSION['dealerID'] = $dealerRc['dealerID'];

        } else {
            echo '<script type="text/javascript">alert("Incorrect Email or Password, Please enter again!!")</script>';
            }
    } else {
        echo '<script type="text/javascript">alert("Please enter your email and password!")</script>';
    }

//    mysqli_close($conn);
}
    ?>
</body>

</html>