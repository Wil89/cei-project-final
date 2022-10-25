let modalContainer = null;

const formBuscar = document.querySelector("#buscarVideo");
const inputBuscar = document.querySelector("#buscarVideoInput");
const modalValidacion = document.querySelector("#error-msg");
// Inicialización for detail page
if (modalValidacion) {
  modalValidacion.style.display = "none";
}

formBuscar.addEventListener("submit", (event) => {
  event.preventDefault();
  const url = `/videos/index/${inputBuscar.value}`;
  window.location.href = url;
  // console.log(url);
  // fetch(url).then((response) => response.json())
  // .then(data => console.log(data));
});

crearVideoModal = () => {
  if (modalContainer !== null) {
    modalContainer.remove();
  }
  modalContainer = document.createElement("div");
  modalContainer.innerHTML = `
  <div id="createModal" class="modal" tabindex="-1">
    <div class="modal-dialog modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Subir Video</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formGuardar">
                    <div class="form-floating mb-3">
                        <input
                            type="text"
                            class="form-control position-relative" name="url" id="videoUrl" required placeholder="Titulo del video">
                        <label for="nombre">Video URL</label>
                        <p id="modal-error-msg" class="position-absolute"></p>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-subir">Subir Video</button>
            </div>
        </div>
    </div>
</div>
  `;
  document.body.append(modalContainer);
  let modal = new bootstrap.Modal(document.getElementById("createModal"));
  modal.show();

  const modalValidacion = document.querySelector("#modal-error-msg");
  // Inicialización
  modalValidacion.style.display = "none";

  // Mensaje Toast
  const toast = document.querySelector("#alert-toast");
  const toastBody = document.querySelector(".toast-body");

  const name = document.querySelector("#name");
  const videoUrl = document.querySelector("#videoUrl");

  const actionBtn = document.querySelector(".btn-subir");

  // Escuchar evento de click para subir video
  actionBtn.addEventListener("click", () => {
    const toastMsg = new bootstrap.Toast(toast);
    const postDate = new Date().toISOString().slice(0, 19).replace("T", " ");

    //Validar que no este vació el video iframe pegado o no coincida con una etiqueta válida de un iframe
    if (!videoUrl.value) {
      modalValidacion.style.display = "block";
      modalValidacion.style.color = "red";
      modalValidacion.innerHTML = "Introduzca un video";
    } else if (
      !videoUrl.value.match(/(?:<iframe[^>]*)(?:(?:\/>)|(?:>.*?<\/iframe>))/)
    ) {
      modalValidacion.style.display = "block";
      modalValidacion.style.color = "red";
      modalValidacion.innerHTML =
        "El valor introducido no es una etiqueta iframe válida";
      // return;
    } else {
      modal.hide();
      const url = videoUrl.value.split("src=")[1].split("title=")[0].trim();
      const title = videoUrl.value
        .split("title=")[1]
        .split("frameborder=")[0]
        .trim();

      const data = {
        name: title.substring(1, title.length - 1),
        videoUrl: videoUrl.value,
        postDate: postDate,
      };

      console.log(data);
      fetch("/videos/create", {
        method: "POST",
        body: JSON.stringify(data),
        headers: {
          "Content-Type": "application/json",
        },
      })
        .then((response) => {
          if (response.ok) {
            // Recargar la pagina para mostrar las nuevas entradas
            window.location.href = "/videos";
            toastBody.innerHTML = "Video subido satisfactoriamente.";
            toastMsg.show();
          } else if (response.status === 400) {
            // Si el status code es 400 es q ya tenemos ese video en la DB
            // alert("Video Repetido");
            toastBody.innerHTML = "<p>El Video ya existe.</p>";
            toastMsg.show();
            return;
          }
        })
        .catch((error) => console.log(error));
    }
  });
};

// Submit de creación de usuario
const addComment = (id) => {
  const commentForm = document.querySelector("#createComment");
  const commentInput = document.querySelector("#comment");

  // Mensaje Toast
  const toast = document.querySelector("#alert-toast");
  const toastBody = document.querySelector(".toast-body");
  const toastMsg = new bootstrap.Toast(toast);

  console.log(`Enviar ${commentInput.value} con id ${id}`);

  if (!commentInput.value) {
    modalValidacion.style.display = "block";
    modalValidacion.style.color = "red";
    modalValidacion.innerHTML = "Introduzca un comentario";
    return;
  }

  const data = {
    comment: commentInput.value,
    date: new Date().toISOString().slice(0, 19).replace("T", " "),
    videoId: parseInt(id),
    userId: 2,
  };

  fetch("/comments/create", {
    method: "POST",
    body: JSON.stringify(data),
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((response) => {
      if (response.ok) {
        console.log(response);
        window.location.reload();
        toastBody.innerHTML = "Video subido satisfactoriamente.";
        toastMsg.show();
      }
    })

    .catch((error) => {
      console.log(error);
    });
};
