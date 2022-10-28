<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style_dash.css">
    <title>Traitement de la demande</title>
</head>
<body>
    <?php
    include_once "../templates/header.php";
    require_once "../script/bdd_functions.php";
    spl_autoload_register(function($class) {
        require_once('../models/'.$class.'.php');
    });
    session_start();
    if($_SESSION['role_id'] !== 1){
        $msg =  'Vous n\'avez pas les autorisation nécessaires pour accéder à cette page';
        require_once "../templates/forbidden.php";
        die();
    }
    if(!isset($_GET['id']) || !isset($_GET['statut']) || ($_GET['statut'] != 'true' && $_GET['statut'] != 'false')){
        $msg = 'Des informations sont manquantes pour traiter la requête';
        require_once "../templates/fail.php";
        die();
    }
    if(!deleteRequest($_GET['id'])){
        $msg = 'La demande est introuvable dans la base de donnée';
        require_once "../templates/fail.php";
    }else{
        $msg = 'La demande a été traitée et un mail de confirmation a été envoyé';
        //sendMail($_GET['statut'], $_GET['mail']);
        require_once "../templates/success.php";
    }
    ?>
</body>
</html>
