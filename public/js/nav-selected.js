let items = document.querySelectorAll('.nav-item');

let current_url = window.location.href;
let routes = [{
    ruta: 'login',
    nav: 'login'
},
{
    ruta: 'myArticles',
    nav: 'myArticles',
    group: '.pocions_items'
},
{
    ruta: 'form',
    nav: 'newArticle',
    group: '.pocions_items'
},
{
    ruta: 'home',
    nav: 'home',
    group: '.pocions_items'
}];

for (r of routes) {
    if ((current_url).includes(r.ruta)) {
       
        let nav_item = document.getElementById(r.nav);
        nav_item.classList.add('nav-selected');
        if (r.group != null) {
            let grup = document.querySelector(r.group);
            console.log(grup);
            grup.classList.add('visible');
        }
        
        break;
    }
}
