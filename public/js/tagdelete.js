// Function to handle the delete tag action
function deleteTag(event) {
  event.preventDefault();

  const tagID = event.currentTarget.dataset.tagid;

  // Show the confirmation popup
  if (confirm("Are you sure you want to delete this tag?")) {
    fetch("deletetag.php", {
      method: "POST",
      credentials: "include", // Send cookies
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `tagid=${encodeURIComponent(tagID)}`,
    })
      .then(function (response) {
        if (response.ok) {
          // Redirect to the tag list after successful delete
          window.location.href = "gettag.php";
        } else {
          throw new Error("Failed to delete tag.");
        }
      })
      .catch(function (error) {
        console.error(error);
        alert("Failed to delete tag.");
      });
  }
}

// Attach the delete tag function to the click event of delete buttons
const deleteButtons = document.querySelectorAll(".delete-tag");
deleteButtons.forEach(function (button) {
  button.addEventListener("click", deleteTag);
});
