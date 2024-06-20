<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Recuperar Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/registro.css">
</head>

<body>
    <div id="page-container" class="main-content-boxed">
        <main id="main-container">
            <div class="content content-full">
                <div class="px-30 py-10">
                    <a class="link-effect font-w700" href="../ANIMCOMIC/">
                        <i class="si si-fire"></i>
                        <span class="font-size-xl text-primary-dark">ANIM</span><span class="font-size-xl">COMIC</span>
                    </a>
                    <h2 class="h5 font-w400 text-muted mb-0">Recuperar Contraseña</h2>
                </div>
                <div class="px-30">
                    <form action="controladores/logicamail.php" method="POST">
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="form-material floating">
                                    <label for="email">Escriba su Email</label>
                                    <input type="text" class="form-control" id="email" name="email">
                                </div>
                            </div>
                        </div>
                        <?php
                        if (isset($_SESSION['response'])) :
                        ?>
                            <div class="alert alert-danger">
                                <?php echo $_SESSION['response']; ?>
                            </div>
                        <?php
                            unset($_SESSION['response']);
                        endif;
                        ?>
                        <div class="form-group">
                            <button class="btn btn-sm btn-hero btn-primary" name="send">
                                <i class="si si-login mr-10"></i> Recuperar
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

</body>

</html>