<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= TITLE_APP ?></title>
    <link href="<?= BASE_URL ?>assets/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4"><?= TITLE_APP ?></h3>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="login">
                                        <div class="form-floating mb-3">
                                            <input type="text" id="inputUsuario" name="usuario" class="form-control" placeholder="Usuario" required />
                                            <label for="inputUsuario">Usuario</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required />
                                            <label for="inputPassword">Password</label>
                                        </div>
                                        <?php if (isset($_SESSION['error'])) : ?>
                                            <div class="alert alert-danger" role="alert">
                                                <?= $_SESSION['error'] ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php Utils::deleteSession('error'); ?>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button type="submit" class="btn btn-primary">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?= BASE_URL ?>assets/js/scripts.js"></script>
</body>

</html>