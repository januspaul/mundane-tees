function fetchTshirts(page) {
  const searchQuery = getSearchQuery();
  const sizeFilter = document.querySelector('select[name="size"]').value;
  const url = `dashboard.php?ajax=1&page=${page}${searchQuery}&size=${sizeFilter}`;
  fetch(url)
    .then(function (response) {
      return response.json();
    })
    .then(function (data) {
      if (data.success) {
        if (data.tshirts) {
          displayTshirts(data.tshirts);
        } else {
          const tshirtContainer = document.getElementById("tshirt-container");
          tshirtContainer.innerHTML = "<p>No T-Shirts found.</p>";
        }
      } else {
        console.error(data.message);
      }
    })
    .catch(function (error) {
      console.error(error);
    });
}

function displayTshirts(tshirts) {
  const tshirtContainer = document.getElementById("tshirt-container");
  tshirtContainer.innerHTML = "";

  tshirts.forEach(function (tshirt) {
    const card = document.createElement("div");
    card.classList.add("p-2");
    card.innerHTML = `
        <div class="card mb-4 text-center" style="width: 201px;">
          <img src="${
            tshirt.Image
          }" class="card-img-top" style="width: 200px; height: 200px;" alt="T-shirt Image">
          <div class="card-body">
            <h5 class="card-title">${tshirt.Name}</h5>
            <p class="card-text">Size: ${tshirt.Size}</p>
            <p class="card-text">Style: ${tshirt.Style}</p>
            <div class="tags">
              ${getTagsHTML(tshirt.TagNames)}
            </div>
            <div class="d-flex justify-content-center">
              <a href="tshirtdetails.php?id=${
                tshirt.TshirtID
              }" class="btn btn-primary"><i class="fa-solid fa-circle-info fa-xl"></i></a>
            </div>
          </div>
        </div>
      `;
    tshirtContainer.appendChild(card);
  });
}

function getTagsHTML(tagNames) {
  const tags = tagNames ? tagNames.split(", ") : [];
  return tags
    .map(
      (tag) =>
        `<h4 class="badge rounded-pill bg-success">${tag}</h4>`
    )
    .join("");
}

function getSearchQuery() {
  const searchParam = new URLSearchParams(window.location.search).get("search");
  return searchParam ? `&search=${encodeURIComponent(searchParam)}` : "";
}
