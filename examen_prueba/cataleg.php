<?php
session_start();
require("conexion.php");
$nombre = $_SESSION['id_web'];
if (isset($nombre)) {
    $select = "SELECT l.isbn, l.titulo, l.genero, r.fecha_inicio, r.fecha_fin
    FROM libros AS l LEFT JOIN reserva AS r ON l.isbn = r.libro ORDER BY l.isbn";
    $result = $conexion->query($select);
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <style>
            th,td,table{
                border: 1px solid black;
                padding: 10px;
                border-collapse: collapse;
            }
        </style>
        <title>Cataleg - Biblioteca</title>
    </head>

    <body>
        <h1>Llista de llibres</h1>
        <table>
            <tr>
                <th>ISBN</th>
                <th>Título</th>
                <th>Género</th>
                <th>Estado</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($fila = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $fila["isbn"] . "</td>";
                    echo "<td>" . $fila["titulo"] . "</td>";
                    echo "<td>" . $fila["genero"] . "</td>";

                    // Verificar si el libro está reservado en la fecha actual
                    $fecha_actual = date("Y-m-d");
                    if ($fila["fecha_inicio"] <= $fecha_actual && $fila["fecha_fin"] >= $fecha_actual) {
                        echo "<td style='color:red'>Reservat</td>";
                    } else {
                        echo "<td style='color:green'>Lliure</td>";
                    }

                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No hay libros</td></tr>";
            }
            ?>
        </table><br>
        <a href="menu_admin.php">Atrás</a>
    <?php
} else {
    echo "<h2>ERROR NO SE A INICIADO SESSION</h2>";
    echo "<meta http-equiv='refresh' content='0.5;index.php'";
}
// Cierra la conexión con la base de datos
mysqli_close($conexion);
    ?>
    </body>
    </html>