<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style_dash.css">
    <title>Page de suppression</title>
</head>
<body>
    <?php
    include_once "../templates/header.html";
    ?>
    <h2>page de suppression</h2>
    <?php
    require "../script/delete_entity.php";
    ?>
</body>
</html>