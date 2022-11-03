<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style_dash.css">
    <link rel="shortcut icon" href="../ressources/icones/favicon.png" type="image/x-icon">
    <title>WorkOUT BASE</title>
</head>
<body>
    <div class="reset_container">
        <h1>Première connection</h1>
        <p>Par mesure de sécurité, vous devez réinitialiser votre mot de passe.</p>
        <form action="/script/first_connection.php" method="post" id="reset_pass_form">
            <label for="old_pass">Mot de passe actuel</label>
            <input type="password" name="old_pass" id="old_pass">
            <label for="new_pass" >Nouveau mot de passe</label>
            <input type="password" name="new_pass" id="">
            <label for="confirm_pass">Confirmer</label>
            <input type="password" name="confirm_pass" id="">
            <button type="submit">Valider</button>
        </form>
    </div>
</body>
</html>