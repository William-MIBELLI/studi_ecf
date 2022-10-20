<div class="partner_body" id="partner_body_list">
    <?php
    //$_SESSION['entity'] = $partner;
    $permissionsList = $partner->getPermissionsList();
    foreach($permissions as $perm){
        ?>
        <div class="permissions_detail">
            <?php
            if(in_array($perm, $permissionsList)){
                ?><img src="../ressources/icones/check.png" alt="" class="partner_icon perm_icon"><?php
            }else{
                ?><img src="../ressources/icones/cancel.svg" alt="" class="partner_icon perm_icon"><?php
            }
            ?>
            <p title="test de bulle"><?= $perm->getName() ?></p>
        </div>
        <?php
    }
    ?>
</div>