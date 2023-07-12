const errorMessage = document.getElementById("error-message");

function editTshirt(event) {
  event.preventDefault();

  const sizeInput = document.getElementById("size");
  const sleeveInput = document.getElementById("sleeve");
  const styleInput = document.getElementById("style");
  const neckShapeInput = document.getElementById("neckshape");
  const sexInput = document.getElementById("sex");
  const nameInput = document.getElementById("name");
  const imageInput = document.getElementById("image");
  const tshirtIDInput = document.getElementById("tshirtid");
  const itemCodeInput = document.getElementById("itemcode");
  const userIDInput = document.getElementById("userid");
  const dateCreatedInput = document.getElementById("datecreated");
  const tagInputs = [...document.querySelectorAll('input[name="tags[]"]:checked')];
  const tags = tagInputs.map((input) => input.value);

  const size = sizeInput.value;
  const sleeve = sleeveInput.value;
  const style = styleInput.value;
  const neckshape = neckShapeInput.value;
  const sex = sexInput.value;
  const name = nameInput.value;
  const image = imageInput.files[0];
  const tshirtid = tshirtIDInput.value;
  const itemcode = itemCodeInput.value;
  const userid = userIDInput.value;
  const datecreated = dateCreatedInput.value;

  const presetSizes = ["xxs", "xs", "s", "m", "l", "xl", "xxl"];
  const presetSleeves = ["Short", "Long"];
  const presetStyles = ["Casual", "Formal", "Sporty"];
  const presetNeckShapes = ["Round", "VNeck", "CrewNeck"];
  const presetSexes = ["Male", "Female", "Unisex"];

  if (size.trim() === "") {
    errorMessage.style.display = "block";
    errorMessage.textContent = "Size field cannot be empty.";
  }

  if (sleeve.trim() === "") {
    errorMessage.style.display = "block";
    errorMessage.textContent = "Sleeve field cannot be empty.";
  }

  if (style.trim() === "") {
    errorMessage.style.display = "block";
    errorMessage.textContent = "Style field cannot be empty.";
  }

  if (neckshape.trim() === "") {
    errorMessage.style.display = "block";
    errorMessage.textContent = "Neckshape field cannot be empty.";
  }

  if (sex.trim() === "") {
    errorMessage.style.display = "block";
    errorMessage.textContent = "Sex field cannot be empty.";
  }

  if (name.trim() === "") {
    errorMessage.style.display = "block";
    errorMessage.textContent = "Name field cannot be empty.";
  }
  if (!presetSizes.includes(size.trim())) {
    errorMessage.style.display = "block";
    errorMessage.textContent = "Invalid size selected.";
    return;
  }

  if (!presetSleeves.includes(sleeve.trim())) {
    errorMessage.style.display = "block";
    errorMessage.textContent = "Invalid sleeve selected.";
    return;
  }

  if (!presetStyles.includes(style.trim())) {
    errorMessage.style.display = "block";
    errorMessage.textContent = "Invalid style selected.";
    return;
  }

  if (!presetNeckShapes.includes(neckshape.trim())) {
    errorMessage.style.display = "block";
    errorMessage.textContent = "Invalid neck shape selected.";
    return;
  }

  if (!presetSexes.includes(sex.trim())) {
    errorMessage.style.display = "block";
    errorMessage.textContent = "Invalid sex selected.";
    return;
  }

  const hasSpecialCharacters = /^[a-zA-Z0-9\s]*$/;
  if (!hasSpecialCharacters.test(name)) {
    errorMessage.style.display = "block";
    errorMessage.textContent =
      "TShirt Name must not contain special characters";
    return;
  }

  const formData = new FormData();
  formData.append("size", size);
  formData.append("sleeve", sleeve);
  formData.append("style", style);
  formData.append("neckshape", neckshape);
  formData.append("sex", sex);
  formData.append("name", name);
  formData.append("image", image);
  tags.forEach((tags)=> formData.append("tags[]",tags));
  formData.append("tshirtid", tshirtid);
  formData.append("itemcode", itemcode);
  formData.append("userid", userid);
  formData.append("datecreated", datecreated);

  fetch("edittshirt.php", {
    method: "POST",
    credentials: "include",
    body: formData,
  })
    .then(function (response) {
      return response.json();
    })
    .then(function (data) {
      if (data.success) {
        window.location.href = "gettshirt.php";
      } else {
        if (data.errors) {
          errorMessage.style.display = "block";
          errorMessage.textContent = data.errors.join(" ");
        } else {
          errorMessage.style.display = "block";
          errorMessage.textContent = "Failed to edit tshirt.";
        }
      }
    })
    .catch(function (error) {
      console.error(error);
      errorMessage.style.display = "block";
      errorMessage.textContent = "failed to edit tshirt";
    });
}

const editTshirtForm = document.getElementById("edittshirt-form");
editTshirtForm.addEventListener("submit", editTshirt);
