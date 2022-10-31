<?php include_once "../models/Partner.php";?>
<div 
    <?php
    if($partner->getIsActive()){
        echo 'class="partner_container"';
    }else{
        echo 'class="partner_container_inactive"';
    }
    ?>
    >
    <div class="display_partner">
        <div class="partner_logo">
            <img src="https://images.unsplash.com/photo-1599058917212-d750089bc07e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1169&q=80" alt="">
        </div>
        <div class="partner_content">
            <div class="partner_info">
                <?php
                require "partner_header.php";
                require "partner_body.php";
                ?>
            </div>
            <div class="partner_permissions_list">
                <div class="partner_header">
                    <h2>Liste des permissions</h2>
                </div>
                <?php
                require "partner_permissions_list.php";
                ?>
            </div>
        </div>
            <?php 
            $item = $partner;
            $type = strtolower(get_class($item));
            require "btn_control_display.php";
            ?>
    </div>
    <div class="display_structure">
        <div class="struc_header">
            <p>Structure (<?= $partner->getStructureListLength()?>)</p>
            <img src="../ressources/icones/arrow.png" alt="arrow_button" class="button_structure on_bot">
        </div>
        <div class="structure_info">
            <?php 
            foreach($partner->getStructuresList() as $structure){
                $_SESSION['entity'][] = $structure;
                ?>
                <div class="structure_detail">
                    <div class="structure_info_admin">
                        <p class="struc_cm"><?= $structure->getCommercialName()?></p>
                        <p><?= $structure->getFullName() ?></p>
                        <div class="struc_address">
                            <p><?= $structure->getAddress() ?></p>
                            <p><?= $structure->getPostalCode().' '.$structure->getCity() ?></p>
                        </div>
                    </div>
                    <div class="structure_contact_div">
                        <p><?= $structure->getPhone() ?></p>
                        <p><?= $structure->getMail() ?></p>
                    </div>
                    <div class="structure_activity">
                        <div class="struc_act_detail">
                            <p>En activité : </p>
                            <?php
                            if($structure->getIsActive()){
                            ?> <img src="../ressources/icones/check.png" alt="" class="activity_icon"><?php
                            }
                            else{
                            ?><img src="../ressources/icones/cancel.png" alt="" class="activity_icon"><?php
                            }
                            ?>
                        </div>
                        <p>Permissions actives :</p>
                    </div>
                    <div class="structure_button_div">
                        <?php 
                        $item = $structure;
                        $type = strtolower(get_class($item));
                        require "btn_control_display.php";
                        ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<!-- <script src="../display_entity.js"></script> -->