<?php
    require 'databases.php';

    # Eliminar una fila según sea correpondiente (SOLO SI LA LIGA NO TIENE NINGÚN EQUIPO) 
    $showWarningModal = false;
    $warningLeagueName = '';

    if (isset($_POST['deleteLeague'])) {

        $deleteLeague = $_POST['deleteLeague'];
        
        // Preparamos la consulta SQL para evitar inyecciones
        // Verificamos si la liga tiene equipos
        $sql = "SELECT COUNT(*) AS total_league FROM team WHERE id_league = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $deleteLeague);

        if ($stmt->execute()) {

            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if ($row['total_league'] > 0) {

                // Mostramos advertencia
                $showWarningModal = true;

                // Cerramos la declaración preparada
                $stmt->close();

                $sql = "SELECT name FROM league WHERE id_league = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $deleteLeague);
                $stmt->execute();
                $result = $stmt->get_result();
                $league = $result->fetch_assoc();
                $warningLeagueName = $league['name'];

                // Cerramos la declaración preparada
                $stmt->close();

            }

            // Procedemos con la eliminación
            else {
                $sql = "DELETE FROM league WHERE id_league = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $deleteLeague);
    
                if ($stmt->execute()) {
    
                    // Cerramos la declaración preparada
                    $stmt->close();
                }
                else echo "Error al eliminar la liga: " . $stmt->error;
            }
        }
    }
    
    // Mostrar todo el contenido de la base de datos
    $sql = "SELECT * FROM league";
    $result = $conn->query($sql);
    $cont = 1;
    if ($result->num_rows > 0) { 
        while ($row = $result->fetch_assoc()) {
            ?>

            <!-- html -->
            <tr>
                <td> <?php echo $cont; ?> </td>
                <td> <?php echo $row['name'] ?> </td>
                <td> <?php echo $row['date_i'] ?> </td>
                <td> <?php echo $row['date_e'] ?> </td>
                <td> <?php echo $row['type'] ?></td>
                                                
                <!-- Esta parte está terminado -->
                
                <td> 
                    <!-- Botón para editar -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $row['id_league'] ?>"> <i class="bi bi-pencil-fill"> </i> </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal<?php echo $row['id_league'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 text-dark w-100" id="exampleModalLabel"> Editar liga:  <?php echo $row['name'] ?> 🏆 </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                                </div>

                                <!-- Formulario dentro de la ventana emergente  -->
                                <form class="text-dark" name="form<?php echo $row['id_league']?>" method="post" action="../../php/validate-inputs-edit/edit-league.php">
                                    <div class="form-group mt-3 input-control">
                                        <label for="formGroupExampleInput" class="fw-bold mb-1"> Nombre </label>
                                        <div class="row justify-content-center"> 
                                            <div class="col-8">
                                                <input type="text" class="form-control text-center" id="formGroupExampleInput" name="league_name" placeholder="Nombre de liga" value="<?php echo $row['name'] ?>">
                                            </div>                                
                                        </div>
                                        <div class="error"> </div>
                                    </div>
                                    <div class="form-group mt-3 input-control">
                                        <label for="formGroupExampleInput2" class="fw-bold mb-1"> Fecha de inicio </label>
                                        <div class ="row justify-content-center">
                                            <div class="col-8">
                                                <input type="datetime-local" class="form-control text-center" id="formGroupExampleInput2" name="date" placeholder="Selecciona una fecha" value="<?php echo $row['date_i'] ?>">
                                            </div>
                                        </div>
                                        <div class="error"> </div>
                                    </div>
                                    <div class="form-group mt-3 input-control">
                                        <label for="formGroupExampleInput2" class="fw-bold mb-1"> Fecha de término </label>
                                        <div class="row justify-content-center">
                                            <div class="col-8">
                                                <input type="datetime-local" class="form-control text-center" id="formGroupExampleInput2" name="date2" placeholder="Selecciona una fecha" value="<?php echo $row['date_e'] ?>">
                                            </div>
                                        </div>
                                        <div class="error"> </div>
                                    </div>
                                    <div class="form-group mt-3 input-control">
                                        <label for="formGroupExampleInput2" class="fw-bold mb-1"> Tipo </label>
                                        <div class="row justify-content-center">
                                            <div class="col-8">
                                                <select name="type" class="form-control text-center" id="">
                                                    <option value="Varonil" <?php echo ($row['type'] == "Varonil") ? "selected" : "" ?>> Varonil </option>
                                                    <option value="Femenil" <?php echo ($row['type'] == "Femenil") ? "selected" : "" ?>> Femenil </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="error"> </div>
                                    </div>
                                    <input type="hidden" name="editLeague" value="<?php echo $row['id_league']?>">
                                </form>
                                <div class="modal-footer mt-4 closs">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cerrar </button>
                                    <button type="submit" class="btn btn-success" onclick="submitForm(<?php echo $row['id_league']; ?>)"> Guardar cambios </button>
                                </div>
                            </div>
                        </div>
                    </div>
                                        
                    <!--Botón de eliminación-->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteMember<?php echo $row['id_league']?>"> <i class="bi bi-trash3"> </i> </button>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="deleteMember<?php echo $row['id_league']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-18 text-dark w-100" id="msg-color"> <i class="bi bi-exclamation-circle-fill"></i> <span> ¡Advertencia! </span> </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                                    </div>
        
                                    <!-- Formulario dentro de la ventana emergente  -->
                                    <form class="text-dark" method="post">
                                        <div class="form-group mt-3">
                                            <label for="formGroupExampleInput" class="fw-bold mb-1"> ¿Estás seguro de eliminar a la liga: <?php echo $row['name']?>? </label>
                                            <div class="row justify-content-center">                             
                                            </div>
                                        </div>
        
                                        <!--Botones de cerrar ventana emergente y confirmar eliminación de miembro -->
                                        <div class="modal-footer mt-4 text-center justify-content-center">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cancelar </button>
                                            <input type="hidden" name="deleteLeague" value="<?php echo $row['id_league']?>">
                                            <button type="submit" class="btn btn-success"> Confirmar </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    <!-- El signo de ? indica el comienzo de la cadena de consula, es decir, pasa un parámetro a otra página a través de la URL-->
                    <a class="btn btn-warning" href="team-admin.php?id_league=<?php echo $row['id_league'] ?>"> <i class="bi bi-shield-fill"></i> </i> Administrar equipo </a>
                </td>
            </tr>
            <?php
            $cont++;
        }
        ?>

        <!-- Ultima botón  -->
        <tr> 
            <td> ... </td>
            <td> ... </td>
            <td> ... </td>
            <td> ... </td>
            <td> ... </td>

            <!-- Botón para agregar -->
            <td>
                <a class="btn btn-primary" href="league-register.html"> Agregar liga </a>
            </td>
        <tr>
        <?php
    }
    else {
        ?>
        <tr> 
            <td colspan="5"> No se encontraron ligas para participar  </td>
            <td>
                <a class="btn btn-primary" href="league-register.html"> Agregar liga </a>
            </td>
        </tr>
        <?php
    }

    // Mostrar el modal de evitar eliminación
    if ($showWarningModal) {
        echo '<script>
                window.onload = function() {
                    let warningModal = new bootstrap.Modal(document.getElementById("warningModal"));
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
                        No se puede eliminar la liga <?php echo $warningLeagueName; ?> porque tiene equipos asociados.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } 


    // Cerramos la conexión
    $conn->close();
?>
