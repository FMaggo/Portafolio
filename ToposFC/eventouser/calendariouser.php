<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Calendario y Reservas</title>
  <link rel="icon" href="../images/MADRIGUERA-LOGO.png">
  <link rel="icon" href="../../images/MADRIGUERA-LOGO.png">
	<link rel="stylesheet" type="text/css" href="css/fullcalendar.min.css">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
 
  
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/home.css">
</head>
<body>
<header class="pag1">
<nav class="nav-bar">
  <ul id="nav-list">
  <div class="izquierda">
      <li> <img src="../images/MADRIGUERA-LOGO.png" alt="Topos FC"></li>
      <li> <a href="../html/user/index.php"> Inicio </a> </li>
      <li> <a href="../eventouser/calendariouser.php"> Calendario y Reservas </a> </li>
      <li> <a href="../html/user/contact.php"> Contactanos </a> </li>
      </div>
      <div id="derecha_b">
        <a class="boton_nav" href="../html/administrator/login.html" style="text-decoration:none; color:black;">¿Eres administrador?</a>
      </div>
  </ul>
  
</nav>
</header>
<?php
include('../php/databases.php');

  $SqlEventos   = ("SELECT * FROM reserva");
  $resulEventos = mysqli_query($conn, $SqlEventos);

?>

<div class="container">
  <div class="row">
    <div class="col msjs">
      <?php
        include('msjs.php');
      ?>
    </div>
  </div>

  
  <div class="col-md-12 mb-3">
    <h3 class="text-center" id="title" style="font-family: 'Arial', sans-serif; text-shadow: 2px 2px 5px #aaa; margin-top: 20px;">
      Calendario de Reservas de Cancha
    </h3>
  </div>
</div>
</div>

<div id="calendar"></div>


<?php  
  include('modalNuevoEvento.php');
  /*include('modalBorrarEvento.php');*/
?>

<script src ="js/jquery-3.0.0.min.js"> </script>
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

    locale: 'es',

    defaultView: "month",
    navLinks: true, 
    editable: true,
    eventLimit: true, 
    selectable: true,
    selectHelper: false,

    //Nuevo Evento
    select: function(start, end){
      $("#exampleModal").modal();
      $("input[name=fecha_inicio]").val(start.format('DD-MM-YYYY'));

      var valorFechaFin = end.format("DD-MM-YYYY");
      var F_final = moment(valorFechaFin, "DD-MM-YYYY").subtract(1, 'days').format('DD-MM-YYYY'); //Le resto 1 dia
      $('input[name=fecha_fin').val(F_final);  
    },
      
    events: [
      <?php while($dataEvento = mysqli_fetch_array($resulEventos)){ ?>
        {
          _id: '<?php echo $dataEvento['id']; ?>',
          title: '<?php echo $dataEvento['evento']; ?>',
          start: '<?php echo $dataEvento['fecha_inicio']; ?>',
          end:   '<?php echo $dataEvento['fecha_fin']; ?>',
          color: '<?php echo $dataEvento['color_evento']; ?>'
        },
      <?php } ?>
    ],
  });

  //Oculta mensajes de Notificacion
  setTimeout(function () {
    $(".alert").slideUp(300);
  }, 3000); 
});
</script>
