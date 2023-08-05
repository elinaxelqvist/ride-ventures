<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment site</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Rajdhani&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
    <script>
        $(document).ready(function() {
            // Fetch comments from PHP file
            $.getJSON('getComments.php', function(data) {
                console.log(data);
                // Iterate over the comments and append them to the textarea
                var textarea = $('#comments');
                data.forEach(function(comment) {
                    textarea.val(textarea.val() + comment.email + ": " + comment.comment + "\n");
                });
            }).fail(function(jqXHR, textStatus, errorThrown) { console.log("Failed to show comments:", errorThrown);});
        });
    </script>
    <script>
    // Function to check login status
    function checkLoginStatus() {
      //AJAX request to the PHP function or API endpoint, checks login status
      $.ajax({
        url: 'checkLogin.php',
        method: 'GET',
        success: function(response) {
          if (response.loggedIn) {
            // User is logged in, show the logout only
            console.debug("Logged in");
            document.getElementById('register').style.display = 'none';
            document.getElementById('login').style.display = 'none';
            document.getElementById('logout').style.display = 'float';
          } else {
            // User is not logged in, show only register & login
            console.debug("Not logged in");
            document.getElementById('register').style.display = 'float';
            document.getElementById('login').style.display = 'float';
            document.getElementById('logout').style.display = 'none';
 
          }
        },
        error: function() {
          // Handle error case
          console.log('Error occurred while checking login status.');
        }
      });
    }

      function validateComment() {
        console.debug('Checking comment...');  
        const comment = document.getElementById('comment');
        const trimmedComment = comment.value.trim(); // Remove leading and trailing whitespaces

        console.debug('Original text: ' + comment.value);
        console.debug('Trimmed text: ' + trimmedComment);
        if (trimmedComment.length === 0) {
            alert('Comments cannot be empty.');
            console.debug('Comment was empty');
            return false; // Prevent form submission
        }
        console.debug('Comment was non-empty: ' + trimmedComment);
        return true; // Allow form submission
      }

    // Call the function to check login status on page load
    checkLoginStatus();
    </script>
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