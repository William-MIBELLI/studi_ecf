<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style_dash.css">
    <link rel="stylesheet" href="../css/style_request.css">
    <link rel="shortcut icon" href="../ressources/icones/favicon.png" type="image/x-icon">
    <title>Nouvelle demande</title>
</head>
<body>
    <?php
    require_once "../templates/header.php";
    ?>
    <main class="main_container" id="request_container">
        <h1>Envoyer une nouvelle demande</h1>
        <form action="./demand_confirm_page.php" method="post" id="request_form">
            <textarea name="content_request" id="content_request" cols="30" rows="10" required placeholder="Votre demande..."></textarea>
            <button type="submit">Envoyer</button>
        </form>
    </main>
</body>
</html>