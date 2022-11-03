<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style_dash.css">
    <link rel="shortcut icon" href="../ressources/icones/favicon.png" type="image/x-icon">
    <title>WorkOUT</title>
</head>
<body>
    <?php
    include_once "../templates/header.php";
    require_once "../script/bdd_functions.php";
    spl_autoload_register(function($class) {
        require_once('../models/'.$class.'.php');
    });
    session_start();
    $user = $_SESSION['auth'];
    $content = $_POST['content_request'];
    if(createRequest($user->getUserId(), $content)){
        $msg = 'Votre demande a bien été envoyée, celle-ci sera traitée dans les meilleurs délais';
        require_once "../templates/success.php";
    }else{
        $msg = 'Impossible d\'envoyer la demande';
        require_once "../templates/fail.php";
    }
    ?>
</body>
</html>