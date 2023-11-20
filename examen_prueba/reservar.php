<?php
session_start();
require("conexion.php");

if (isset($_SESSION['id_web'])) {
  $nombre = $_SESSION['id_web'];
  $select = "SELECT * FROM libros WHERE ISBN NOT IN (SELECT libro FROM reserva)";
  $result = $conexion->query($select);

  if (isset($_GET['reservar'])) {
    $isbn = $_GET['reservar'];
    $fecha_actual = date("Y-m-d");
    $fecha_fin = date("Y-m-d", strtotime("+7 days"));
    $sel = "SELECT * FROM usuarios WHERE nombre = '$nombre'";
    $res = $conexion->query($sel);
    $lin = $res->fetch_assoc();
    $id = $lin["id"];

    $insert = "INSERT INTO reserva (libro, usuario, fecha_inicio, fecha_fin) VALUES ('$isbn', '$id', '$fecha_actual', '$fecha_fin')";
    if ($conexion->query($insert) === TRUE) {
      echo "<span>Libro reservado exitosamente</span>";
      echo "<meta http-equiv='refresh' content='1;reservar.php'>";
    } else {
      echo "<span>Error al reservar el libro</span>";
      echo "<meta http-equiv='refresh' content='1;reservar.php'>";
    }
  }
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
    <h1>Benvingut lector/a <?php echo $nombre; ?></h1>
    <table>
      <tr>
        <th>ISBN</th>
        <th>Título</th>
        <th>Género</th>
        <th>Reservar</th>
      </tr>
      <?php
      if ($result->num_rows > 0) {
        while ($fila = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $fila["ISBN"] . "</td>";
          echo "<td>" . $fila["titulo"] . "</td>";
          echo "<td>" . $fila["genero"] . "</td>";
          echo "<td><a href='?reservar=" . $fila["ISBN"] . "'>Reservar</a></td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='4'>No hay libros</td></tr>";
      }
      ?>
    </table><br>
    <a href="menu_user.php">Atrás</a>
  <?php
} else {
  echo "<h2>ERROR: NO SE HA INICIADO SESIÓN</h2>";
  echo "<meta http-equiv='refresh' content='1.5;index.php'>";
}

// Cierra la conexión con la base de datos
mysqli_close($conexion);
  ?>
  </body>

  </html>