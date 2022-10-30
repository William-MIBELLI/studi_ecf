<main>
        <div class="container">

            <div class="title">
                Bienvenue sur l'espace d'administration 
            </div>

            <div class="card">
                <div class="card-header">
                    <h3>Création d'un adhérent</h3>
                </div>
                <div class="card-body">
                    <p>Créer un nouveau partenaire ou une nouvelle structure dans la base de donnée</p>
                    <img src="../ressources/icones/add.png" alt="icon add" class="icon-card" id="add-icon">
                </div>
                <div class="card-footer">
                    <p><a href="/public/creation_page.php">Accéder</a></p>
                    <img src="../ressources/icones/arrow.png" alt="" class="arrow-icon">
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3>Gestion des adhérents</h3>
                </div>
                <div class="card-body">
                    <p>Accédez aux différents partenaires et structures de la marque, et gérez leurs permissions, informations ...</p>
                    <img src="../ressources/icones/gestion.png" alt="gestion icon" class="icon-card" id="gestion-icon">
                </div>
                <div class="card-footer">
                    <p><a href="/public/recup.php">Accéder</a></p>
                    <img src="../ressources/icones/arrow.png" alt="" class="arrow-icon">
                </div>   
            </div>

            <div class="card">
                <div class="card-header">
                    <h3>Demandes en attente</h3>
                </div>
                <div class="card-body">
                    <p>Retrouvez dans cet espace les demandes envoyées par les adhérents </br><span class="span_request">Actuellement en attente : <?= count($demandes) ?></span></p>
                    <img src="../ressources/icones/airplane.png" alt="" class="icon-card" id="demand-icon">
                </div>
                <div class="card-footer">
                    <p><a href="/public/demande_page.php">Accéder</a></p>
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

            <a href="/public/reset_bdd_page.php" id="reset_link" onclick="javascript: return confirm('Attention, la remise à zéro est irréversible, continuer ?')">
                <div class="sticker">
                    Remise à zéro
                </div>
            </a>
        </div>
    </main>