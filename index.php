<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style_index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
    <title>WorkOUT Base</title>
</head>
<body>

    <?php
     session_start(); 
     if(isset($_POST['mode'])){
        if($_POST['mode'] == 'online'){
            $_SESSION['mode'] = 'online';
        }else{
            $_SESSION['mode'] = 'locale';
        }
    }
     ?>
    
    <div class="container">
        <div class="title_container">
            <h1 class="title">Workout Base</h1>
            <h3>Your training place !</h3>
        </div>
        <main class="main_container">
            <form action="script/connection.php" method="POST" class="form_connection">
                <label for="username"></label>
                <input class="input_connection" type="text" name="username" id="username" placeholder="Username" required>
                <label for="password"></label>
                <input class="input_connection" type="password" name="password" id="password" placeholder="Password" required>
                <button type="submit" id="connection_btn">Connexion</button>
            </form>
            <?php
            if(isset($_SESSION['alert_user'])){
                require_once "./templates/login_alert.php";
                $_SESSION['alert_user'] = null;
            }
            ?>
            <div class="sticker" id="sticker_login">
                <p id="p_config">Configuration</p>
                <form method="POST" id="config_form">
                    <h4>Mode de fonctionnement</h4>
                    <div class="config_radio_container">
                        <label for="local_radio">Mode local</label>
                        <input type="radio" name="mode" id="local_radio" class="config_radio" value="locale" checked>
                        <label for="online_radio">Mode online</label>
                        <input type="radio" name="mode" id="online_radio" class="config_radio" value="online">
                    </div>
                    <div class="config_btn_div">
                        <button type="submit" id="config_btn">Valider</button>
                        <a href="/script/reset_bdd.php">
                            <button id="config_btn">Réinitialisation</button>
                        </a>
                    </div>
                </form>
            </div>
        </main>
        <?php require_once "./templates/footer.php" ; ?>
    </div>
    <script src="/js/main.js"></script>
</body>
</html>
