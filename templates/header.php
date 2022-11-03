<header>
    <a href="/public/dashboard.php"><p class="brand">Workout Base</p class="brand"></a>
    <?php
    if($_SESSION['role_id'] == 1){
        ?>
        <input type="text" placeholder="Rechercher..." class="search">
        <nav class="menu">
            <a href="/public/creation_page.php">Création</a>
            <a href="/public/recup.php">Gestion</a>
            <a href="/public/demande_page.php">Demande</a>
            <a href="/index.php">Déconnexion</a>
            </nav>
        <?php
    } else {
        ?>
        <nav class="menu">
            <a href="/public/new_demande_page.php">Faire une demande</a>
            <a href="/index.php">Déconnexion</a>
        </nav>
        <?php
    }?>
    <div class="burger">
        <img src="../../ressources/icones/burger.png" alt="" class="burger_icon">
    </div>
</header>
<div class="search_item_container">
    <!-- <div class="search_item_admin">
        <p>nom_commercial</p>
        <p>nom prénom</p>
    </div>
    <div class="search_item_mail">
        <p>mail</p>
    </div>
    <div class="search_item_btn_div">
        <a href=""><button>modifier</button></a>
        <a href=""><button>desactiver</button></a>
        <a href=""><button>modifier</button></a>
    </div> -->
</div>
<script src="../../js/header.js"></script>