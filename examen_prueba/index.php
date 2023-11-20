<?php
session_start();
require("conexion.php");
if ($_POST) {
  $nom = $_POST['nom'];
  $contra = $_POST['contra'];
  // VALIDAR USUARIO I PASSWORD && SQL DE RESERCA DE USUARIO I PASSWORD
  $select = "SELECT * FROM usuarios WHERE nombre = '$nom' AND password = '$contra' ";
  // EXECUTAR SENTENCIA SQL ANTERIOR
  $result = $conexion->query($select);
  // CONTAR LES LINIES
  $filas = mysqli_num_rows($result);
  // SI SURT L'USUARI ES REDIRIGEIX A UNA ALTRA PAGINA
  if ($filas > 0) {
    $_SESSION['id_web'] = $_POST['nom'];
    $fila = $result->fetch_assoc();
    if ($fila["rol"] == "administrador") {
      echo "<meta http-equiv='refresh' content='0.5;menu_admin.php'";
    } elseif ($fila["rol"] == "lector") {
      echo "<meta http-equiv='refresh' content='0.5;menu_user.php'";
    }
  } else {
    echo "<span class='error'>Error d'autentificació</span>";
    echo "<meta http-equiv='refresh' content='1.5;index.php'";
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Inicio Session - Biblioteca</title>
</head>

<body class="content">
  <form class="form_prin" action="index.php" method="post" enctype="multipart/form-data">
    <h2>Portal de la Biblioteca</h2>
    <label for="nom">Usuario: </label>
    <input class="form-input" type="nom" name="nom" placeholder="usuario" required><br><br>
    <label for="contra">Contraseña: </label>
    <input class="form-input" type="password" name="contra" placeholder="password" required><br><br>
    <!--<a href="registre.php">Aún no está registrado</a><br><br> -->
    <input class="button" type="submit" name="enviar" value="Aceptar">
  </form>
  <?php
  // Cierra la conexión con la base de datos
  mysqli_close($conexion);
  ?>
</body>

</html>