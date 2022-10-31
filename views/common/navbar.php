<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid flex-nowrap">
        <a class="navbar-brand" href="/videos">
            <img src="/public/images/logo_transparent.png" alt="logo">
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

<!-- <nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid flex-nowrap">
        <a class="navbar-brand" href="/videos"><img src="/public/images/logo_transparent.png" alt="logo"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
            <a class="navbar-brand" href="/videos"><img src="/public/images/logo_transparent.png" alt="logo"></a>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/videos">Videos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/">Salir</a>
                    </li>
                </ul>
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
    </div>
</nav> -->