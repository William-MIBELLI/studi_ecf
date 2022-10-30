<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style_dash.css">
    <title>Confirmation création</title>
</head>
<body>
    <?php
    session_start();
    require_once "../templates/header.php";
    if($_SESSION['role_id'] !== 1){
        $msg =  'Vous n\'avez pas les autorisation nécessaires pour accéder à cette page';
        require_once "../templates/forbidden.php";
        die();
    }
    require_once "../script/script_creation.php";
    require_once "../templates/footer.php";
    ?>
</body>
</html>