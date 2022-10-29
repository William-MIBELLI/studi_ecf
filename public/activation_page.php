<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style_dash.css">
    <title>Changement de statut</title>
</head>
<body>
    <?php
    spl_autoload_register(function($class) {
        require_once('../models/'.$class.'.php');
    });
    session_start();
    include_once "../templates/header.php";
    if($_SESSION['role_id'] !== 1){
        echo 'Vous n\'avez pas les autorisation nécessaires pour accéder à cette page';
        die();
    }
    ?>
    <?php 
    require "../script/activation.php";   
    ?>
</body>
</html>