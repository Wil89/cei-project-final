let modalContainer = null;

const formBuscar = document.querySelector("#buscarVideo");
const inputBuscar = document.querySelector("#buscarVideoInput");
const modalValidacion = document.querySelector("#error-msg");
// Inicialización for detail page
if (modalValidacion) {
  modalValidacion.style.display = "none";
}
// Evento para buscar un video
formBuscar.addEventListener("submit", (event) => {
  event.preventDefault();
  const url = `/videos/search`;
  
  fetch(url, {
    method: "POST",
    body: JSON.stringify({ filter: inputBuscar.value }),
    headers: {
      "Content-Type": "text/html",
    },
  })
    .then((response) => {
      if (response.ok) {
        // Se envia un el HTML con los videos desde el servidor
        return response.text();
      }
    })
    .then((html) => {
      // Mostar el HTML en el DOM
      document.body.innerHTML = html;
    });
});

// Modal para crear un Video
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
              <div class="content">
                <h6>Como copiar un video de YouTube</h6>
                <ol>
                  <li>Buscar video deseado en YouTube</li>
                  <li>Click derecho <strong> Copy embeded code </strong></li>
                  <li>Pegar contenido en el dialogo de texto</li>
                </ol>
                <img src="/public/images/guia-2.png" />

              </div>
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
                <button id="btn-subir" type="button" class="btn btn-primary">Subir Video</button>
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

  const actionBtn = document.querySelector("#btn-subir");

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

// Creación de comentario
const addComment = (id) => {
  const commentForm = document.querySelector("#createComment");
  const commentInput = document.querySelector("#comment");
  const commentUser = document.querySelector("#user");

  // Mensaje Toast
  const toast = document.querySelector("#alert-toast");
  const toastBody = document.querySelector(".toast-body");
  const toastMsg = new bootstrap.Toast(toast);

  if (!commentInput.value) {
    modalValidacion.style.display = "block";
    modalValidacion.style.color = "red";
    modalValidacion.innerHTML = "Introduzca un comentario";
    return;
  } else if (!commentUser.value) {
    modalValidacion.style.display = "block";
    modalValidacion.style.color = "red";
    modalValidacion.innerHTML = "Seleccione un usuario";
    return;
  }

  // Crear el objeto comentario para el fetch
  // relación con video y usuario
  const data = {
    comment: commentInput.value,
    date: new Date().toISOString().slice(0, 19).replace("T", " "),
    videoId: parseInt(id),
    userId: parseInt(commentUser.value),
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
        window.location.reload();
        toastBody.innerHTML = "Video subido satisfactoriamente.";
        toastMsg.show();
      }
    })

    .catch((error) => {
      console.log(error);
    });
};
