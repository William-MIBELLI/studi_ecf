<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="title_container">
            <h1 class="title">Workout Base</h1>
            <h3>Your training place !</h3>
        </div>
        <main class="main_container">
            <form class="form_connection">
                <label for="username"></label>
                <input type="text" name="username" id="username" placeholder="Username">
                <label for="password"></label>
                <input type="text" name="password" id="password" placeholder="Password">
                <button type="button" onclick="window.location.href = './dashboard.php'">Connection</button>
            </form>
            <div class="sticker">Besoin d'aide ?</div>
        </main>
        <footer>
            <p>Buckito Corp 2022</p>
        </footer>
    </div>
</body>
</html>