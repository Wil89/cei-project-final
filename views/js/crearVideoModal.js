let modalContainer = null;
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

  const name = document.querySelector("#name");
  const videoUrl = document.querySelector("#videoUrl");

  const actionBtn = document.querySelector(".btn-subir");
  actionBtn.addEventListener("click", () => {
    const postDate = new Date().toISOString().slice(0, 10);

    const url = videoUrl.value.split("src=")[1].split("title=")[0].trim();
    const title = videoUrl.value
      .split("title=")[1]
      .split("frameborder=")[0]
      .trim();

    const data = {
      name: title.substring(1, title.length - 1),
      videoUrl: url.substring(1, url.length - 1),
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
        } else if (response.status === 400) {
          // Si el status code es 400 es q ya tenemos ese video en la DB
          alert("Video Repetido");
          return;
        }
      })
      .catch((error) => console.log(error));
  });
};
