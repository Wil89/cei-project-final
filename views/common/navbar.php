<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid flex-nowrap">
        <a class="navbar-brand" href="/videos">
            <img src="/public/images/logo_transparent.png" alt="">
        </a>
        <div class="d-flex">
            <form id="buscarVideo" class="d-flex">
                <input id="buscarVideoInput" class="form-control me-2" type="search" placeholder="Buscar video" aria-label="Search">
                <button class="btn btn-outline-light" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>
            <button class="btn btn-outline-light ms-2" onclick="crearVideoModal()">
                <i class="bi bi-cloud-upload"></i>
                Subir
            </button>
        </div>

    </div>
</nav>