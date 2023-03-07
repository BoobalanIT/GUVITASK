
function profile() {
  // Use jQuery's AJAX function to make a GET request to the profile URL
  $.ajax({
    url: profile,
    type: "GET",
    dataType: "html",
    success: function(data) {
      // On success, update the page with the retrieved HTML content
      $("#profile-container").html(
      '<p>Name: ' + data.name + '</p>' +
      '<p>Age: ' + data.dob+ '</p>' +
      '<p>Gender: ' + data.gender+ '</p>' +
      '<p>Address: ' + data.location+'</p>'
      );
    },
    error: function() {
      // On error, display an error message
      $("#profile-container").html("<p>Error loading profile page.</p>");
    }
  });
}

// Call the loadProfilePage function when the page is ready
$(document).ready(function() {
  loadProfilePage();
});
