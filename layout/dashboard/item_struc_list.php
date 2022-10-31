
<div class="struc_div">
    <div class="struc_div_header">
        <h1><?=  $structure->getCommercialName()?></h1>
    </div>
    <div class="struc_div_body">
        <div class="struc_body_logo">
            <img src="https://images.unsplash.com/photo-1518611012118-696072aa579a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" alt="" class="logo_dash">
        </div>
        <div class="struc_body_info">
            <p><?= $structure->getFullName() ?></p>
            <p><?= $structure->getAddress() ?></p>
            <p><?= $structure->getPostalCode() ?></p>
            <p><?= $structure->getCity() ?></p>
            <a href="tel:+<?= $structure->getPhoneForLink() ?>"><?= $structure->getPhone() ?></a>
            <a href="mailto:<?= $structure->getMail() ?>"><?= $structure->getMail() ?></a>
        </div>
    </div>
    <div class="struc_div_footer">
        <p>Permissions : <?= count($structure->getPermissionsList()) ?>/<?= count($item->getPermissionsList())?></p>
        <?php
        if($structure->getIsActive()){
            ?>
            <div class="struc_active">
                <p>Statut : actif</p>
                <img src="../../ressources/icones/check.png" alt="" class="active_logo">
            </div>
            <?php
        } else {
            ?>
            <div class="struc_active">
                <p>Statut : Désactivé</p>
                <img src="../../ressources/icones/cancel.png" alt="" class="active_logo">
            </div>
            <?php
        }
        ?>
    </div>
</div>