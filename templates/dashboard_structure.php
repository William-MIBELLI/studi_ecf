<main class="item_main">
    <?php
    $user = $_SESSION['auth'];
    $item = getStructure($user->getUserId());
    // echo '<pre>';
    // print_r($item);
    // echo '<pre>';
    require "../layout/dashboard/item_admin_info.php";
    require "../layout/dashboard/item_perms_list.php";
    ?>
</main>