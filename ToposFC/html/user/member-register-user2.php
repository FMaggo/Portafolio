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
    <title> Registro de miembros: <?php echo $team_name; ?> </title>
    <link rel="icon" href="../../images/MADRIGUERA-LOGO.png">

    <!-- Bootstrap designs-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Bootstrap icons  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- External CSS file -->
    <link rel="stylesheet" href="../../css/admin.css">

    <!-- JavaScript - Boostrap  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <!-- External JavaScript file  -->
    <script src="../../scripts/forms/form-member-register.js"> </script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand"> <i class="bi bi-file-text"></i> Registro de miembros </a>
        </div>
    </nav>
    
    <div class="container-fluid d-flex justify-content-center align-items-center margin">
        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 bg-white p-4 text-center"> 
            <h2> Añadir miembro ⚽ </h2>
            <form method="post" name="form" action="../../php/add-member-user2.php?" novalidate>
                <input type="hidden" name="id_team" value="<?php echo $id_team; ?>">
                <div class="form-group mt-3 input-control">
                    <label for="formGroupExampleInput" class="fw-bold mb-1"> Nombre completo </label>
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <input type="text" class="form-control text-center" name="full_name" id="formGroupExampleInput" placeholder="Inserte un nombre completo" autofocus>
                        </div>
                    </div>
                    <div class="error"></div>
                </div>
                <div class="form-group mt-3 input-control">
                    <label for="formGroupExampleInput2" class="fw-bold mb-1"> Correo electrónico </label>
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <input type="email" class="form-control text-center" name="email" id="formGroupExampleInput2" placeholder="russebel15@example.com">
                        </div>
                    </div>
                    <div class="error"></div>
                </div>
                <div class="form-group mt-3 input-control">
                    <label for="formGroupExampleInput3" class="fw-bold mb-1"> Edad </label>
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <input type="number" class="form-control text-center" name="age" id="formGroupExampleInput3" placeholder="Inserte una edad" min="0" max="10">
                        </div>
                    </div>
                    <div class="error"></div>
                </div>
                <div class="form-group mt-3 input-control">
                    <label for="formGroupExampleInput3" class="fw-bold mb-1"> Colonia </label>
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <input type="text" class="form-control text-center" name="cologne" id="formGroupExampleInput3" placeholder="Inserte una colonia">
                        </div>
                    </div>
                    <div class="error"></div>
                </div>
                <div class="form-group mt-3 input-control">
                    <label for="formGroupExampleInput3" class="fw-bold mb-1"> Teléfono de contacto (WhatsApp) </label>
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <input type="text" class="form-control text-center" name="phone" id="formGroupExampleInput3" placeholder="Inserte un telefono de contacto">
                        </div>
                    </div>
                    <div class="error"></div>
                </div>
                <div class="form-group mt-3 input-control">
                    <label for="formGroupExampleInput3" class="fw-bold mb-1"> ¿Cómo te enteraste de la Liga de Fútbol 5 "Madriguera" ? </label>
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <select class="form-control text-center" name="additional" id="">
                                <option value="" disabled selected> Selecciona una opción </option>
                                <option value="Redes Sociales de la Liga"> Redes Sociales de la Liga </option>
                                <option value="Redes Sociales de Topos FC"> Redes Sociales de Topos FC </option>
                                <option value="Invitación Directa"> Invitación Directa </option>
                                <option value="Publicidad Física"> Publicidad Física </option>
                            </select>
                        </div>
                    </div>
                    <div class="error"></div>
                </div>
            </form>
            <div class="row justify-content-center">
                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <button class="btn btn-success mt-5 w-100" href="#" onclick="submitForm()"> <i class="bi bi-check-circle-fill me-1"></i> Enviar registro </button>
                </div>
            </div>
            </div>
        </div>
    </div>
</body>
</html>
