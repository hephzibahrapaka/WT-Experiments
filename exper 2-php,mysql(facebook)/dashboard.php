<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Connect to database
$conn = new mysqli("localhost", "root", "", "facebook");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get current user details from database
$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$name = $row['name'];
// Upload new post
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_FILES['image']['name'];
    $target = "uploads/" . basename($image);

    $sql = "INSERT INTO posts (username, title, content, image) VALUES ('$username', '$title', '$content', '$image')";
    if ($conn->query($sql) === TRUE) {
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        echo "<div class='alert alert-success' role='alert'>Post added successfully!</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}

// Update likes and comments count for post
if (isset($_POST['like'])) {
    $post_id = $_POST['post_id'];
    $sql = "UPDATE posts SET likes=likes+1 WHERE id=$post_id";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success' role='alert'>Post liked successfully!</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}

if (isset($_POST['comment'])) {
    $post_id = $_POST['post_id'];
// Get comment details
$commenter = $username;
$comment = $_POST['comment'];
// Add comment to database
$sql = "INSERT INTO comments (post_id, commenter, comment) VALUES ('$post_id', '$commenter', '$comment')";
if ($conn->query($sql) === TRUE) {
    echo "<div class='alert alert-success' role='alert'>Comment added successfully!</div>";
} else {
    echo "<div class='alert alert-danger' role='alert'>Error: " . $sql . "<br>" . $conn->error . "</div>";
}
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>My Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Facebook</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
            <a class="nav-link" href="dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="profile.php">My Profile</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container my-4">
    <h2>Welcome, <?php echo $name; ?>!</h2>
    <hr>
    <h3>New Post</h3>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="content">Content:</label>
            <textarea class="form-control" id="content" name="content" required></textarea>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control-file" id="image" name="image" required>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
    <hr>
    <h3>Posts</h3>
    <?php
    // Get all posts from database
    $sql = "SELECT * FROM posts";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()){ 
            $post_id = $row['id'];
            $post_username = $row['username'];
            $post_title = $row['title'];
            $post_content = $row['content'];
            $post_image = $row['image'];
            $post_likes = $row['likes'];
    
            // Get comments count for post
            $sql2 = "SELECT COUNT(*) AS comment_count FROM comments WHERE post_id=$post_id";
            $result2 = $conn->query($sql2);
            $row2 = $result2->fetch_assoc();
            $post_comments = $row2['comment_count'];
                // Display post
    echo "<div class='card mb-3'>";
    echo "<div class='card-body'>";
    echo"<h6 class='card-text'>$post_username</h6>";
    echo "<h5 class='card-title'>$post_title</h5>";
    echo "<p class='card-text'>$post_content</p>";
    echo "<p class='card-text'>Likes: $post_likes | Comments: $post_comments</p>";
    echo "</div>";
    if ($post_image != "") {
        echo "<img src='uploads/$post_image' class='card-img-bottom'>";
    }
    echo "<div class='card-body'>";
    echo "<form method='POST' action='like.php'>";
    echo "<input type='hidden' name='post_id' value='$post_id'>";
    echo "<button type='submit' name='like' class='btn btn-primary'>Like</button>";
    echo "<button type='submit' name='comment' class='btn btn-secondary'>Comment</button>";
    echo "<input name='comm' type='text' placeholder='comment...' >";
    $q="SELECT `username`, `content` FROM `comments` WHERE `post_id`='$post_id'";
                $c=$conn->query($q);
                if(isset($c))
                {
                    while($com=mysqli_fetch_assoc($c))
                    {
                        $commenter=$com['username'];
                        $des=$com['content'];
                        echo'<p><b>'.$commenter.'</b></p>';
                        echo'<p>'.$des.'</p>';
                    }
                }
    echo "</form>";
    echo "</div>";
    echo "</div>";
}
        

    }
else {
    echo "<div class='alert alert-info' role='alert'>No posts found!</div>";
    }
    
    $conn->close();
    ?>
    </div>
    </div>
    </div>
    
    </body>
    </html>
            

            

    