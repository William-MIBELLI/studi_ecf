<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style_dash.css">
    <title>Création</title>
</head>
<body>
        <?php
        include "../templates/header.html";
        spl_autoload_register(function($class) {
            //echo 'on call lautoloader';
            require_once('../models/'.$class.'.php');
        });
    
        ?>
    <main class="creation_main">
        <?php 
        session_start();
        if($_SESSION['role_id'] !== 1){
            require_once "../templates/forbidden.php";
            die();
        }
            $list_partner = [];
            $list_permissions = [];
            try{        
                $pdo = new PDO('mysql:host=localhost;dbname=ecf_database', 'root');
            }catch(PDOException $e){
                var_dump($e->getMessage());
            }
            if($pdo){
                try{
                    $stmt = $pdo->prepare('SELECT commercial_name, id_partner  FROM user 
                    JOIN partner ON partner.user_id = user.id_user');
                     if($stmt->execute()){
                        while($res = $stmt->fetch(PDO::FETCH_ASSOC)){
                            $list_partner[] = $res;
                        }
                     }
                     $stmt2 = $pdo->prepare('SELECT * FROM permission');
                     if($stmt2->execute()){
                        while($res = $stmt2->fetch(PDO::FETCH_ASSOC)){
                            $perm = new Permission(...$res);
                            $list_permissions[] = $perm;
                        }
                     }
                    
                    }catch(PDOException $e){
                        var_dump($e->getMessage());
                    }
                    if(!$res || $res != 0){
                        $structure = $pdo->query('SELECT * FROM user WHERE id_user = 2', PDO::FETCH_ASSOC)->fetch();
                        if(count($_POST) != 0){
                            foreach($_POST as $key => $item){
                                echo $key.' : '.$item.PHP_EOL; 
                            }
                        }
                }
            }
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
                        echo '<option value ="'.strval($partner['id_partner']).'">'.$partner['commercial_name'].'</option>';
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
<?php include "../templates/footer.html" ?>
</html>