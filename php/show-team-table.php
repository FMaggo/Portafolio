<?php
    // Eliminar equipo

    # Eliminar una fila según sea correpondiente (SOLO SI LA LIGA NO TIENE NINGÚN EQUIPO) 
    $showWarningModal = false;
    $warningTeamName = '';

    if (isset($_POST['deleteTeam'])) {
        $deleleTeam = $_POST['deleteTeam'];

        // Verificamos si el equipo tiene por lo menos 1 miembro
        $sql = "SELECT COUNT(*) AS total_member FROM team_member WHERE id_team = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $deleleTeam);

        if ($stmt->execute()) {

            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if ($row['total_member'] > 0) {
                $showWarningModal = true; 
                
                $sql = "SELECT team_name FROM team WHERE id_team = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $deleleTeam);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $warningTeamName = $row['team_name'];

            }
        }
        else {
            // Preparamos la consulta SQL para evitar inyecciones
            $sql = "DELETE FROM team WHERE id_team = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $deleleTeam);

            if ($stmt->execute()) {
                echo "Equipo eliminado correctamente.";
                $stmt->close();
            } else {
                echo "Error al eliminar el equipo: " . $stmt->error;
            }
        }
    }

    // Obtener todos los equipos relacionados con una liga y preparamos la consulta SQL para evitar inyecciones 
    $sql = "SELECT * FROM team WHERE id_league = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_league);

    if ($stmt->execute()) {
        // Obtenemos el resultado de la consulta preparada
        $result = $stmt->get_result();
        $cont = 1;

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id_team = $row['id_team'];
                // Obtener el nombre del capitán del equipo
                $sql = "SELECT full_name FROM team_member WHERE id_team = $id_team LIMIT 1"; // LIMIT se usa para restringir el número de filas
                $result_name = $conn->query($sql);
                $row_name = $result_name->fetch_assoc();

                // Obtenemos la longitud de los miembros de un equipo para determinar su inscripción a la liga
                $sql_length_table = "SELECT COUNT(*) AS total FROM team_member WHERE id_team = $id_team";
                $result_length = $conn->query($sql_length_table);
                $row_length = $result_length->fetch_assoc();
                ?>
                <tr>
                    <td> <?php echo $cont; ?> </td>
                    <td> <?php echo $row['team_name']; ?> </td>
                    <td> <?php echo $row_name['full_name']; ?> </td>
                    <td> <?php echo ($row_length['total'] < 5) ? "No inscrito" : "Inscrito"; ?></td>
                    <td>
                        <!-- Botón para editar -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $row['id_team']?>"> <i class="bi bi-pencil-fill"> </i> </button>
                                    
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal<?php echo $row['id_team']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5 text-dark w-100" id="exampleModalLabel"> Editar equipo </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                                    </div>

                                    <!-- Formulario dentro de la ventana emergente  -->
                                    <form class="text-dark" name="form<?php echo $row['id_team']; ?>" method="post" action="../../php/validate-inputs-edit/edit-team.php">
                                        <div class="form-group mt-3 input-control">
                                            <label for="formGroupExampleInput" class="fw-bold mb-1"> Nombre de equipo </label>
                                            <div class="row justify-content-center"> 
                                                <div class="col-8">
                                                    <input type="text" class="form-control text-center" id="formGroupExampleInput" name="name" placeholder="Nombre de equipo" value="<?php echo $row['team_name']?>" >
                                                </div>                                
                                            </div>
                                            <div class="error"> </div>
                                        </div>
                                        <input type="hidden" name="editTeam" value="<?php echo $row['id_team']; ?>">
                                        <input type="hidden" name="league" value="<?php echo $id_league; ?>">
                                    </form>
                                    <div class="modal-footer mt-4">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cerrar </button>
                                        <button type="button" class="btn btn-success" onclick="submitForm(<?php echo $row['id_team']; ?>)"> Guardar cambios </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Botón de eliminación-->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteMember<?php echo $row['id_team']?>"> <i class="bi bi-trash3"> </i> </button>
                                
                        <!-- Modal -->
                        <div class="modal fade" id="deleteMember<?php echo $row['id_team']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-18 text-dark w-100" id="msg-color"> <i class="bi bi-exclamation-circle-fill"></i> <span> ¡Advertencia! </span> </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                                    </div>
                
                                    <!-- Formulario dentro de la ventana emergente  -->
                                    <form class="text-dark" method="post">
                                        <div class="form-group mt-3">
                                            <label for="formGroupExampleInput" class="fw-bold mb-1"> ¿Estás seguro de eliminar al equipo: <?php echo $row['team_name']?>? </label>
                                            <div class="row justify-content-center">                             
                                            </div>
                                        </div>
                
                                        <!--Botones de cerrar ventana emergente y confirmar eliminación de miembro -->
                                        <div class="modal-footer mt-4 text-center justify-content-center">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cancelar </button>
                                            <input type="hidden" name="deleteTeam" value="<?php echo $row['id_team']?>">
                                            <button type="submit" class="btn btn-success"> Confirmar </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <a class="btn btn-warning" href="team-member-admin.php?id_team=<?php echo $row['id_team'] ?>"> <i class="bi bi-person-fill"> </i> Administrar miembros </a>
                        <?php $cont++; ?>
                    </td>
                </tr>
                <?php
            }
            ?>
                <tr> 
                    <td> ... </td>
                    <td> ... </td>
                    <td> ... </td>
                    <td> ... </td>
                    <td> <a class="btn btn-primary" href="team-register.php?id_league=<?php echo $id_league?>"> Agregar equipo </a> </td>
                </tr>
            <?php
        } else {
            ?>
            <tr> 
                <td colspan="4"> No se encontraron equipos para esta liga </td>
                <td>
                    <a class="btn btn-primary" href="team-register.php?id_league=<?php echo $id_league?>"> Agregar equipo </a>
                </td>
            </tr>
            <?php
        }

        if ($showWarningModal) {
            echo '<script>
                    window.onload = function() {
                        var warningModal = new bootstrap.Modal(document.getElementById("warningModal"));
                        warningModal.show();
                    };
                  </script>';
            ?>
            <div class="modal fade" id="warningModal" tabindex="-1" aria-labelledby="warningModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title w-100 text-center text-danger" id="warningModalLabel"> <i class="bi bi-exclamation-circle-fill"></i> Eliminación denegada </h3>
                        </div>
                        <div class="modal-body fw-bolder">
                            No se puede eliminar el equipo <?php echo $warningTeamName; ?> porque tiene miembros asociados.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php

        // Cerramos la declaración preparada
        $stmt->close();
        }
    }
    
?>
