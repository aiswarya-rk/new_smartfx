<?php
 include 'connection.php';
 session_start();
 if(!isset($_SESSION['admin_name'])){
    header('location:login.php');
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Approval Page</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <style>
table, th, td {
  border: 2px solid;
}
        th, td {
  padding-top: 10px;
  padding-bottom: 20px;
  padding-left: 30px;
  padding-right: 40px;
}
</style>
</head>
<body>
<div class="container">
    <br><br><h3>Welcome Admin</h3>
<h1>User Approval</h1><br><br>
<table id="users" style="width:90%">
 <tr>
    <th> SI No </th>
    <th> User Name </th>
    <th> Email Address </th>
    <th> Action </th>
</tr>  
<?php
    $query = "SELECT * FROM tbl_users WHERE STATUS = 'pending' ORDER BY id ASC";
    $result = mysqli_query($conn ,$query);
    $i=0;
 while(  $row = mysqli_fetch_array($result)){
     $i++;
?>
    <tr>
        <td><?php echo $i ;?></td>
        <td><?php echo $row['user_name']; ?></td>
        <td><?php echo $row['email']; ?></td>   
        <td>
            <form action="home_admin.php" method="POST">
                <input type ="hidden" name ="id" value = "<?php echo $row['id']; ?>"/>
                <input type ="submit" name ="approve" class="btn btn-primary" value = "Approve"/>
                <input type ="submit" name ="deny" class="btn btn-primary" value = "Deny"/>     
            </form>
        </td>
    </tr>
       <?php
    }
    ?>   
 </table>
    <br><br>Register Here <a class="register" href="register.php">Register</a>
<p align="right"> <b>Logout Here <a href="logout.php">Logout </a> </b> </p>

</div>
  <?php  
    require 'connection.php';
    if(isset($_POST['approve'])){
        $id = $_POST['id'];
        $select ="UPDATE tbl_users SET STATUS = 'approved' WHERE id='$id'";
        $result= mysqli_query($conn,$select);
        echo '<script type ="text/javascript">';
        echo 'alert("User Approved!");';
        echo 'window.location.href="home_admin.php"';
        echo '</script>'; 
    }
     if(isset($_POST['deny'])){
        $id = $_POST['id'];
        $select ="DELETE FROM tbl_users  WHERE id='$id'";
        $result= mysqli_query($conn,$select);
        echo '<script type ="text/javascript">';
        echo 'alert("User Denied!");'; 
        echo 'window.location.href="home_admin.php"';
        echo '</script>'; 
    }
 ?>
</body>
</html>
