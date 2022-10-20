<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Videos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="views/css/videos.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="views/js/crearVideoModal.js"></script>
</head>

<body>
  <header>
    <?php
    include_once("./views/common/navbar.php");
    ?>
  </header>
  <!-- Modal para subir video -->
  <div id="modal-subir-video"></div>
  <!-- Toast -->
  <div class="toast-container position-absolute top-[56px] end-0 p-3 z-1">
    <div id="alert-toast" class="toast align-items-center text-white bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body">

        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  </div>

  <!-- Contenido -->
  <div class="container">
    <div class="row row-cols-auto">
      <?php foreach ($videos as $video) : ?>
        <div class="col position-relative">
          <iframe src="<?php echo $video->videoUrl ?>" title="<?php $video->name ?>"></iframe>
          <a class="overlay" href="videos/details/<?php echo $video->id ?>"></a>
          <div class="row align-items-start">
            <p><?php echo $video->name ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

</body>

</html>