<div class="request_container_details">
    <div class="request_creator">
        <?= $request['commercial_name'] ?>
    </div>
    <div class="request_content_div">
        <?= $request['content'] ?>
    </div>
    <div class="request_btn">
        <a href="../../public/treatment_demand_page.php/?id=<?= $request['id_request']?>&statut=true&mail=<?= $request['mail'] ?>"><button class="btn_request btn_request_accept">Accepter</button></a>
        <a href="../../public/treatment_demand_page.php/?id=<?= $request['id_request']?>&statut=false&mail=<?= $request['mail'] ?>"><button class="btn_request btn_request_decline">Refuser</button></a>
    </div>
</div>