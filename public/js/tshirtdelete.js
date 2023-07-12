function deleteTshirt(event) {
    event.preventDefault();

    const tshirtID = event.currentTarget.dataset.tshirtid;

    if (confirm("Are you sure you want to delete this tshirt?")) {
      fetch("deletetshirt.php", {
        method: "POST",
        credentials: "include", //cookies
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `tshirtid=${encodeURIComponent(tshirtID)}`,
      })
        .then(function (response) {
          if (response.ok) {
            window.location.href = "gettshirt.php";
          } else {
            throw new Error("Failed to delete tshirt.");
          }
        })
        .catch(function (error) {
          console.error(error);
          alert("Failed to delete tshirt.");
        });
    }
  }

  const deleteButtons = document.querySelectorAll(".delete-tshirt");
  deleteButtons.forEach(function (button) {
    button.addEventListener("click", deleteTshirt);
  });