<div class="partner_header">
    <h2>
        <?php echo $partner->getCommercialName(); ?>
    </h2>
    <?php
    if($partner->getIsActive()){
        ?><img src="../ressources/icones/check.png" alt="" class="partner_icon"><?php
    }else{
        ?><img src="../ressources/icones/cancel.svg" alt="" class="partner_icon"><?php
    }
    ?>
</div>