<?php
  if(isset($_GET['id_team'])) {
      require '../../php/databases.php';
      $id_team = $_GET['id_team'];

      // Preparamos la consulta SQL para evitar inyecciones
      $sql = "SELECT team_name FROM team WHERE id_team = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $id_team);

      if ($stmt->execute()) {
        // Obtenemos el resultado de la declaración preparada
        $result = $stmt->get_result();
        $team_name = "";
        if ($result->num_rows == 1) {
          $row = $result->fetch_assoc();
          $team_name = $row['team_name'];
        }

        // Cerramos la declaración preparada
        $stmt->close();
      }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo $team_name; ?></title>
    <link rel="icon" href="../../images/MADRIGUERA-LOGO.png">
    <!-- Bootstrap designs-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Bootstrap icons  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- External CSS file -->
    <link rel="stylesheet" href="../../css/admin.css">
    
    <!-- JavaScript . Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- External JavaScript file  -->
    <script src="../../scripts/forms/form-email-user.js"></script>
    <script src="../../scripts/forms/edit-member-user.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand">
                <img src="../../images/MADRIGUERA-LOGO.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top"> Administración de equipo
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link rounded me-5 px-5" style="background: #870f0f; color: #ffffff;" aria-current="page" href="../../html/user/index.php">Salir</a>
                </li>
            </ul>
        </div>
    </nav>


    <!-- Contenedor principal -->
    <div class="container-fluid pt-3 mt-5 text-center">
    <!-- Tarjeta para la sección de miembros del equipo -->
    <div class="row justify-content-center mx-1">
        <div class="card col-sm-8 col-md-12 col-lg-10 col-xl-8">
            <div class="card-body">
                <h2 class="card-title mb-4 fw-bolder">Miembros de equipo</h2>
                <p class="text-start"><i class="bi bi-star-fill text-warning"></i> - Representa al capitán del equipo</p>
                <!-- Tabla responsiva -->
                <div class="table-responsive">
                    <table class="table table-dark table-bordered align-middle">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Nombre completo </th>
                                <th> Correo electrónico </th>
                                <th> Edad </th>
                                <th> Colonia </th>
                                <th> Teléfono de contacto </th>
                                <th> Opciones </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php include '../../php/show-team-member-table-user.php'; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      </div>
    </div>


    <!-- div en el que se insertan las alertas  -->
    <div id="toastBox" class="position-fixed bottom-0 end-0 p-3" style="z-index: 11"></div>
</body>
</html>