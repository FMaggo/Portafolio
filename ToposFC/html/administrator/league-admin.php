<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Bootstrap tiene su propia librería de JavaScript  -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../images/MADRIGUERA-LOGO.png">
    <title> Administración de ligas </title>

    <!-- Bootstrap designs-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Bootstrap icons  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- External CSS file -->
    <link rel="stylesheet" href="../../css/admin.css">

    <!-- JavaScript  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <!--External JavaScript file-->
    <script src="../../scripts/forms/edit-league.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="admin.php"> <img src="../../images/MADRIGUERA-LOGO.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top"> Modo administrador </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="league-admin.php"> Ligas </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../../eventos/index.php"> Reserva de eventos </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="statistics.php"> Estadísticas </a>
              </li>
              <li class="nav-item">
                <a class="nav-link rounded ms-5" style="background: #870f0f; color: #ffffff" aria-current="page" href="../user/index.php"> Cerrar sesión </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <div class="container-fluid pt-3 mt-5 text-center">
      <div class="row justify-content-center mx-1">
          <div class="card col-sm-8 col-md-12 col-lg-10 col-xl-8">
            <div class="card-body">
                <h2 class="card-title mb-4 fw-bolder"> <b> Ligas disponibles </b></h2>
                <div class="table-responsive">
                    <table class="table table-dark table-striped table-bordered align-middle">
                        <thead>
                            <tr>  
                                <th> # </th>
                                <th> Nombre de liga </th>
                                <th> Fecha de inicio </th>
                                <th> Fecha de término </th>
                                <th> Tipo </th>
                                <th> Opciones </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php include '../../php/show-league-table.php'; ?>
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
        </div>
    </div>
</body>
</html>



