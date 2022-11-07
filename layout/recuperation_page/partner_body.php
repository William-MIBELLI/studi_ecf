<div class="partner_body">
    <h3><?= $partner->getLastName().' '.$partner->getFirstName()?></h3>
    <div class="info" id="address_info">
        <div class="info_adress">
            <p><?= $partner->getAddress() ?></p>
            <p><?= $partner->getPostalCode().' '.$partner->getCity()?></p>
        </div>
    </div>
    <div class="phone_info info">
        <img src="../ressources/icones/phone.png" alt="phone_icon" class="partner_icon">
        <p><?= $partner->getPhone() ?></p>
    </div>
    <div class="mail_info info">
        <img src="../ressources/icones/mail.png" alt="mail_icon" class="partner_icon">
        <p><?= $partner->getMail()?></p>
    </div>
</div>