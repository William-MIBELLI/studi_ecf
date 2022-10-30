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
let config_form = document.querySelector('#config_form');
let p_config = document.getElementById('p_config');
let config_radio = document.querySelectorAll('.config_radio');

// config_radio.forEach(item => {
//     item.addEventListener('change', (event) => {
//         console.log(event);
//         event.stopPropagation();
//     })
// })

config_form.addEventListener('click', (e) => {
    e.stopPropagation();
})

login_sticker.addEventListener('click', (e) => {
    if(config_form.style.display == 'flex'){
        config_form.style.display = 'none';
        p_config.style.display = 'block';
    } else {
        config_form.style.display = 'flex';
        //config_form.style.width = 'auto';
        p_config.style.display = 'none';
    }
    e.stopPropagation();
});