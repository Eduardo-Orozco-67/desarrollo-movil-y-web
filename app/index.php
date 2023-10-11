<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Acceso de Usuarios</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/cerulean/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles2.css">
</head>
<body>
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <div class="mb-md-5 mt-md-4 pb-5">
                            <h2 class="fw-bold mb-2 text-uppercase">Acceso de Usuarios</h2>
                            <p class="text-white-50 mb-5">Por favor, ingrese su usuario y contraseña.</p>
                            <form>
                                <div class="form-outline form-white mb-4">
                                    <input type="text" id="loginUsername" class="form-control form-control-lg" name="loginUsername" autocomplete="off" />
                                    <label class="form-label" for="loginUsername">Usuario</label>
                                </div>
                                <div class="form-outline form-white mb-4">
                                    <input type="password" id="loginPassword" class="form-control form-control-lg" name="loginPassword" autocomplete="off" />
                                    <label class="form-label" for="loginPassword">Contraseña</label>
                                </div>
                                <button type="button" id="login" class="btn btn-outline-light btn-lg px-5">Ingresar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/login.js"></script>
</body>
</html>
