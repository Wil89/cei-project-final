<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Video Blog</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="/views/css/videos.css">
</head>

<body>
  <main class="d-flex align-items-center justify-content-center vh-100 ">
    <div class="card login-shadow" style="width: 18rem;">
      <img src="/public/images/login-logo-2.png" alt="card-img-top">
      <div class="card-body p-3">
        <form>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingPassword" placeholder="Nombre usuario">
            <label for="floatingPassword">Nombre de Usuario</label>
          </div>
          <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput" placeholder="nombre@ejemplo.com">
            <label for="floatingInput">Email</label>
          </div>
          <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Contraseña">
            <label for="floatingPassword">Contraseña</label>
          </div>
          <div>
            <input type="submit" class="btn btn-outline-primary mt-4 w-100" value="Entrar">
          </div>
        </form>
      </div>
    </div>
  </main>
</body>

</html>