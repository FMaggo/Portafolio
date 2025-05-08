<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Administración de Reservas</title>
    <link rel="stylesheet" type="text/css" href="css/fullcalendar.min.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="icon" href="../images/MADRIGUERA-LOGO.png">
</head>
<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="../html/administrator/admin.php">
                <img src="../images/MADRIGUERA-LOGO.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top"> 
                Modo administrador 
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../html/administrator/league-admin.php">Ligas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Reserva de eventos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  href="../html/administrator/statistics.php">Estadísticas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rounded ms-5" style="background: #870f0f; color: #ffffff" aria-current="page" href="../html/user/index.php"> Cerrar sesión </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php
    include('../php/databases.php');

    $SqlEventos = ("SELECT * FROM reserva");
    $resulEventos = mysqli_query($conn, $SqlEventos);

    ?>

    <div class="container mt-5">
        <div class="card py-4">
        <div class="row">
        <div class="col msjs">
        <?php
        include('msjs.php');
        if (isset($_GET['e'])) {
            if ($_GET['e'] == 1) {
              echo "<div class='alert alert-success'>Evento guardado con éxito.</div>";
        } elseif ($_GET['e'] == 2) {
              echo "<div class='alert alert-danger'>Error: El evento se solapa con otro existente.</div>";
          }
        }
        ?>
</div>

        </div>

        <div id="calendar"></div>

        <?php  
        include('modalNuevoEvento.php');
        include('modalUpdateEvento.php');
        ?>

        
        <script src ="js/jquery-3.0.0.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/moment.min.js"></script>	
        <script type="text/javascript" src="js/fullcalendar.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/es.js"></script>
        

        <script type="text/javascript">
        $(document).ready(function() {
            $("#calendar").fullCalendar({
                header: {
                    left: "prev,next today",
                    center: "title",
                    right: "month,agendaWeek,agendaDay"
                },

                locale: "es",
                defaultView: "agendaWeek",
                navLinks: true, 
                editable: true,
                eventLimit: true, 
                selectable: true,
                selectHelper: false,

                // Nuevo Evento
                select: function(start, end){
                    $("#exampleModal").modal();
                    $("input[name=fecha_inicio]").val(start.format('YYYY-MM-DDTHH:mm'));
                    $("input[name=fecha_fin]").val(end.format('YYYY-MM-DDTHH:mm'));
                },
                  
                events: [
                    <?php while($dataEvento = mysqli_fetch_array($resulEventos)){ ?>
                        {
                            _id: '<?php echo $dataEvento['id']; ?>',
                            title: '<?php echo $dataEvento['evento']; ?>',
                            start: '<?php echo $dataEvento['fecha_inicio']; ?>',
                            end: '<?php echo $dataEvento['fecha_fin']; ?>',
                            color: '<?php echo $dataEvento['color_evento']; ?>'
                        },
                    <?php } ?>
                ],

                // Eliminar Evento
                eventRender: function(event, element) {
                    element.find(".fc-content").prepend("<span id='btnCerrar' class='closeon material-icons'>&#xe5cd;</span>");
                    
                    element.find(".closeon").on("click", function() {
                        var pregunta = confirm("Deseas Borrar este Evento?");   
                        if (pregunta) {
                            $("#calendar").fullCalendar("removeEvents", event._id);

                            $.ajax({
                                type: "POST",
                                url: 'deleteEvento.php',
                                data: {id:event._id},
                                success: function(datos) {
                                    $(".alert-danger").show();
                                    setTimeout(function () {
                                        $(".alert-danger").slideUp(500);
                                    }, 3000); 
                                }
                            });
                        }
                    });
                },

                // Moviendo Evento Drag - Drop
                eventDrop: function(event, delta) {
                    var idEvento = event._id;
                    var start = event.start.format('YYYY-MM-DDTHH:mm');
                    var end = event.end.format('YYYY-MM-DDTHH:mm');

                    $.ajax({
                        url: 'drag_drop_evento.php',
                        data: 'start=' + start + '&end=' + end + '&idEvento=' + idEvento,
                        type: "POST",
                        success: function (response) {
                            //$("#respuesta").html(response);
                        }
                    });
                },

                // Modificar Evento del Calendario 
                eventClick: function(event){
                    var idEvento = event._id;
                    $('input[name=idEvento]').val(idEvento);
                    $('input[name=evento]').val(event.title);
                    $('input[name=fecha_inicio]').val(event.start.format('YYYY-MM-DDTHH:mm'));
                    $('input[name=fecha_fin]').val(event.end.format('YYYY-MM-DDTHH:mm'));

                    $("#modalUpdateEvento").modal();
                },
            });

            // Oculta mensajes de Notificacion
            setTimeout(function () {
                $(".alert").slideUp(300);
            }, 3000); 
        });
        </script>
    </div>
    </div>
</body>
</html>
