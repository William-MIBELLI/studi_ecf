<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style_dash.css">
    <link rel="stylesheet" href="../css/style_request.css">
    <title>Demandes en attente</title>
</head>
<body>
    <?php 
    session_start();
    require_once "../templates/header.php";
    require_once "../script/bdd_functions.php"; 
    ?>
    <main class="main_container_request">
        <h1>Demandes en attente</h1>
        <?php
        $demandes = getRequests();
        if(count($demandes) == 0){
            echo 'Aucune demande en attente';
        }
        foreach($demandes as $request){
            require "../layout/request/display_request.php";
        }
        ?>
    </main>
    <?php require_once "../templates/footer.php" ?>
</body>
</html>