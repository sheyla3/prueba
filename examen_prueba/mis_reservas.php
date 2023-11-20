<?php
session_start();
require("conexion.php");

if (isset($_SESSION['id_web'])) {
    $nombre = $_SESSION['id_web'];
    $select = "SELECT l.isbn, l.titulo, l.genero, r.fecha_inicio, r.fecha_fin FROM libros AS l 
    INNER JOIN reserva AS r ON l.isbn = r.libro
    INNER JOIN usuarios AS u ON u.id = r.usuario WHERE u.nombre = '$nombre'";
    $result = $conexion->query($select);
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <style>
            th, td, table {
                border: 1px solid black;
                padding: 10px;
                border-collapse: collapse;
            }
        </style>
        <title>Inicio - Biblioteca</title>
    </head>

    <body>
        <h1>Les meves reserves</h1>
        <table>
            <tr>
                <th>ISBN</th>
                <th>Títul del llibre</th>
                <th>Data inici</th>
                <th>Data final</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($fila = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $fila["isbn"] . "</td>";
                    echo "<td>" . $fila["titulo"] . "</td>";
                    echo "<td>" . $fila["fecha_inicio"] . "</td>";
                    echo "<td>" . $fila["fecha_fin"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No hay reservas</td></tr>";
            }
            ?>
        </table><br>
        <a href="menu_user.php">Atrás</a>
    <?php
} else {
    echo "<h2>ERROR NO SE A INICIADO SESSION</h2>";
    echo "<meta http-equiv='refresh' content='1.5;index.php'";
}
// Cierra la conexión con la base de datos
mysqli_close($conexion);
    ?>
    </body>

    </html>