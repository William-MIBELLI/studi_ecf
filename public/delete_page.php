<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style_dash.css">
    <title>Page de suppression</title>
</head>
<body>
    <?php
    include_once "../templates/header.html";
    spl_autoload_register(function($class) {
        //echo 'on call lautoloader';
        require_once('../models/'.$class.'.php');
    });
    session_start();
    if($_SESSION['role_id'] !== 1){
        $msg =  'Vous n\'avez pas les autorisation nécessaires pour accéder à cette page';
        require_once "../templates/forbidden.php";
        die();
    }
    require "../script/delete_entity.php";
    ?>
</body>
</html>