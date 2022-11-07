<main class="item_main">
    <div class="item_main_header">
        <p>Bienvenue dans votre espace membre</p>
    </div>
    <?php
     $user = $_SESSION['auth'];
     $item = getPartner($user->getUserId());
     require "../layout/dashboard/item_admin_info.php";
     require "../layout/dashboard/item_perms_list.php";
     ?>
    <div class="struc_list">
        <div class="struc_list_header">
            <?php
            if(count($item->getStructuresList()) == 0){
                ?>
                <h1>Aucunes structures affiliées</h1>
                <?php
            } else {
                ?>
                <h1>Liste des Structure affiliées</h1>
                <?php
            }
            ?>
        </div>
        <div class="struc_list_body">
            <?php
            foreach($item->getStructuresList() as $structure){
                require "../layout/dashboard/item_struc_list.php";
            }
            ?>
        </div>
    </div>
</main>