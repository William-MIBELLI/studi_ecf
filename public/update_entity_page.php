<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style_dash.css">
    <link rel="shortcut icon" href="../ressources/icones/favicon.png" type="image/x-icon">
    <title>Mise à jour</title>
</head>
<body>
    <?php
    spl_autoload_register(function($class) {
        require_once('../models/'.$class.'.php');
    });
    session_start();
    if($_SESSION['role_id'] !== 1){
        $msg = 'Vous n\'avez pas les autorisations nécessaires pour accéeder à cette page. </br>';
        require_once "../templates/forbidden.php";
        die();
    }
    ?>
    <?php require_once "./update_confirm_page.php" ?>
</body>
</html>