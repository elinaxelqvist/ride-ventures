 function updateMenuBar() {
    // update menu bar, depending on whether a user is logged in
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

updateMenuBar();