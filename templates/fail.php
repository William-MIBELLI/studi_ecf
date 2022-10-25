<main class="request_end">
    <h1>Echec de la requête</h1>
    <p><?= $msg ?></p>
    <?php
    if($index != null){
        ?>
        <a href="/index.php">Cliquer ici pour revenir à la page de connection</a>
        <?php
    }else {
        ?>
        <a href="/public/dashboard.php">Cliquer ici pour revenir au dashboard</a>
        <?php
    }
    ?>
</main>