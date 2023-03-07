 function login(){
 $(document).ready(function() {
      $('#login-form').submit(function(event) {
        event.preventDefault();
        var username = $('#username').val();
        var password = $('#password').val();
        $.ajax({
          type: 'POST',
          url: 'login.php',
          data: {username: username, password: password},
          success: function(response) {
            if (response === 'success') {
              window.location.href = 'dashboard.php';
            } else {
              $('#error-message').text('Invalid username or password.');
            }
          }
        });
      });
    });

 }