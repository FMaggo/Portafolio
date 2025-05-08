<?php
    require 'databases.php';

    if (isset($_GET['id_league'])) {
        $id_league = $_GET['id_league'];

        // Preparamos la consulta SQL para evitar inyecciones
        $sql = "SELECT team_member.full_name, team.team_name, goal.goal_number 
                FROM team_member
                JOIN team ON team_member.id_team = team.id_team
                JOIN goal ON goal.id_team_member = team_member.id_team_member
                WHERE team.id_league = $id_league
                ORDER BY goal_number DESC LIMIT 5"; 

        $result = $conn->query($sql);
        $cont = 1;
        if ($result->num_rows >  0) {
            while ($row = $result->fetch_assoc()){
                ?>
                <tr>
                    <td> <?php echo $cont; ?></td>
                    <td> <?php echo $row['full_name']; ?> </td>
                    <td> <?php echo $row['team_name']; ?> </td>
                    <td> <?php echo $row['goal_number']; ?> </td>
                </tr>
                <?php
                $cont++;
            }
        }
        else {
           ?>
            <tr>
                <td colspan="4"> No se encontraron jugadores disponibles </td>
            </tr>
           <?php
        }
    }
?>  