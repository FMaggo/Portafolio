<?php 
require 'databases.php';

if (isset($_GET['id_league'])) {
    $id_league = $_GET['id_league'];

    $sql = "SELECT 
                team.id_team,
                team.team_name,
                estadistica_nueva.pj,
                estadistica_nueva.g,
                estadistica_nueva.e,
                estadistica_nueva.p,
                estadistica_nueva.gf,
                estadistica_nueva.gc,
                estadistica_nueva.dg,
                estadistica_nueva.pts
            FROM 
                team
            JOIN 
                estadistica_nueva ON team.id_team = estadistica_nueva.id_team
            WHERE
                team.id_league = ?
            ORDER BY
                estadistica_nueva.pts DESC,
                estadistica_nueva.dg DESC,
                estadistica_nueva.gf DESC";

    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("i", $id_league);
    $stmt->execute();
    $result = $stmt->get_result();


    $posicion = 1;

    if ($result->num_rows > 0) {
        while ($consulta = $result->fetch_assoc()) {
            $arreglo =  $consulta['id_team'].','.$posicion.','.$consulta['team_name'].','.$consulta['pj'].','.$consulta['g'].','.$consulta['e'].','.$consulta['p'].','.$consulta['gf'].','.$consulta['gc'].','.$consulta['dg'].','.$consulta['pts'];

            echo "<tr>
                    <td>{$posicion}</td>
                    <td>{$consulta['team_name']}</td>
                    <td>{$consulta['pj']}</td>
                    <td>{$consulta['g']}</td>
                    <td>{$consulta['e']}</td>
                    <td>{$consulta['p']}</td>
                    <td>{$consulta['gf']}</td>
                    <td>{$consulta['gc']}</td>
                    <td>{$consulta['dg']}</td>
                    <td>{$consulta['pts']}</td>
                  </tr>";

            $posicion++;
        }
    } else {
        echo "<tr>
                <td colspan='12'> No se encontraron equipos disponibles </td>
              </tr>";
    }
  }
?>
