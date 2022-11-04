<?php
include 'connection.php';
session_start();
if(!isset($_SESSION['user_name'])){
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Shared page</title>
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
      img{
          width: 200px;
      }
      table {
            width:  90%;
        }
</style>
</head>
<body>
<div class="container">
<br><br><h2>Welcome <span><?php echo $_SESSION['name']; ?></span></h2>
<p align="right"> <b>Logout Here <a href="logout.php">Logout </a> </b> </p>
<a align="right" href="home_user.php"><h4>Go Back to Home Screen</h4></a><br>
<h1 align="center">Public files</h1><br>  
<?php
// $url = htmlspecialchars($_SERVER['HTTP_REFERER']); // Back Button
//echo "<a href='$url'>Go Back to Home Screen</a>"; 
?>
<table>
 <tr>
  <th> SI No </th>
  <th> title </th>
  <th> description </th>  
  <th> files </th>
  <th> Download </th>
 </tr>  
 <?php
    $user = $_SESSION['user_name'];
    $id = $_SESSION['id'];
    $query = "SELECT * FROM file_upload WHERE TINY_URL=1"; // tiny_url =1 means shared files
    $result = mysqli_query($conn ,$query);
    $i=0;
    while(  $row = mysqli_fetch_array($result)){
        $i++;
        $img =$row['file_name']; 
        $filename_sep=explode('.',$img);
        $file_extension=strtolower(end($filename_sep));
  ?>
  <tr>
    <td><?php echo $i; ?></td>
    <td><?php echo $row['title']; ?></td>
    <td style="word-break: break-all;"><?php echo $row['description']; ?></td>
    <td><img src="<?php echo $img; ?>"/>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $file_extension."    -file"; ?></td> 
    <td><a href="download.php?file=<?php echo $img ; ?>">Download Here</a></td>      
  </tr>
  <?php
    }
  ?>   
</table>
</div>
</body>
</html>
