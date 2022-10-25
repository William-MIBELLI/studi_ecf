<?php
$all_perms = getAllPermissions();
$item_perms = $item->getPermissionsList();
?>

<div class="perms_list_container">
    <div class="item_list_header">
        <h1>Liste des permissions</h1>
    </div>
    <div class="item_list_body">
        <?php
        foreach($all_perms as $perm){
            if(in_array($perm,$item_perms)){
                ?>
                <div class="perm_div">
                    <img src="../../ressources/icones/check.png" alt="" class="active_logo">
                    <p><?= $perm->getName() ?></p>
                </div>
                <?php
            }else{
                ?>
                <div class="perm_div">
                    <img src="../../ressources/icones/cancel.png" alt="" class="active_logo">
                    <p><?= $perm->getName() ?></p>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>