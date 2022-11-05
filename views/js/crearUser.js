var createUser = document.querySelector("#createUserForm");

// Si esta en el DOM el formulario de crear usuario,
// se agrega un evento de submit
// El usuarios solo se crea para posteriormente asiganar un usuario
// a un comentario
if (createUser) {
  createUser.addEventListener("submit", (event) => {
    event.preventDefault();

    const emailInput = document.querySelector("#email");
    const errorValidator = document.querySelector("#error-msg");
    errorValidator.style.display = "none";

    const email = emailInput.value;

    // regex para validar el email
    if (!email || !email.match(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/)) {
      errorValidator.style.display = "block";
      errorValidator.style.color = "red";
      errorValidator.innerHTML = "Revise el campo email";
    } else {
      // Obtener el userName a partir del email
      const data = {
        userName: email.split("@")[0],
        email: email,
      };

      // Request para crear el usuario
      fetch("/users/create", {
        method: "POST",
        body: JSON.stringify(data),
        headers: {
          "Content-Type": "application/json",
        },
      })
        .then((response) => {
          if (response.ok) {
            // Redireccionar a la pagina de videos
            window.location.href = "/videos";
          }
        })
        .catch((error) => console.log(error));
    }
  });
}
