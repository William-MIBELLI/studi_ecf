<div class="item_admin_container">
    <div class="item_logo">
        <img src="https://images.unsplash.com/photo-1461896836934-ffe607ba8211?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" alt="" class="logo_dash">
    </div>
    <div class="item_admin">
        <div class="item_admin_header">
            <h1><?= $item->getCommercialName()?></h1>
        </div>
        <div class="item_admin_body">
            <div class="item_admin_body_info">
                <h4><?= $item->getFullName() ?></h4>
                <div class="item_admin_address">
                    <p><?= $item->getAddress() ?></p>
                    <p><?= $item->getPostalCode() ?></p>
                    <p><?= $item->getCity() ?></p>
                </div>
                <div class="item_body_info_footer">
                    <a href="tel:+<?= $item->getPhoneForLink() ?>"><?= $item->getPhone() ?></a>
                    <a href="mailto:<?= $item->getMail() ?>"><?= $item->getMail() ?></a>
                </div>
            </div>
            <div class="item_admin_body_isactive">
                <h4>Votre statut</h4>
                <?php
                if($item->getIsActive()){
                    ?>
                    <div class="active_statut">
                        <p>Actif</p>
                        <img src="../../ressources/icones/check.png" alt="statut_logo" class="active_logo">
                    </div>
                    <?php
                }else{
                    ?>
                    <div class="active_statut">
                        <p>Désactivé</p>
                        <img src="../../ressources/icones/cancel.png" alt="statut_logo" class="active_logo">
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>