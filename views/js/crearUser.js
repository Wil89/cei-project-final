var createUser = document.querySelector("#createUserForm");

if (createUser) {
  createUser.addEventListener("submit", (event) => {
    event.preventDefault();

    // const name = document.querySelector('#name');
    const emailInput = document.querySelector("#email");
    // const password = document.querySelector('#password');
    const errorValidator = document.querySelector("#error-msg");
    errorValidator.style.display = "none";

    const email = emailInput.value;

    if (!email || !email.match(/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/)) {
      errorValidator.style.display = "block";
      errorValidator.style.color = "red";
      errorValidator.innerHTML = "Revise el campo email";
    } else {
      const data = {
        userName: email.split("@")[0],
        email: email,
      };

      fetch("/users/create", {
        method: "POST",
        body: JSON.stringify(data),
        headers: {
          "Content-Type": "application/json",
        },
      })
        .then((response) => {
          if (response.ok) {
            console.log(response);
            // return response.json();
            window.location.href = "/videos";
          }
        })
        .catch((error) => console.log(error));
    }
  });
}
