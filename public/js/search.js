const errorMessage = document.getElementById("error-message");

function searchTshirt() {
  const searchInput = document.getElementById("search");
  const search = searchInput.value.trim();

  const regex = /^[a-zA-Z0-9\s]+$/;

  if (search === "") {
    errorMessage.style.display = "block";
    errorMessage.textContent = "Search input is empty";
    return;
  } else if (!regex.test(search)) {
    errorMessage.style.display = "block";
    errorMessage.textContent = "Search input contains invalid characters";
    return;
  }

  fetch("search.php", {
    method: "POST",
    credentials: "include",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `search=${encodeURIComponent(search)}`,
  })
    .then(function (response) {
      return response.json();
    })
    .then(function (data) {
      if (data.success) {
        if (data.results) {
          displayResults(data.results);
        } else {
          const resultsContainer = document.getElementById("results-container");
          resultsContainer.innerHTML = "<p>No results found.</p>";
        }
      } else {
        if (data.errors) {
          errorMessage.style.display = "block";
          errorMessage.textContent = data.errors.join(" ");
        } else {
          errorMessage.style.display = "block";
          errorMessage.textContent = "Failed to search";
        }
      }
    })
    .catch(function (error) {
      console.error(error);
      errorMessage.style.display = "block";
      errorMessage.textContent = "Failed to search";
    });
}

function displayResults(results) {
  const resultsContainer = document.getElementById("results-container");
  resultsContainer.innerHTML = "";

  if (results.length === 0) {
    resultsContainer.innerHTML = "<p>No results found.</p>";
  } else {
    results.forEach((shirt) => {
      const card = document.createElement("div");
      card.className = "col-md-4";
      card.innerHTML = `
        <div class="card mb-4">
          <div class="card-body">
            <h5 class="card-title">${shirt["Name"]}</h5>
            <p class="card-text">Size: ${shirt["Size"]}</p>
            <p class="card-text">Style: ${shirt["Style"]}</p>
            <p class="card-text">T-shirt ID: ${shirt["TshirtID"]}</p>
            <p class="card-text">Date Created: ${shirt["DateCreated"]}</p>
          </div>
        </div>
      `;
      resultsContainer.appendChild(card);
    });
  }
}

const searchForm = document.getElementById("search-form");
searchForm.addEventListener("submit", function (event) {
  event.preventDefault();
  searchTshirt();
});
