<?php
session_start();
require("conexion.php");

if (isset($_SESSION['id_web'])) {
    $nombre = $_SESSION['id_web'];
    $select = "SELECT * FROM generos";
    $result = $conexion->query($select);
    if ($_POST) {
        $isbn = $_POST['isbn'];
        $titulo = $_POST['titulo'];
        $genero = $_POST['genero'];
        if (is_numeric($isbn)) {
            $insert = "INSERT INTO libros (ISBN,titulo,genero) VALUES ('$isbn','$titulo','$genero')";
            $res_insert = $conexion->query($insert);
            echo "<script>alert('Insertado correctamente')</script>";
        }else{
            echo "<script>alert('ISBN solo numeros')</script>";
        }
    }
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <title>Inserir - Biblioteca</title>
    </head>

    <body>
        <h1>Añadir libro por <?php echo $nombre; ?></h1>
        <form class="form_prin" action="inserir.php" method="post" enctype="multipart/form-data">
            <label for="isbn">ISBN: </label>
            <input class="form-input" type="text" name="isbn" placeholder="NUM" required><br><br>
            <label for="titulo">Contraseña: </label>
            <input class="form-input" type="text" name="titulo" placeholder="título" required><br><br>
            <label for="genero">Genero:</label>
            <select id="genero" name="genero">
                <?php
                while ($fila = mysqli_fetch_assoc($result)) {
                    echo "<option value=" . $fila["id"] . ">" . $fila["nombre"] . "</option>";
                }
                ?>
            </select><br><br>
            <input class="button" type="submit" name="enviar" value="Aceptar">
        </form><br>
        <a href="menu_admin.php">Atrás</a>
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