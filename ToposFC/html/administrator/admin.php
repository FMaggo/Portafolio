<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/homepage.css">
    <link rel="icon" href="../../images/MADRIGUERA-LOGO.png">
    
    
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand"> <img src="../../images/MADRIGUERA-LOGO.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top" "> Modo administrador </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="league-admin.php">Ligas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../eventos/index.php">Reserva de eventos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="statistics.php">Estadísticas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rounded ms-5" style="background: #870f0f; color: #ffffff" aria-current="page" href="../user/index.php"> Cerrar sesión </a>
                    </li>
                </ul>
            </div>
        </div>
   </nav>
    <main class="main-content">
        <div class="overlay">
            <?php echo '<h1> Bienvenido </h1>' . $_SESSION['username']; ?>
        </div>
    </main>
    </section>
    <section > 
        
    </section> 

    <section>
    <div class="content">
    <div class="container">

<div class="card">
    <div class="personaje">
        <div class="imagen_personaje"></div>
        <div class="detalle">
            <h2>Ligas</h2>
            <p>Crea una liga con grandes equipos luchando por obtener el campeonato.</p>
            <a class="btn" href="league-admin.php">Vamos allá!</a>
        </div>
    </div>
</div>

<div class="card">
    <div class="personaje_2">
        <div class="imagen_personaje_2"></div>
        <div class="detalle_2">
            <h2>Reserva-Eventos</h2>
            <p>Es momento de crear un evento, entra aquí para poder agendarlo</p>
            <a class="btn" href="../../eventos/index.php">Vamos allá!</a>
        </div>
    </div>
</div>

<div class="card">
    <div class="personaje_3">
        <div class="imagen_personaje_3"></div>
        <div class="detalle_3">
            <h2>Estadisticas</h2>
            <p>Los jugadores han luchado mucho, registra cada unos de sus logros en este apartado.</p>
            <a class="btn" href="statistics.php">Vamos allá!</a>
        </div>
    </div>
</div>
</div>
</div>
</section> 

</body>
</html>
