let burger = document.querySelector('.burger');
let menu = document.querySelector('.menu');
let brand = document.querySelector('.brand');
let search = document.querySelector('.search');
let item_container = document.querySelector('.search_item_container');
let data = [];

getUser();
checkWidth();

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
    checkWidth();
});


search.addEventListener('input', e => {
   
    item_container.innerHTML = '';
    data.forEach(item => {
        let ext = e.target.value.toLowerCase();
        if((item.commercial_name.toLowerCase().includes(ext)
         || item.firstname.toLowerCase().includes(ext)
         || item.lastname.toLowerCase().includes(ext))
          && ext != ''){
            let temp = document.createElement('div');
                temp.setAttribute('class', 'search_item');
                temp.textContent = item.commercial_name;
                temp.innerHTML = `
                    <div class="search_item_admin">
                    <p class="search_item_cm">${item.commercial_name}</p>
                    <p>${item.lastname} ${item.firstname}</p>
                    </div>
                    <div class="search_item_mail">
                        <p>${item.mail}</p>
                    </div>
                    <div class="search_item_btn_div">
                        <a href="/public/entity_page.php/?id=${item.id_user}"><button>modifier</button></a>
                        <a href="/public/activation_page.php/?id=${item.id_user}"><button>${item.is_active == 1 ? 'Désactiver' : 'Activer'}</button></a>
                        <a href="/public/delete_page.php/?id=${item.id_user}"><button>Supprimer</button></a>
                    </div>
                `
                item_container.appendChild(temp);
         }
    })
})

function checkWidth(){
    if(window.innerWidth < 430){
        brand.innerHTML = 'wB';
    }else {
        brand.innerHTML = 'WorkOUT Base';
    }
}

function fromMobilToNormal(){
    menu.classList.remove('mobil_menu');
    menu.classList.add('menu');
}
async function getUser(){
    
    let request  = await fetch('/script/script_ajax.php')
    let res = await request.json();
    // request
    //     .then(response => {
    //     //console.log(response);
    //     let temp = response.json();
    //     temp.then(item => {
    //         data = item;
    //     })
    //     })
    //     .catch(error => {
    //         console.log(error);
    //     });
    data = res;
    //console.log(res);
}


