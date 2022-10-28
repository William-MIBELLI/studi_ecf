<header>
    <a href="/public/dashboard.php"><h1>Workout Base</h1></a>
    <?php
    if($_SESSION['role_id'] == 1){
        ?>
        <input type="text" placeholder="Rechercher..." class="search">
        <nav class="menu">
            <a href="/public/creation_page.php">Création</a>
            <a href="/public/recup.php">Gestion</a>
            <a href="/public/demande_page.php">Demande</a>
            <a href="/index.php">Déconnection</a>
            </nav>
        <?php
    } else {
        ?>
        <nav class="menu">
            <a href="/public/new_demande_page.php">Faire une demande</a>
            <a href="/index.php">Déconnection</a>
        </nav>
        <?php
    }?>
</header>