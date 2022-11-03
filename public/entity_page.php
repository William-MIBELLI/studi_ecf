<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style_dash.css">
    <link rel="shortcut icon" href="../ressources/icones/favicon.png" type="image/x-icon">
    <title>Details</title>
</head>
<body>
    <?php
    include_once "../script/bdd_functions.php";
    spl_autoload_register(function($class) {
        //echo 'on call lautoloader';
        require_once('../models/'.$class.'.php');
    });
    session_start();
    include_once "../templates/header.php";
    if($_SESSION['role_id'] !== 1){
        $msg =  'Vous n\'avez pas les autorisation nécessaires pour accéder à cette page';
        require_once "../templates/forbidden.php";
        die();
    }
    $liste = $_SESSION['entity'];
    $entity = null;
    $entity_permissions_list = [];
    foreach($liste as $item){
        if($item->getUserId() == $_GET['id']){
            $entity = $item;
            $entity_permissions_list = $entity->getPermissionsList();
            $_SESSION['user'] = $entity;
            $_SESSION['entity_permissions_list'] = $entity_permissions_list;
        }
    }
    if($entity == null){
        $msg = 'Des informations sont manquantes pour afficher correctement la page.';
        require_once "../templates/fail.php";
        die();
    }
    ?>

    <div class="main_recup_title">
        <h2>Page de gestion de <?= $entity->getCommercialName()?> Id : <?= $entity->getId(); ?></h2>
    </div>
    <form action="/public/update_entity_page.php" method="POST" class="form_update">
        <?php
        $update = true;
        include_once "../templates/forms_modif.php";
        $list_permissions = [];

        //////////// SI C'EST UNE STRUCTURE ON RECUPERE LA LISTE DES PERMISSIONS DE SON PARTNER ASSOCIES

        if(get_class($entity) == 'Structure'){
            $partner_id = $entity->getPartnerId();
            foreach($liste as $item){
                if(get_class($item) == 'Partner' && $item->getId() == $partner_id){
                    $list_permissions = $item->getPermissionsList();
                }
            }

        }else if (get_class($entity) == 'Partner'){
            $list_permissions = $_SESSION['permissions'];
        }
        include_once '../templates/forms_permissions.php'; ?>
        <button type="submit" class="submit_btn">Valider</button>
    </form>
</body>
</html>
