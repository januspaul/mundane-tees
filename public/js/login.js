const errorMessage = document.getElementById("error-message");

function login(event) {
  event.preventDefault();

  const usernameInput = document.getElementById("username");
  const passwordInput = document.getElementById("password");

  const username = usernameInput.value;
  const password = passwordInput.value;

  // Validate inputs
  if (username.trim() === "") {
    errorMessage.style.display = "block";
    errorMessage.textContent = "Username cannot be empty.";
    return;
  }

  if (password.trim() === "") {
    errorMessage.style.display = "block";
    errorMessage.textContent = "Password cannot be empty.";
    return;
  }

  const hasSpecialCharacters = /^[a-zA-Z][a-zA-Z0-9_]*$/.test(username);
  if (!hasSpecialCharacters) {
    errorMessage.style.display = "block";
    errorMessage.textContent =
      "Username contains invalid characters.";
    return;
  }

  if (password.length < 8) {
    errorMessage.style.display = "block";
    errorMessage.textContent =
      "Password cannot be less than 8 characters.";
    return;
  }

  fetch("login.php", {
    method: "POST",
    credentials: 'include', //cookies 
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `username=${encodeURIComponent(
      username
    )}&password=${encodeURIComponent(password)}`,
  })
    .then(function (response) {
      return response.json();
    })
    .then(function (data) {
      if (data.success) {
        window.location.href = "dashboard.php";
      } else {
        if (data.errors) {
          errorMessage.style.display = "block";
          errorMessage.textContent = data.errors.join(" ");
        } else {
          errorMessage.style.display = "block";
          errorMessage.textContent = "An error occurred during login.";
        }
      }
    })
    .catch(function (error) {
      console.error(error);
      errorMessage.style.display = "block";
      errorMessage.textContent = "An error occurred during login.";
    });
}

// Attach the login function to the submit event of the login form
const loginForm = document.getElementById("login-form");
loginForm.addEventListener("submit", login);
