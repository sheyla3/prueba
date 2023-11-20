<?php
    session_start();
    require("conexion.php");
    $nombre = $_SESSION['id_web'];
    if (isset($nombre)) {
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Inicio - Biblioteca</title>
  </head>
  <body>
    <h1>Benvingut usuari bibliotecari/ària <?php echo $nombre;?></h1>
    <a href="inserir.php">Inserir nou llibre</a><br><br>
    <a href="cataleg.php">Veure catàleg de llibres</a><br><br>
    <a href="sortir.php">Sortir</a>
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