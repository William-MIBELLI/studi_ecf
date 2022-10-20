let btn = document.querySelectorAll('.btn');
let struc_div = document.querySelectorAll('.structure_info');

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