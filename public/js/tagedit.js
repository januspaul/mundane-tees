const errorMessage = document.getElementById("error-message");

function editTag(event) {
  event.preventDefault();

  const tagnameInput = document.getElementById("tagname");
  const tagIDInput = document.getElementById("tagid");

  const tagname = tagnameInput.value;
  const tagid = tagIDInput.value;

  // Validate inputs
  if (tagname.trim() === "") {
    errorMessage.style.display = "block";
    errorMessage.textContent = "Tag Name cannot be empty.";
    return;
  }

  const hasSpecialCharacters = /^[a-zA-Z0-9\s]*$/;
  if (!hasSpecialCharacters.test(tagname)) {
    errorMessage.style.display = "content";
    errorMessage.textContent = "Tag Name must not contain special characters";
    return;
  }

  fetch("edittag.php", {
    method: "POST",
    credentials: "include", //cookies
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `tagname=${encodeURIComponent(
      tagname
    )}&tagid=${encodeURIComponent(tagid)}`,
  })
    .then(function (response) {
      return response.json();
    })
    .then(function (data) {
      if (data.success) {
        window.location.href = "getusers.php";
      } else {
        if (data.errors) {
          errorMessage.style.display = "block";
          errorMessage.textContent = data.errors.join(" ");
        } else {
          errorMessage.style.display = "block";
          errorMessage.textContent = "Failed to add user.";
        }
      }
    })
    .catch(function (error) {
      console.error(error);
      errorMessage.style.display = "block";
      errorMessage.textContent = "Falied to add User.";
    });
}

// Attach the login function to the submit event of the login form
const editTagForm = document.getElementById("edittag-form");
editTagForm.addEventListener("submit", editTag);
