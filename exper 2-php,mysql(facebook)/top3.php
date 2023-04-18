<html>
    <head>
        <style>
            div{
                text-align: center;
            }
        </style>
    </head>
</html>
<?php
session_start();
echo'
        <div>
        <h2>Top 3 liked users</h2>';
        $con=new mysqli("localhost","root","","facebook");
        if(isset($con)){
        $sql="SELECT * FROM `posts` ORDER BY likes DESC LIMIT 3;";
        $top=$con->query($sql);
        $j=1;
        
        while($row=mysqli_fetch_assoc($top))
        { $post_id = $row['id'];
            $post_username = $row['username'];
            $post_title = $row['title'];
            $post_content = $row['content'];
            $post_image = $row['image'];
            $post_likes = $row['likes'];
            echo'<p>'.$j.".".$row["username"].'</p><hr>';
            echo "<img src='uploads/$post_image' style='height:600px;width:600px;' ><br>";
            echo "likes:".$post_likes;
    
            $j+=1;
        }
    }
        echo'</div>';
       
?>
