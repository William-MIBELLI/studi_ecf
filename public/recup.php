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
    include_once "../templates/header.html"; ?>
    <main class="main_recup">
        <div class="main_recup_title">
            <h2>Gestion des partenaires et structures</h2>
        </div>
        <?php 
        include_once "../models/Partner.php";
        include_once "../models/Permission.php";
        echo get_include_path();
        $entity = [];
        $structures = [];
        $permissions = [];
        try{
            $pdo = new PDO('mysql:host=localhost;dbname=ecf_database', 'root');
            $statement = $pdo->prepare('SELECT * FROM partner JOIN user ON partner.user_id = user.id_user');
            $stmt_perms = $pdo->prepare('SELECT * FROM permission');
            if($stmt_perms->execute()){
                while($temp = $stmt_perms->fetch(PDO::FETCH_ASSOC)){
                    $permissions[] = new Permission(...$temp);
                }
            }
            if($statement->execute()){
                while($user = $statement->fetch(PDO::FETCH_ASSOC)){
                    $partner = new Partner(...$user);
                    $partner->getPermissionsFromDb();
                    $partner->getStructureFromDb();
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
    <!-- <?php include_once "./footer.html" ?> -->
    <script src="../js/display_entity.js"></script>
 </body>
</html>