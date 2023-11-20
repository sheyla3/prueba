<?php
//INICIAMOS SESSION
session_start();
//CERRAMOS SESSION
session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"/>
<title>Cerrar Sesión</title>
</head>
<body>
    <?php
    //SORTIM DE LA SESSIO
      if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
        );
      }
    //REDICCIONAMOS AL INDEX
    ?>
    <h2>Has tancat sessió</h2>
    <meta http-equiv="refresh" content="0.5;url=index.php">
</body>
