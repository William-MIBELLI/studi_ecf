<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style_dash.css">
    <title>Liste des entités</title>
</head>
<body>
    <?php
    session_start();
    include_once "../templates/header.html"; 
    include_once "../script/bdd_functions.php";
    spl_autoload_register(function($class) {
        //echo 'on call lautoloader';
        require_once('../models/'.$class.'.php');
    });
    if($_SESSION['role_id'] !== 1){
        $msg = 'Vous n\'avez pas les autorisation nécessaires pour accéder à cette page';
        require_once "../templates/forbidden.php";
        die();
    }
    ?>
    <main class="main_recup">
        <div class="main_recup_title">
            <h2>Gestion des partenaires et structures</h2>
        </div>
        <?php 
        include_once "../models/Partner.php";
        include_once "../models/Permission.php";
        //echo get_include_path();
        $entity = [];
        $structures = [];
        $permissions = [];
        try{
            $pdo = new PDO('mysql:host=localhost;dbname=ecf_database', 'root');
            $statement = $pdo->prepare('SELECT * FROM partner JOIN user ON partner.user_id = user.id_user');
            $permissions = getAllPermissions($pdo);
            if($statement->execute()){
                while($user = $statement->fetch(PDO::FETCH_ASSOC)){
                    $partner = new Partner(...$user);
                    $list = $partner->getStructuresList();
                    foreach($list as $structure){
                        $entity[] = $structure;
                    }
                    $entity[] = $partner;
                    require "../layout/recuperation_page/display_partner.php";
                }
            }
                      
        } catch(PDOException $e){
            echo $e->getMessage();
        }
        $_SESSION['entity'] = $entity;
        $_SESSION['permissions'] = $permissions;

        ?>
    </main>
    <?php include_once "../templates/footer.html" ?>
    <script src="../js/display_entity.js"></script>
 </body>
</html>