<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style_dash.css">
    <link rel="stylesheet" href="../css//style_item.css">
    <link rel="shortcut icon" href="../ressources/icones/favicon.png" type="image/x-icon">
    <!-- <link rel="stylesheet" href="../css/style_recup.css"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Oswald:wght@200;300;400&family=Permanent+Marker&display=swap" rel="stylesheet">
    <title>Dashboard</title>
</head>
<body class="body">
    <?php
    spl_autoload_register(function($class) {
        require_once('../models/'.$class.'.php');
    });
    session_start();
    include '../templates/header.php';
    include_once '../script/bdd_functions.php';
    $role = $_SESSION['role_id'];
    switch($role){
        case 1:
            $demandes = getRequests();
            require_once "../templates/dashboard_admin.php";
            break;
        case 2:
            require_once "../templates/dashboard_partner.php";
            break;
        case 3:
            require_once "../templates/dashboard_structure.php";
            break;
        default:
            echo 'Une erreur pendant l\'affichage du dashboard s\'est produite';
            return null;
    }
    ?>  
    <?php include '../templates/footer.php'?>
    <!-- <script src="../js/main.js"></script> -->
</body>
</html>