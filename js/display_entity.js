let btn = document.querySelectorAll('.btn');
let struc_div = document.querySelectorAll('.structure_info');
let display_choice = document.getElementById('display_select');
let div_partner_active = document.querySelectorAll('.partner_container');
let div_partner_inactive = document.querySelectorAll('.partner_container_inactive');

console.log('structure : ',struc_div);
btn.forEach(item => {
    item.addEventListener('click', (e) => {
        alert('click sur ' + e);
    })
})
let btn_struc = document.querySelectorAll('.button_structure');

btn_struc.forEach((item,key) => {
    item.addEventListener('click', (e) => {
        if(struc_div[key].style.display == 'block'){
            struc_div[key].style.display = 'none';
            item.style.transform = 'rotate(90deg)';
        }else{
            struc_div[key].style.display = 'block';
            item.style.transform = 'rotate(-90deg)';
        }
        
    })
})

display_choice.addEventListener('change', (e) => {
    switch(e.target.value){
        case "all":
            div_partner_inactive.forEach(item => item.style.display = 'flex');
            div_partner_active.forEach(item => item.style.display = 'flex');
            break;
        case "active":
            div_partner_inactive.forEach(item => item.style.display = 'none');
            div_partner_active.forEach(item => item.style.display = 'flex');
            break;
        case "inactive":
            div_partner_inactive.forEach(item => item.style.display = 'flex');
            div_partner_active.forEach(item => item.style.display = 'none');
            break;
        default:
            return null;
    }
})