<?php
$mode = null;
if(session_status() != PHP_SESSION_ACTIVE){
    session_start();
}
if($_SESSION['mode'] == 'online'){
    $mode = 'Online';
}else{
    $mode = 'Local';
    $_SESSION['mode'] = 'locale';
}
?>
<footer>
    <p>WorkOUT BASE 2022, Tous droits réservés</p>
    <div class="footer_mode_display">Le site est actuellement configuré en mode : <strong><?= $mode ?></strong> </div>
</footer>