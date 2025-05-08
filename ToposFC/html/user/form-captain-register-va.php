<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Registro de equipo </title>
    <link rel="icon" href="../../images/MADRIGUERA-LOGO.png">

    <!-- Bootstrap designs-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Bootstrap icons  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- External CSS file -->
    <link rel="stylesheet" href="../../css/form-register-user.css">

    <!-- JavaScript - Boostrap  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <!-- External JavaScript file  -->
    <script src="../../scripts/forms/form-team-register-user.js"></script>
</head>
<body>
    <div class="container-fluid d-flex justify-content-center align-items-center margin">
        <div class="col-sm-8 col-md-5 col-lg-5 col-xl-5 bg-white p-4 text-center rounded">
            <h2> Formulario de registro de equipo </h2>
            <form action="../../php/add-team-user.php" name="form" method="POST">
                <div class="form-group mt-3 input-control"> 
                    <label class="fw-bold mb-1"> Introduce tu nombre completo </label class="fw-bold mb-1">
                    <div class="row justify-content-center">
                        <div class="col-9">
                            <input class="form-control text-center" type="text" name="full_name" placeholder="Ingresa tu nombre completo">
                        </div>                    
                    </div>
                    <div class="error"></div>
                </div>
                <div class="form-group mt-3 input-control">
                    <label class="fw-bold mb-1"> Introduce tu correo electrónico </label>
                    <div class="row justify-content-center">
                        <div class="col-9">
                            <input class="form-control text-center" type="email" name="email" placeholder="Ingresa tu correo electrónico">
                        </div> 
                    </div>
                    <div class="error"></div>
                </div>
                <div class="form-group mt-3 input-control">
                    <label class="fw-bold mb-1"> Introduce tu edad </label>
                    <div class="row justify-content-center">
                        <div class="col-9">
                            <input class="form-control text-center" type="number" name="age" placeholder="Ingresa tu edad" min="0">
                        </div>
                    </div>
                    <div class="error"></div>
                </div>
                <div class="form-group mt-3 input-control">
                    <label class="fw-bold mb-1"> Introduce tu colonia </label>
                    <div class="row justify-content-center">
                        <div class="col-9">
                            <input class="form-control text-center" type="text" name="cologne" placeholder="Ingresa tu colonia">
                        </div>
                    </div>
                    <div class="error"></div>
                </div>
                <div class="form-group mt-3 input-control">
                    <label class="fw-bold mb-1"> Introduce tu teléfono </label>
                    <div class="row justify-content-center">
                        <div class="col-9">
                            <input class="form-control text-center" type="text" name="phone" placeholder="Ingresa tu teléfono">
                        </div>
                    </div>
                    <div class="error"></div>
                </div>
                <div class="form-group mt-3 input-control">
                    <label class="fw-bold mb-1"> Elige una liga </label>
                    <div class="row justify-content-center">
                        <div class="col-9">
                            <select name="id_league" class="form-select text-center">
                                <?php include '../../php/league-va.php'; ?>
                            </select>
                        </div>
                    </div>
                    <div class="error"></div>
                </div>
                <div class="form-group mt-3 input-control">
                    <label class="fw-bold mb-1"> Escribe el nombre de tu equipo </label>
                    <div class="row justify-content-center"> 
                        <div class="col-9">
                            <input class="form-control text-center" name="team_name" placeholder="Ingresa un nombre de tu preferencia">
                        </div>
                    </div>
                    <div class="error"></div>
                </div>
                <div class="form-group mt-3 input-control">
                    <label class="fw-bold mb-1"> ¿Cómo se enteró de la Liga "Madriguera"? </label>
                    <div class="row justify-content-center">
                        <div class="col-9">
                            <select  name="additional" class="form-select text-center">
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
                <div class="col-9">     
                    <button class="btn btn-primary mt-5 w-100" onclick="submitForm()"> Registrarse </button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
