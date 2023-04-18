<?php
session_start();


$con= new mysqli('localhost','root','','facebook');

if(isset($_POST["like"])){
$image_id = $_POST["post_id"];
$user_id = $_SESSION["username"];
$sql1="SELECT * FROM `post_likes` WHERE username='$user_id' AND post_id='$image_id';";
$result = $con->query($sql1);
$rowcount = mysqli_num_rows( $result );
if ($rowcount >0) {
 // echo "<script>alert('You have already liked this image.')</script>";
  echo '<script>window.location.replace("dashboard.php");</script>';
} 
else {
  $sql = "UPDATE posts SET likes=likes+1 WHERE id='$image_id'";
  $res2 = $con->query($sql);
    // if ($con->query($sql) === TRUE) {
    //   echo "<script>alert('Like added successfully.')</script>";
    // } 
    // else {
    //   echo "Error adding like: " . $con->error;
    // }
    $sql2 = "INSERT INTO post_likes(username,post_id) VALUES ('$user_id',$image_id)";
    $res1 = $con->query($sql2);
  // if ($con->query($sql2) === TRUE) {
  //   echo "<script>alert('Like recorded successfully.')</script>";
  // } 
  // else {
  //   echo "Error recording like: " . $con->error;
  // }
}
}
if(isset($_POST["comment"]))
{   //echo "hiiii";
    $i=$_POST['post_id'];
    $c=$_POST['comm'];
    $u=$_SESSION["username"];
//$con= new mysqli("localhost","root","","facebook");
    $query="INSERT INTO `comments`(`post_id`, `username`, `content`) VALUES ('$i','$u','$c')";
    $r=$con->query($query);
    // if(isset($r))
    // {
    //     echo"<script>alert('commented');</script>";
    // }
}
$con->close();
echo '<script>window.location.replace("dashboard.php");</script>';
?>