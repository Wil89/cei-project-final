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
    <script defer src="../../views/js/crearVideoModal.js"></script>
</head>

<body>
    <header>
        <?php
        include_once("./views/common/navbar.php");
        ?>
    </header>
    <!-- Modal para subir video -->
    <?php include_once("./views/common/modal.php") ?>
    <!-- Toast -->
    <?php include_once("./views/common/toast.php") ?>
    <section class="main-container">
        <div class="container-xl">
            <div class="row align-items-center">
                <div class="iframe-container">
                    <?php echo $video[0]->videoUrl ?>
                </div>
                <h3 class="details-header"><?php echo $video[0]->name; ?></h3>
                <p class="comments">Comentarios: <?php
                                                    if ($video[0]->comment) {
                                                        echo count($video);
                                                    } else {
                                                        echo 0;
                                                    }

                                                    ?></p>
                <hr />
                <form id="createComment">
                    <input id="comment" type="text" class="form-control" placeholder="Comentario">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-outline-light mt-3 mb-3" onclick='addComment("<?php echo ($video[0]->videoId); ?>")'>Comentar</button>
                    </div>
                </form>
                <hr />
                <?php foreach ($video as $v) : ?>
                    <?php
                    if ($v->comment) {
                        echo "<p class='user-comment'><i class='bi bi-person-circle me-2'></i>$v->comment</p>";
                    }

                    ?>
                <?php endforeach; ?>
            </div>

        </div>
    </section>


</body>

</html>