<?php
session_start();
if(isset($_POST["comment"]))
            {
                $i=$_POST['image_id'];
                $c=$_POST['comm'];
                $u=$_SESSION["username"];
                $con= new mysqli("localhost","root","","facebook");
                $query="INSERT INTO `comments`(`post_id`, `username`, `content`) VALUES ('$i','$u','$c')";
                $r=$con->query($query);
                if(isset($r))
                {
                    echo"<script>alert('commented');</script>";
                }
            }

?>