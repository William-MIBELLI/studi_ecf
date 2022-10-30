let burger = document.querySelector('.burger');
let menu = document.querySelector('.menu');

function fromMobilToNormal(){
    menu.classList.remove('mobil_menu');
    menu.classList.add('menu');
}

burger.addEventListener('click', e => {
    console.log(menu.classList);
    if(menu.classList == 'mobil_menu'){
        fromMobilToNormal();
    }else{
        menu.classList.remove('menu');
        menu.classList.add('mobil_menu');
    }
})


window.addEventListener('resize', () => {
    if(window.innerWidth > 750){
        if(menu.classList == 'mobil_menu'){
            fromMobilToNormal();
        }
    }
});