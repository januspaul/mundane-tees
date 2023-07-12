const errorMessage = document.getElementById("error-message");

function addTag(event) {
  event.preventDefault();

  const tagNameInput = document.getElementById("tagname");


  const tagname = tagNameInput.value;
  // Validate inputs
  if (tagname.trim() === "") {
    errorMessage.style.display = "block";
    errorMessage.textContent = "Tagname cannot be empty.";
    return;
  }

  const hasSpecialCharacters = /^[a-zA-Z0-9\s]*$/;
  if (!hasSpecialCharacters.test(tagname)) {
    errorMessage.style.display = "block";
    errorMessage.textContent =
      "Tag Name contains invalid characters.";
    return;
  }

  fetch("addtag.php", {
    method: "POST",
    credentials: "include", //cookies
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `tagname=${encodeURIComponent(
      tagname
    )}`,
  })
    .then(function (response) {
      return response.json();
    })
    .then(function (data) {
      if (data.success) {
        window.location.href = "gettag.php";
      } else {
        if (data.errors) {
          errorMessage.style.display = "block";
          errorMessage.textContent = data.errors.join(" ");
        } else {
          errorMessage.style.display = "block";
          errorMessage.textContent = "Failed to add tag.";
        }
      }
    })
    .catch(function (error) {
      console.error(error);
      errorMessage.style.display = "block";
      errorMessage.textContent = "Falied to add tag.";
    });
}

// Attach the login function to the submit event of the login form
const addTagForm = document.getElementById("addtag-form");
addTagForm.addEventListener("submit", addTag);
