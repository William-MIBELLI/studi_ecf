<?php
$tab = [];
if(isset($entity)){
    $tab['cm'] = $entity->getCommercialName();
    $tab['fn'] = $entity->getFirstname();
    $tab['ln'] = $entity->getLastname();
    $tab['address'] = $entity->getAddress();
    $tab['pc'] = $entity->getPostalCode();
    $tab['city'] = $entity->getCity();
    $tab['phone'] = $entity->getPhone();
    $tab['mail'] = $entity->getMail();
    $tab['pass'] = $entity->getPassword();
}else{
}
?>
<fieldset class="input_admin_div">
    <legend>Informations administrative</legend>
    <label for="commercial_name">Dénomination commerciale</label>
    <input type="text" name="commercial_name" value="<?= $tab['cm']?>" required>
    <label for="firstname">Prénom</label>
    <input type="text" name="firstname" value="<?= $tab['fn']?>" required>
    <label for="lastname">Nom</label>
    <input type="text" name="lastname" value="<?= $tab['ln']?>" required>
    <label for="address">Adresse</label>
    <input type="text" name="address" value="<?= $tab['address']?>" required>
    <label for="postal_code">Code postal</label>
    <input type="number" name="postal_code" value ="<?= $tab['pc']?>" required>
    <label for="city">Ville</label>
    <input type="text" name="city" value ="<?= $tab['city']?>" required>
    <label for="phone">Téléphone</label>
    <input type="number" name="phone" value="<?= $tab['phone']?>" required>
</fieldset>
<fieldset class="input_admin_div">
    <legend>Informations de connection</legend>
    <label for="mail">Mail</label>
    <input type="email" name="mail" value="<?= $tab['mail']?>" required>
    <?php
    if(!isset($update) || !$update){
        ?>
        <label for="password">Mot de passe (8 caractères mini)</label>
        <input type="password" name="password" required>
        <label for="confirm_password">Confirmation du mot de passe</label>
        <input type="password" name="confirm_password" required >
        <?php
    }?>
</fieldset>

