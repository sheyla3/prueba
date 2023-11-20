<?php
    session_start();
    require("conexion.php");
    $nombre = $_SESSION['id_web'];
    if (isset($nombre)) {
        $select = "SELECT * FROM usuarios WHERE nombre = '$nombre' ";
        // EJECUTAMOS LA SENTENCIA SQL ANTERIOR
        $result = $conexion->query($select);
        $fila = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Inicio - Biblioteca</title>
  </head>
  <body>
    <h1>Benvingut lector/a  <?php echo $fila["nombre"];?></h1>
    <a href="menu_user.php">Atrás</a>
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