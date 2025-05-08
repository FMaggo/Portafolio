<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="../../css/contacto.css">
<link rel="icon" href="../../images/MADRIGUERA-LOGO.png">
<title>Topos</title>
  <meta charset="UTF-8">
  <style>
    .data p {
    display: flex;
    align-items: center;
    margin: 0;
}

.data i {
    margin-right: 8px;
}

  </style>
</head>
<body>
<nav class="nav-bar">
  <ul id="nav-list">
  <div class="izquierda">
      <li> <img src="../../images/MADRIGUERA-LOGO.png" alt="Topos FC"></li>
      <li> <a href="index.php"> Inicio </a> </li>
      <li> <a href="../../eventouser/calendariouser.php"> Calendario y Reservas </a> </li>
      <li> <a href="contact.php"> Contactanos </a> </li>
      </div>
      <div id="derecha_b">
        <a class="boton_nav" href="../administrator/login.html">¿Eres administrador?</a>
      </div>
  </ul>
</nav>
<header class="pag1">
</header>

<section class="fondo">

<div class="container">
        <div class="box-info">
            <h1>CONTÁCTATE CON NOSOTROS</h1>
            <div class="data">
              <p><i class="fa-solid fa-phone"></i> 222 234 23 2321</p>
              <p><i class="fa-solid fa-envelope"></i> contacto@toposfc.org</p>
              <p><i class="fa-solid fa-location-dot"></i> "Madriguera": Calle 5 A Sur 13926, Col. San Juan Bautista, Puebla, Pue. C.P. 72495</p>
            </div>

            <div class="links" style="margin-top: 200px">
                <a href="https://www.facebook.com/ToposFCPuebla/?locale=es_LA"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/toposfcpuebla/"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://x.com/ToposFCPuebla"><i class="fa-brands fa-twitter"></i></a>
                <a href="https://www.linkedin.com/company/toposfcpuebla/?originalSubdomain=mx"><i class="fa-brands fa-linkedin"></i></a>
            </div>
        </div>


  <div class="row">
    <div class="column">
      <form action="../../php/mailgun.php" method="post" id="contact-form">
        <?php echo((!empty($errorMessage)) ? $errorMessage : '') ?>
        <table>
          <tr>
            <td class="info"><label for="full_name">Nombre *</label></td>
            <td><input type="text" id="full_name" name="full_name" required minlength="3" maxlength="100"></td>
          </tr>
          <tr>
            <td class="info"><label for="phone">Telefono</label></td>
            <td><input type="tel" id="phone" name="phone"></td>
          </tr>
          <tr>
            <td class="info"><label for="email">Correo *</label></td>
            <td><input type="email" id="email" name="email" required></td>
          </tr>
          <tr>
            <td class="info"><label for="subjec">Tema *</label></td>
            <td><input type="text" id="subjec" name="subjec" required></td>
          </tr>
          <tr>
            <td class="info"><label for="question">Mensaje *</label></td>
            <td><textarea id="question" name="question"></textarea></td>
          </tr>
          <tr>
            
          </tr>
        </table>
        <button type="submit" class="button">Enviar</button>
      </form>
    </div>
    <div class="column">
      
    </div>
  </div>
  <script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>

 <script>

     const constraints = {
         full_name: {
             presence: {allowEmpty: false}
         },
         email: {
             presence: {allowEmpty: false},
             email: true
         },
         question: {
             presence: {allowEmpty: false}
         }
     };

     const form = document.getElementById('contact-form');
     form.addEventListener('submit', function (event) {
         const formValues = {
             full_name: form.elements.full_name.value,
             email: form.elements.email.value,
             question: form.elements.question.value

         };

         const errors = validate(formValues, constraints);

         if (errors) {
           event.preventDefault();
             const errorMessage = Object
                 .values(errors)
                 .map(function (fieldValues) {
                     return fieldValues.join(', ')
                 })
                 .join("\n");
             alert(errorMessage);

         }

     }, false); 
 </script>
</body>
    </fondo>
</html>