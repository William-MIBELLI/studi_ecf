let partner_list = document.querySelector('#partner_list');
let radio_type = document.querySelectorAll('.radio_type');
let permission_list = document.querySelector('.permission_list');

displayDiv(radio_type);
radio_type.forEach(item => {
    item.addEventListener('change', (e) => {
        if(e.target.value === 'structure'){
            partner_list.style.display = 'block';
        }else{
            partner_list.style.display = 'none';
        }
        if(e.target.value === 'partner'){
            permission_list.style.display = 'grid';
        } else {
            permission_list.style.display = 'none';
        }
    })
})

function displayDiv(radios){
    for(input of radios){
        if(input.value == 'admin' && input.checked){
            permission_list.style.display = 'none';
            partner_list.style.display = 'none';
        }else if (input.value == 'structure' && input.checked){
            permission_list.style.display = 'grid';
            partner_list.style.display = 'none';
        }else if (input.value == 'partner' && input.checked){
            permission_list.style.display = 'none';
            partner_list.style.display = 'block';
        }
    }
}

let login_sticker = document.querySelector('#sticker_login');

login_sticker.addEventListener('click', (e) => {
    alert('click sur le sticker OK');
});