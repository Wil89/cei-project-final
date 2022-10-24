let modalContainer = null;

const formBuscar = document.querySelector("#buscarVideo");
const inputBuscar = document.querySelector("#buscarVideoInput");
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
                            class="form-control" name="url" id="videoUrl" required placeholder="Titulo del video">
                        <label for="nombre">Video URL</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-subir" data-bs-dismiss="modal">Subir Video</button>
            </div>
        </div>
    </div>
</div>
  `;
  document.body.append(modalContainer);
  let modal = new bootstrap.Modal(document.getElementById("createModal"));
  modal.show();

  // Mensaje Toast
  const toast = document.querySelector("#alert-toast");
  const toastBody = document.querySelector(".toast-body");

  const name = document.querySelector("#name");
  const videoUrl = document.querySelector("#videoUrl");

  const actionBtn = document.querySelector(".btn-subir");
  actionBtn.addEventListener("click", () => {
    const toastMsg = new bootstrap.Toast(toast);
    const postDate = new Date().toISOString().slice(0, 10);

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
          window.location.reload();
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

  const data = {
    comment: commentInput.value,
    date: new Date().toISOString().slice(0, 10),
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
