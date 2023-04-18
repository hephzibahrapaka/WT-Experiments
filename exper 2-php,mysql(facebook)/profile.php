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
// Get user's own posts from database
$sql2 = "SELECT * FROM posts WHERE username='$username' ORDER BY id DESC";
$result2 = $conn->query($sql2);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard | Social Network</title>
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
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <h2><?php echo $name; ?></h2>
        </div>
        <div class="col-md-8">
            <h2>Your Posts</h2>
            <?php while ($row2 = $result2->fetch_assoc()): ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo $row2['title']; ?></h3>
                    </div>
                    <div class="panel-body">
                        <p><?php echo $row2['content']; ?></p>
                        <?php if ($row2['image']): ?>
                            <img src="<?php echo 'uploads/' . $row2['image']; ?>" class="img-thumbnail" alt="Post Image">
                        <?php endif; ?>
                    </div>
                    <div class="panel-footer">
                        <form method="post">
                            <input type="hidden" name="post_id" value="<?php echo $row2['id']; ?>">
                            <button type="submit" name="like" class="btn btn-primary">Like</button>
                            <button type="submit" name="comment" class="btn btn-success">Comment</button>
                            <span class="badge"><?php echo $row2['likes']; ?> likes</span>
                            <span class="badge"><?php echo $row2['comments']; ?> comments</span>
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>

</body>
</html>

