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
    <title>user page </title>
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
<br><h3>Welcome <span><?php echo $_SESSION['name']; ?></span></h3>
<p align="right"> <b>Logout Here <a href="logout.php">Logout </a> </b> </p>
  <form method="POST" action="home_user.php" enctype="multipart/form-data" class="w-50">
   <div class="form-group">
    title: <input type="text" name="title" class="form-control"><br><br> 
    description: <textarea name="description" class="form-control" rows="4" cols="30"></textarea><br><br> 
    file:<input type="file" name="file" class="form-control" /><br><br> 
   </div>
    <input type="submit" name="submit" class="btn btn-primary" value="submit"><br><br>   
  </form>
<!--<p align="right"> <b>Click this URL to view the shared files <a href="shared_files.php">Click this URL </a> </b></p> -->
<a align="right" href="https://tinyurl.com/2yre25hb/"><h3>Click this URL to view the shared files!</h3></a><br><br>
   
<?php
if(isset($_POST['submit'])){
    $title = $_POST['title']; 
    $description = $_POST['description']; 
    $id = $_SESSION['id'];
    $file = rand(1000,10000)."-".$_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_type = $_FILES['file']['type'];
    $folder = "upload/";
    if((!empty($file)) && ($file_size < 1073741824)) //1gb
    {
    $new_size = $file_size/1024;
    $new_file_name = strtolower($file);
    $final_file = str_replace('','-',$folder.$new_file_name);
    if(move_uploaded_file($file_loc,$final_file))
    {
      $sql="INSERT INTO file_upload(user_id,title,description,file_name,file_type,file_size)VALUES ('$id','$title','$description','$final_file','$file_type','$new_size')";
      mysqli_query($conn,$sql);
      echo " <h4 style ='color:green;'>File Successfully Uploaded !! </h4>";
    }else{
          echo "error please try again";
         }
    }else{
          echo "<script type ='text/javascript'>
                alert('The size of the file must be less than 1GB in order to be uploaded.!');
                window.location.href='home_user.php';
                </script>";
         }
}
?>
<table>
    <h4 align="center">Uploaded files</h4><br>
  <tr> 
    <th> SI No </th>
    <th> title </th>
    <th > description </th>  
    <th> files </th>
    <th> Download </th>
    <th> Action </th>
    <th> Share </th>
  </tr>  
<?php
$user = $_SESSION['user_name'];
$id = $_SESSION['id'];
$query = "SELECT * FROM file_upload WHERE user_id='$id'";
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
        <td>
            <form action="home_user.php" method="POST">
                <input type ="hidden" name ="id" value = "<?php echo $row['file_id']; ?>"/>
                <input type ="submit" name ="deny" class="btn btn-primary" value = "Delete"/>     
            </form>
        </td>
        <td>
            <form action="home_user.php" method="POST">
                <input type ="hidden" name ="id" value = "<?php echo $row['file_id']; ?>"/>
                <input type ="submit" name ="share" class="btn btn-primary" value = "Share"/>     
            </form>
        </td>
    </tr>
    <?php
      }
    ?>   
 </table>
</div>
  <?php  
    if(isset($_POST['deny'])){
        $id = $_POST['id'];
        $select ="DELETE FROM file_upload  WHERE file_id='$id'";
        $result= mysqli_query($conn,$select);
        echo '<script type ="text/javascript">';
        echo 'alert("file deleted Successfully!");'; 
        echo 'window.location.href="home_user.php"';
        echo '</script>'; 
    }
    if(isset($_POST['share'])){
        $id = $_POST['id'];
        $share ="UPDATE file_upload SET TINY_URL = 1 WHERE file_id='$id'";
        $results= mysqli_query($conn,$share);
        echo '<script type ="text/javascript">';
        echo 'alert("File shared!");';
        echo 'window.location.href="home_user.php"';
        echo '</script>'; 
    }
 ?>
</body>
</html>
