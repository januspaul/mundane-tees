// Function to handle the delete user action
function deleteUser(event) {
    event.preventDefault();

    const userID = event.currentTarget.dataset.userid;

    // Show the confirmation popup
    if (confirm("Are you sure you want to delete this user?")) {
      fetch("deleteuser.php", {
        method: "POST",
        credentials: "include", //cookies
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `userid=${encodeURIComponent(userID)}`,
      })
        .then(function (response) {
          if (response.ok) {
            // Redirect to the user list after successful delete
            window.location.href = "getusers.php";
          } else {
            throw new Error("Failed to delete user.");
          }
        })
        .catch(function (error) {
          console.error(error);
          alert("Failed to delete user.");
        });
    }
  }

  // Attach the delete user function to the click event of delete buttons
  const deleteButtons = document.querySelectorAll(".delete-user");
  deleteButtons.forEach(function (button) {
    button.addEventListener("click", deleteUser);
  });