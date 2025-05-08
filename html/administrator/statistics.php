<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración Estadisticas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" href="../../images/MADRIGUERA-LOGO.png">
    <link rel="stylesheet" href="../../css/admin.css">
</head>
<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="admin.php">
                <img src="../../images/MADRIGUERA-LOGO.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top"> 
                Modo administrador 
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="league-admin.php">Ligas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../eventos/index.php">Reserva de eventos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="statistics.php">Estadísticas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rounded ms-5" style="background: #870f0f; color: #ffffff" aria-current="page" href="../user/index.php"> Cerrar sesión </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Espaciador para evitar que el contenido se solape con la barra de navegación fija -->
    <!-- Botones de acceso para las diferentes tablas  -->
    <div class="container mt-5">
        <p class="text-center fw-bolder fs-2 mb-4 text-white"> Selecciona la liga </p>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <select id="league-select" class="form-select text-center">
                    <?php include '../../php/league-statistics.php'; ?>
                </select>
            </div>

            <div class="col-md-4 mt-3 mt-md-0">
                <button id="btn-position-table" class="btn btn-primary w-100 text-white bg-dark border-dark">Posición</button>
            </div>

            <div class="col-md-4 mt-3 mt-md-0">
                <button id="btn-goalscorer-table" class="btn btn-primary w-100 text-white bg-dark border-dark">Goleo</button>
            </div>
        </div>
    </div>

    <!-- Tabla de goleo (oculta inicialmente) -->
    <div class="container text-center mt-5 goalscorer-table">
        <!-- Tabla de goleo  -->
        <div class="container text-center mt-5">
            <div class="row justify-content-center mx-1">
                <div class="card col-sm-8 col-md-12 col-lg-10 col-xl-8">
                    <div class="card-body">
                        <h2 class="card-title fw-bolder py-3"> Tabla de goleo </h2>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th> Posición </th>
                                        <th> Jugador </th>
                                        <th> Equipo </th>
                                        <th> Goles </th>
                                    </tr>
                                </thead>
                                <tbody id="goalscorer-table">
                                  <?php include '../../php/goalscorer.php'; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de posición (visible inicialmente) -->
    <div class="container text-center mt-5 position-table">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title fw-bolder mb-4"> Tabla de posición </h2>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-dark text-light table-bordered align-middle" id="adm">
                        <thead>
                            <tr>
                                <th>Posición</th>
                                <th>Equipo</th>
                                <th>PJ</th>
                                <th>G</th>
                                <th>E</th>
                                <th>P</th>
                                <th>GF</th>
                                <th>GC</th>
                                <th>DG</th>
                                <th>PTS</th>
                            </tr>
                        </thead>
                        <tbody id="position-table">
                            <?php include('../../php/separar.php'); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modificar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Equipo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="for_adm">
                        <div class="mb-3">
                            <label for="recipient-name" id="id_eli" class="col-form-label">ID:</label>
                            <input type="hidden" class="form-control" id="id_team_" name="id_team_">
                        </div>

                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">PJ:</label>
                            <input type="text" class="form-control" id="pj_" name="pj_">
                        </div>

                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">G:</label>
                            <input type="text" class="form-control" id="g_" name="g_">
                        </div>

                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">E:</label>
                            <input type="text" class="form-control" id="e_" name="e_">
                        </div>

                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">P:</label>
                            <input type="text" class="form-control" id="p_" name="p_">
                        </div>

                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">GF:</label>
                            <input type="text" class="form-control" id="gf_" name="gf_">
                        </div>

                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">GC:</label>
                            <input type="text" class="form-control" id="gc_" name="gc_">
                        </div>

                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">DG:</label>
                            <input type="text" class="form-control" id="dg_" name="dg_">
                        </div>

                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">PTS:</label>
                            <input type="text" class="form-control" id="pts_" name="pts_">
                        </div>

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="modificar_adm">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container text-center my-5">
        <div class="row justify-content-center">
            <div class="card col-sm-8 col-md-11 col-lg-11 col-xl-11 pb-5">
                <div class="card-body">
                    <h2 class="card-title fw-bolder"> Registrar partido </h2>
                </div>
                <form name="form" action="../../php/register-match.php" method="post">
                    <div class="form-group mt-3">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                <label for="select-team-1" class="fw-bold mb-1"> Equipo 1 </label> 
                                <select class="form-select text-center w-100" id="select-team-1" name="team1">
                                    <!-- opciones de elección de equipo 1 -->
                                </select>
                            </div>  
                            <div class="col-auto align-center">
                                <p class="fw-bolder">VS</p>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                <label for="select-team-2" class="fw-bold mb-1"> Equipo 2 </label>
                                <select class="form-select text-center w-100" id="select-team-2" name="team2">
                                    <!-- opciones de elección de equipo 2 -->
                                </select>
                            </div>                                  
                        </div>

                        <p class="fw-bolder mt-4 fs-5"> Registrar gol(es) por jugador </p>
                        <div class="row justify-content-center align-items-center mt-2">
                            <div class="col-sm-6 col-md-3 col-lg-2 col-xl-3">
                                <label for="num-goles-1" class="fw-bold mb-1"> Número de gol(es) </label>
                                <input class="form-control text-center" type="number" min="0" id="num-goles-1" name="num-gol-1">
                            </div>  
                            <div class="col-sm-6 col-md-3 col-lg-2 col-xl-3">
                                <label for="jugador-responsable-1" class="fw-bold mb-1"> Jugador </label>
                                <select class="form-select text-center w-100" id="jugador-responsable-1" name="player1">
                                    <!-- opciones del equipo 1 -->
                                </select>
                            </div> 
                            <div class="col-sm-6 col-md-3 col-lg-2 col-xl-3">
                                <label for="num-goles-2" class="fw-bold mb-1"> Número de gol(es) </label>
                                <input class="form-control text-center" type="number" min="0" id="num-goles-2" name="num-gol-2">
                            </div>
                            <div class="col-sm-6 col-md-3 col-lg-2 col-xl-3">
                                <label for="jugador-responsable-2" class="fw-bold mb-1"> Jugador </label>
                                <select class="form-select text-center w-100" id="jugador-responsable-2" name="player2">
                                    <!-- opciones del equipo 2 -->
                                </select>
                            </div>
                            <div class="addDiv"> </div>

                        </div> 

                        <div class="row justify-content-center mt-4">
                            <div class="col d-flex justify-content-center">
                                <!-- <button class="btn btn-primary" type="button" onclick="agregarGol()">Agregar registro de gol ⚽</button> -->
                            </div>
                        </div>
                        <button class="btn btn-success mt-5" type="submit"><i class="bi bi-check-circle-fill me-1"></i> Agregar partido </button>
                    </div>
                </form>
            </div>
            </div>
        </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- <script src="../../scripts/addDiv.js"></script> -->
    <script> 
    function agregarGol() {
    // Obtener el contenedor donde se agregarán las nuevas entradas
    const contenedor = document.querySelector('.form-group');

    // Crear un nuevo div para las entradas
    const nuevoDiv = document.createElement('div');
    nuevoDiv.classList.add('row', 'justify-content-center', 'align-items-center', 'mt-2');

    // Agregar las entradas para el número de goles y el jugador responsable
    nuevoDiv.innerHTML = `
        <div class="col-sm-6 col-md-3 col-lg-2 col-xl-3">
            <label class="fw-bold mb-1">Número de gol(es)</label>
            <input class="form-control text-center" type="number" min="0" name="num-gol1">
        </div>
        <div class="col-sm-6 col-md-3 col-lg-2 col-xl-3">
            <label class="fw-bold mb-1">Jugador</label>
            <select class="form-select text-center w-100" name="player1">
                <!-- Aquí deberías insertar las opciones de jugadores dinámicamente -->
            </select>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-2 col-xl-3">
            <label class="fw-bold mb-1">Número de gol(es)</label>
            <input class="form-control text-center" type="number" min="0" name="num-gol2">
        </div>
        <div class="col-sm-6 col-md-3 col-lg-2 col-xl-3">
            <label class="fw-bold mb-1">Jugador</label>
            <select class="form-select text-center w-100" name="player2">
                <!-- Aquí deberías insertar las opciones de jugadores dinámicamente -->
            </select>
        </div>
    `;

    // Insertar el nuevo div después del último div que contiene las primeras cuatro entradas
    const divsPrincipales = document.querySelectorAll('.form-group > .row');
    const ultimoDivPrincipal = divsPrincipales[divsPrincipales.length - 1];
    ultimoDivPrincipal.parentNode.insertBefore(nuevoDiv, ultimoDivPrincipal.nextSibling);
}


    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const btnPosition = document.getElementById("btn-position-table");
            const btnGoalscorer = document.getElementById("btn-goalscorer-table");
            const positionTable = document.querySelector(".position-table");
            const goalscorerTable = document.querySelector(".goalscorer-table");

            // Tablas por defecto
            positionTable.style.display = "block";
            goalscorerTable.style.display = "none";

            btnPosition.addEventListener("click", function () {
                positionTable.style.display = "block";
                goalscorerTable.style.display = "none";
            });

            btnGoalscorer.addEventListener("click", function () {
                goalscorerTable.style.display = "block";
                positionTable.style.display = "none";
            });

            function updateJugadorResponsableState() {
                const team1Selected = document.getElementById('select-team-1').value !== "";
                const team2Selected = document.getElementById('select-team-2').value !== "";
                
                const jugadorResponsable1 = document.getElementById('jugador-responsable-1');
                const jugadorResponsable2 = document.getElementById('jugador-responsable-2');
                
                jugadorResponsable1.disabled = !team1Selected;
                jugadorResponsable2.disabled = !team2Selected;

                if (!team1Selected) {
                    jugadorResponsable1.innerHTML = '<option value="" disabled selected> Desactivado </option>';
                }

                if (!team2Selected) {
                    jugadorResponsable2.innerHTML = '<option value="" disabled selected> Desactivado </option>';
                }
            }

            function loadInitialTable() {
                let id_league = document.getElementById('league-select').value;
                changePositionTable(id_league);
                changeGoalscorerTable(id_league);
                changeTeam1(id_league);
                changeTeam2(id_league);
            }

            loadInitialTable();

            function changeMember1(id_team) {
                let xhr = new XMLHttpRequest();
                xhr.open('GET', '../../php/select-member.php?id_team=' + id_team, true);
                xhr.onload = function () {
                    if (this.status == 200) {
                        const jugadorSelect = document.getElementById('jugador-responsable-1');
                        jugadorSelect.innerHTML = this.responseText;
                        if (!jugadorSelect.innerHTML.trim()) {
                            jugadorSelect.innerHTML = '<option value="" disabled selected> Desactivado </option>';
                        }
                    }
                };
                xhr.send();
            }

            document.getElementById('select-team-1').addEventListener('change', function() {
                changeMember1(this.value);
                updateJugadorResponsableState();
            });

            function changeMember2(id_team) {
                let xhr = new XMLHttpRequest();
                xhr.open('GET', '../../php/select-member.php?id_team=' + id_team, true);
                xhr.onload = function () {
                    if (this.status == 200) {
                        const jugadorSelect = document.getElementById('jugador-responsable-2');
                        jugadorSelect.innerHTML = this.responseText;
                        if (!jugadorSelect.innerHTML.trim()) {
                            jugadorSelect.innerHTML = '<option value="" disabled selected> Desactivado </option>';
                        }
                    }
                };
                xhr.send();
            }

            document.getElementById('select-team-2').addEventListener('change', function() {
                changeMember2(this.value);
                updateJugadorResponsableState();
            });

            function changeTeam1(id_league) {
                let xhr = new XMLHttpRequest();
                xhr.open('GET', '../../php/select-team.php?id_league=' + id_league, true);
                xhr.onload = function () {
                    if (this.status == 200) {
                        document.getElementById('select-team-1').innerHTML = this.responseText;
                    }
                };
                xhr.send();
            }

            function changeTeam2(id_league) {
                let xhr = new XMLHttpRequest();
                xhr.open('GET', '../../php/select-team.php?id_league=' + id_league, true);
                xhr.onload = function () {
                    if (this.status == 200) {
                        document.getElementById('select-team-2').innerHTML = this.responseText;
                    }
                };
                xhr.send();
            }

            function changePositionTable(id_league) {
                let xhr = new XMLHttpRequest();
                xhr.open('GET', '../../php/separar.php?id_league=' + id_league, true);
                xhr.onload = function () {
                    if (this.status == 200) {
                        document.getElementById('position-table').innerHTML = this.responseText;
                    }
                };
                xhr.send();
            }

            function changeGoalscorerTable(id_league) {
                let xhr = new XMLHttpRequest();
                xhr.open('GET', '../../php/goalscorer.php?id_league=' + id_league, true);
                xhr.onload = function () {
                    if (this.status == 200) {
                        document.getElementById('goalscorer-table').innerHTML = this.responseText;
                    }
                };
                xhr.send();
            }

            document.getElementById('league-select').addEventListener('change', function () {
                changePositionTable(this.value);
                changeGoalscorerTable(this.value);
                changeTeam1(this.value);
                changeTeam2(this.value);
                updateJugadorResponsableState();
            });

            // Inicializar el estado de los selects de jugadores
            updateJugadorResponsableState();

            // Goles por defecto
            document.getElementById('num-goles-1').value = 0;
            document.getElementById('num-goles-2').value = 0;
        });
    </script>
    </script>
</body>
</html>