function register()
{
$(document).ready(function() {
    $('#confirm_password').on('keyup', function() {
        if ($('#password').val() == $('#confirm_password').val()) {
            $('#message').html('Passwords match').css('color', 'green');
        } else {
            $('#message').html('Passwords do not match').css('color', 'red');
        }
    });
});

// register user
$(document).ready(function() {
    $('#registerForm').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: 'register.php',
            data: formData,
            success: function(response) {
                // redirect to main page
                window.location.href = 'main.php';
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
});
}