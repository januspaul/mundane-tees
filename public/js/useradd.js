const errorMessage = document.getElementById("error-message");

function addUser(event) {
  event.preventDefault();

  const usernameInput = document.getElementById("username");
  const passwordInput = document.getElementById("password");
  const roleInput = document.getElementById("role");

  const username = usernameInput.value;
  const password = passwordInput.value;
  const role = roleInput.value;

  // Validate inputs
  if (username.trim() === "") {
    errorMessage.style.display = "block";
    errorMessage.textContent = "Username cannot be empty.";
    return;
  }
  if (role.trim() == "") {
    errorMessage.style.display = "block";
    errorMessage.textContent = "Role cannot be empty.";
    return;
  }
  if (password.trim() === "") {
    errorMessage.style.display = "block";
    errorMessage.textContent = "password cannot be empty.";
    return;
  }

  const hasSpecialCharacters = /^[a-zA-Z][a-zA-Z0-9_]*$/;
  if (!hasSpecialCharacters.test(username)) {
    errorMessage.style.display = "block";
    errorMessage.textContent =
      "Username must start with an alphabet, and must only contain alphanumeric characters and underscores.";
    return;
  }

  if (password.length < 8) {
    errorMessage.style.display = "block";
    errorMessage.textContent = "Password cannot be less than 8 characters.";
    return;
  }

  fetch("adduser.php", {
    method: "POST",
    credentials: "include", //cookies
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `username=${encodeURIComponent(
      username
    )}&password=${encodeURIComponent(password)}&role=${encodeURIComponent(
      role
    )}`,
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
const addUserForm = document.getElementById("adduser-form");
addUserForm.addEventListener("submit", addUser);
