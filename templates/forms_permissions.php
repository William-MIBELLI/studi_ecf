<fieldset class="perms_input_div permission_list">
    <legend>Liste des permissions disponibles</legend>
    <?php
    foreach($list_permissions as $perm){

        $checked = false;
        if(isset($entity)){
            $checked = in_array($perm, $entity->getPermissionsList());
        }
        if(!$checked){
            echo '<input type="checkbox" name="perm[]" value="'.strval($perm->getId()).'">';
        }else{
            echo '<input type="checkbox" name="perm[]" value="'.strval($perm->getId()).'" checked>';
        }
        echo '<label for="perm[]">'.$perm->getName().'</label>';
    }
    ?>
</fieldset>