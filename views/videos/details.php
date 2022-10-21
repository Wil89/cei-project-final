<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../views/css/videos.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script defer src="views/js/crearVideoModal.js"></script>
</head>

<body>
    <header>
        <?php
        include_once("./views/common/navbar.php");
        ?>
    </header>
    <section class="container-fluid">
        <div class="row align-items-center">
            <div class="iframe-container">
                <?php echo $video[0]->videoUrl ?>
                <!-- <iframe class="details" src="<?php echo $video[0]->videoUrl ?>" title="<?php $video->name ?>"></iframe> -->
            </div>
            <h3 class=""><?php echo $video[0]->name ?></h3>
            <p><?php echo count($video)." Comentarios" ?></p>
            <?php foreach ($video as $video) : ?>
                <p><?php echo $video->comment ?></p>
            <?php endforeach; ?>
        </div>

    </section>

</body>

</html>