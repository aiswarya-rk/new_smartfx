<?php
include 'connection.php';
session_start();
$emailErr=$email=$password=$pswdErr="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
        $emailErr = "*Email is required";
    } 
    else {
        $email = $_POST["email"];
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
           $emailErr = "Invalid email format";
        }
      }
    if(!empty($_POST["password"])) {
        $password = $_POST["password"];
    }
    else{
        $pswdErr = "*Password is required!"; 
    }
    if(isset($email) && $email!="" && (isset($password) && $password!=""))
    {
    $select = "SELECT * FROM tbl_users WHERE email = '$email' && password ='$password'" ;
    $result = mysqli_query($conn , $select);
    if(mysqli_num_rows($result)>0){
            $row = mysqli_fetch_array($result);
            if($row['status'] == 'pending'){
                echo "<script type ='text/javascript'>
		        alert('Please wait!! Your account is now pending for approval!');
		        window.location.href='login.php';
	            </script>";
            }
            elseif($row['type']==1)
            {
                $_SESSION['admin_name']=$row['email'];
                header('location:home_admin.php');
            }
            else
            {
                $_SESSION['id']=$row['id'];
                $_SESSION['name']=$row['user_name'];
                $_SESSION['user_name']=$row['email'];
                header('location:home_user.php');
            }
     }
     else{
                echo "<script type ='text/javascript'>
                alert('incorrect email or password!');
                window.location.href='login.php';
               </script>";
         }  
    }
}
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<title>Login</title>
    <style>
    .error {color: #FF0000;}   
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        body{
            background: white;
        }
        .row{
            background: lightgrey;
            border-radius: 30px;
            box-shadow: 12px 12px 22px grey;
        }
        img{
           border-top-left-radius: 10px;
           border-bottom-left-radius: 10px;
        }
        .btn1{
           border: none;
            outline: none;
            height: 50px;
            width: 100%;
            background-color: black;
            color: white;
            border-radius: 4px;
            font-weight: bold;
        }
        .btn1:hover{
            background: white;
            border: 1px solid;
            color: black;           
        }
    </style>
</head>
<body>
<section class="Form my-4 mx-5">
<div class="container">
<div class="row no-gutters">
<div class="col-lg-5">
    <img src="upload/Ergonomic%20Birch%20Wood%20Laptop%20Stand.jpg" class="img-fluid" alt="">
</div>
<div class="col-lg-7 px-5 pt-5">
    <h1 class="font-weight-bold py-3">Login</h1>
    <h4>Sign in to your account</h4>
    <form action="login.php" method="post">
        <div class="form-row">
            <div class="col-lg-7">
                <input type="email" name="email" placeholder="email" class="form-control my-3 p-4">
                <span class="error"><?php echo $emailErr;?></span>
            </div>
        </div>
        <div class="form-row">
            <div class="col-lg-7">
                <input type="password" name="password" placeholder="password" class="form-control my-3 p-4">
                <span class="error"><?php echo $pswdErr;?></span>
            </div>
        </div>
        <div class="form-row">
            <div class="col-lg-7">
                <button type="submit" class="btn1 mt-3 mb-5">Login</button>
            </div>
        </div>
        <p><b>Don't have an account? <a class="register" href="register.php">Register Instead</a></b></p>
    </form> 
</div>
</div>
</div>
</section>
</body>
</html>