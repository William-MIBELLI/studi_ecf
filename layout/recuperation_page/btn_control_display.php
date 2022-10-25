<?php
$text_btn_activation = 'Activer';
$class_btn = 'active_btn';
if($item->getIsActive()){
    $text_btn_activation = 'Désactiver';
    $class_btn = 'desactive_btn';
}
?>

<div class=<?= $type.'_buttons_div'?>>
    <a href=<?= "../public/entity_page.php/?id=".$item->getUserId() ?>><button class="<?= $type.'_btn modif_btn' ?>">Modifier</button></a>
    <a href=<?= "../public/activation_page.php/?id=".$item->getUserId()?>><button class="<?= $type.'_btn '.$class_btn ?>" ><?= $text_btn_activation ?></button></a>
    <a href=<?= "../public/delete_page.php/?id=".$item->getUserId() ?>><button class="<?= $type.'_btn delete_btn' ?>" >Supprimer</button></a>
</div>