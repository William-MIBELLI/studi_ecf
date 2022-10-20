<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style_dash.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Oswald:wght@200;300;400&family=Permanent+Marker&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body class="body">
    <?php  include '../templates/header.html'?>
    <main>
        <div class="container">
            <div class="title">
                Bienvenue sur l'espace d'administration 
            </div>
            <div class="card">
                <div class="card-header">
                    <h3>Création d'un partenaire</h3>
                </div>
                <div class="card-body">
                    <p>Une petite description de l'utilité de ce module, manière de remplir un peu l'espace...</p>
                    <img src="../ressources/icones/add.png" alt="icon add" class="icon-card" id="add-icon">
                </div>
                <div class="card-footer">
                    <p><a href="./creation_page.php">Accéder</a></p>
                    <img src="../ressources/icones/arrow.png" alt="" class="arrow-icon">
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3>Gestion des droits</h3>
                </div>
                <div class="card-body">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem, quasi? Fugit </p>
                    <img src="../ressources/icones/gestion.png" alt="gestion icon" class="icon-card" id="gestion-icon">
                </div>
                <div class="card-footer">
                    <p><a href="./recup.php">Accéder</a></p>
                    <img src="../ressources/icones/arrow.png" alt="" class="arrow-icon">
                </div>   
            </div>
            <div class="card">
                <div class="card-header">
                    <h3>Demandes en attente</h3>
                </div>
                <div class="card-body">
                    <p>Ici seront regroupées les demandes en attentes des partenaire vis à vis des droits</p>
                    <img src="../ressources/icones/airplane.png" alt="" class="icon-card" id="demand-icon">
                </div>
                <div class="card-footer">
                    <p>Accéder</p>
                    <img src="../ressources/icones/arrow.png" alt="" class="arrow-icon">
                </div>   
            </div>
            <div class="card">
                <div class="card-header">
                    <h3>Statistiques</h3>
                </div>
                <div class="card-body">
                    <p>Regroupement du nombre de partenaires, de structures, d'admin, nombre de connection, de modifs...</p>
                    <img src="../ressources/icones/stats.png" alt="" class="icon-card" id="stat-icon">
                </div>
                <div class="card-footer">
                    <p><a href="#">Page de test</a></p>
                    <img src="../ressources/icones/arrow.png" alt="" class="arrow-icon">
                </div> 
            </div>
        </div>
    </main>
    <a href="./reset_bdd_page.php" id="reset_link" onclick="javascript: return confirm('Attention, la remise à zéro est irréversible, continuer ?')">
        <div class="sticker">
            Remise à zéro
        </div>
    </a>
    <?php include '../templates/footer.html'?>
    <script src="main.js"></script>
</body>
</html>