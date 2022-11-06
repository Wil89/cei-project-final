<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Video Blog</title>
  <link rel="shortcut icon" href="/public/images/vlog.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="views/css/videos.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script defer src="views/js/crearVideoModal.js"></script>
</head>

<body>
  <header>
    <?php
    include_once("./views/common/navbar.php");
    ?>
  </header>
  <!-- Toast -->
  <?php include_once("./views/common/toast.php") ?>

  <!-- Contenido -->
  <div class="main-container">
    <div class="container-fluid">
      <div class="custom-rows">
        <?php foreach ($videos as $video) : ?>
          <!-- <div class=""> -->
            <div class="card card-dark">
              <div class="card-body">
                <div class="iframe-container position-relative">
                  <?php echo $video->videoUrl ?>
                </div>
                <a class="overlay" href="videos/details/<?php echo $video->videoId; ?>"></a>
                <div class="row align-items-start mt-2">
                  <p class="ellipsis"><?php echo $video->name ?></p>
                </div>
              </div>
            </div>
          <!-- </div> -->

        <?php endforeach; ?>
      </div>
    </div>
  </div>

</body>

</html>