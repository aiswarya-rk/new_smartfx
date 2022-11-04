<?php
include 'connection.php';
$result=$username=$emailErr=$email=$password=$conf_password=$pswdErr="";
//validation for email
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["username"]; 
    if(empty($_POST["email"])) {
        $emailErr = "Email is required";
    } 
    else {     
        // check if e-mail address is well-formed
        if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
        else{
             $email = $_POST["email"];
        }
    }
    //validation for password
    if(!empty($_POST["password"]) && ($_POST["password"] == $_POST["conf_password"])) {
        $password = $_POST["password"];
        $conf_password = $_POST["conf_password"];
    }
    else{
        $pswdErr = "Password and Confirm password should match!"; 
    }
    //checking if email id already taken or not
    if(isset($email) && $email!="" && ($_POST["password"] == $_POST["conf_password"])) {
    $select= "SELECT * FROM tbl_users where email = '$email'";
    $result = mysqli_query($conn,$select);  
        if(mysqli_num_rows($result) > 0){
            echo "<script type ='text/javascript'>
                  alert('Email already Taken!');
                  window.location.href='register.php';
                  </script>";       
        }else{
            // insert in to table 
            $register = "INSERT INTO tbl_users(user_name,email,password,conf_password,status,type) VALUES ('$username','$email','$password','$conf_password','pending',0)";
            mysqli_query($conn,$register);
            echo "<script type ='text/javascript'>
                  alert('your account is now pending for approval!');
                  window.location.href='login.php';
                  </script>";
        }
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <style>
.error {color: #FF0000;}
</style>
</head>
<body>
<div class="container">
    <br><br><br><h1>Registration</h1>
    <form action="register.php" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Username:*</label>
            <input type="text" name="username" class="form-control" required/>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:*</label>
            <span class="error"><?php echo $emailErr ;?></span>
            <input type="text" name="email" class="form-control required/"><br>
        </div>       
        <div class="mb-3">
            <label for="password" class="form-label">Password:*</label>
            <input type="password" name="password" class="form-control" required/><br>
        </div>
        <div class="mb-3">
            <label for="conf_password" class="form-label">Confirm Password:*</label>
            <span class="error"><?php echo $pswdErr ;?></span>
            <input type="password" name="conf_password" class="form-control" required/><br>
            
        </div>
            <input type="submit" name="register"  class="btn btn-primary" value="Register"><br><br>
        Already acount? <a href="login.php">Login here</a>
    </form>
</div>
</body>
</html>
