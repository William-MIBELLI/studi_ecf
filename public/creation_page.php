<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style_dash.css">
    <link rel="shortcut icon" href="../ressources/icones/favicon.png" type="image/x-icon">
    <title>Création</title>
</head>
<body>
        <?php
        session_start();
        include "../templates/header.php";
        require_once "../script/bdd_functions.php";
        spl_autoload_register(function($class) {
            //echo 'on call lautoloader';
            require_once('../models/'.$class.'.php');
        });
    
        ?>
    <main class="creation_main">
        <h1>Création d'un nouvel utilisateur</h1>
        <?php 
        if($_SESSION['role_id'] !== 1){
            require_once "../templates/forbidden.php";
            die();
        }
        $list_partner = getPartnersForForms();
        $list_permissions = getAllPermissions();

        ?>
        <form action="../public/creation_confirm_page.php" method="POST" class="form-creation">
            <fieldset>
                <legend>Type d'entité</legend>
                <input class="radio_type"  type="radio" name="type" value="admin" checked>
                <label for="admin">Admin</label>
                <input class="radio_type"  type="radio" name="type" value="partner">
                <label for="partner">Partenaire</label>
                <input class="radio_type"  type="radio" name="type" value="structure">
                <label for="structure">Structure</label>
            </fieldset>
            <label for="partner_list" id="partner_list">Liste des partenaires
                <select name="partner_list">
                    <option value="null"></option>
                    <?php
                    foreach($list_partner as $partner){
                        if($partner['is_active'] == 1){
                            echo '<option value ="'.strval($partner['id_partner']).'">'.$partner['commercial_name'].'</option>';
                        }else{
                            echo '<option value ="'.strval($partner['id_partner']).'" disabled>'.$partner['commercial_name'].'</option>';
                        }
                    }
                    ?>
                </select>
            </label>
            <?php include_once "../templates/forms_modif.php" ?>
            <?php  include_once '../templates/forms_permissions.php';?>
                <button type="submit">Valider</button>
        </form>

    </main>

    <script src="../js/main.js"></script>
</body>
<?php include "../templates/footer.php" ?>
</html>