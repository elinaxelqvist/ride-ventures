<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ride Ventures</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="icon" type="image/png" sizes="32x32" href="pictures/icons8-quad-bike-32-red-bg.png">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

    <script src="js/load_comments.js"></script>
    <script src="js/update_menu_bar.js"></script>
    <script src="js/validate_comment.js"></script>
</head>
<body>
  <?php
    include 'isLoggedIn.php';
    $loggedIn = isLoggedIn();
  ?>

    <div class="header">
        <div id="navbar" class="navbar">
          <a id="register" href="register.html">Register</a>
          <a id="login" href="login.html">Log In</a>
          <a id="logout" href="logout.php">Log Out</a>
        </div>
        <div class="header-content">
            <h1>RideVentures</h1>
        </div>

    </div>

    <div class="center-flex" id="container">
        <textarea id="comments" name="comments" placeholder="Comments" readonly></textarea>

        <?php if ($loggedIn): ?>
        <form onsubmit="return validateComment()" name="register" id="addComment" action="postComment.php" method="POST">
            <label for="comment">Share your favourite road down below!<br><br>Describe the road! What is the name of the road? Do you have the address? Anything special about it?</label>
            <textarea id="comment" name="comment"></textarea>
            <input type="submit" value="Share my road">
        </form>
        <?php endif; ?>
    </div>
</body>
</html>