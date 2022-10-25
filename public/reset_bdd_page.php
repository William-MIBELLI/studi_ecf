<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style_dash.css">
    <title>Reset BDD</title>
</head>
<body>
    <?php
    session_start();
    if($_SESSION['role_id'] !== 1){
        echo 'Vous n\'avez pas les autorisation nécessaires pour accéder à cette page';
        die();
    }
    require_once "../script/reset_bdd.php";
    include_once "../script/bdd_functions.php";
    ?>
     <div class="reset_container">
         <h1>Remise à zéro éffectuée avec succés !</h1>
         <a href="/index.php">Cliquer ici pour revenir à la page d'identification</a>
     </div> 
</body>
</html>
