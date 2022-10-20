<div class=<?= $type.'_buttons_div'?>>
    <a href=<?= "../public/entity_page.php/?id=".$item->getUserId() ?>><button class="<?= $type.'_btn modif_btn' ?>">Modifier</button></a>
    <a href=<?= "../public/activation_page.php/?id=".$item->getUserId()?>><button class="<?= $type.'_btn desactive_btn' ?>" >Désactiver</button></a>
    <a href=<?= "../public/delete_page.php/?id=".$item->getUserId() ?>><button class="<?= $type.'_btn delete_btn' ?>" >Supprimer</button></a>
</div>