function showSidebar(item, type) {
    $(".container_home").removeClass('container_home_open');
    $('main').removeClass('main_open');
    $("#aside_right").removeClass('aside_right_visible');

    $(".ar_header span").click(() => {
        $(".container_home").removeClass('container_home_open');
        $('main').removeClass('main_open');
        $("#aside_right").removeClass('aside_right_visible');
        $('#aside_right').hide();
    })

    $(document).keyup(function (e) {
        if (e.key === 'Escape') {
            $(".container_home").removeClass('container_home_open');
            $('main').removeClass('main_open');
            $("#aside_right").removeClass('aside_right_visible');
            $('#aside_right').hide();
        }
    });

    switch (type) {
        case 'article':
            sidebarArticle(item);
            break;
        case 'user':
            sidebarUser(item);
            break;
        case 'material':
            sidebarMaterial(item);
            break;
        case 'form':
            sidebarCreacioMaterials(item);
            break;

        default:
            break;
    }

    $('#aside_right').show();
    $("#aside_right").toggleClass('aside_right_visible');
    $(".container_home").toggleClass('container_home_open');
    $('main').toggleClass('main_open');
}

function sidebarArticle(article) {
    $("#ar_title").html(article.titol);
    $("#ar_img").attr('src', 'img/articles/' + article.image);
    $("#ar_description").html(article.cos);
    $('.ar_user').html(article.user_name);

    $("#ar_edit").attr('href', `editar_article/${article.id}`);
    document.getElementById("ar_delete").addEventListener(
        "click",
        function () {
            openDeleteModal(`eliminar_article/${article.id}`, 'article')
        });

    document.getElementById("ar_clone").addEventListener(
        "click",
        function () {
            openCloneModal(article.id);
        });
}

function sidebarUser(user) {
    $("#ar_title").html(user.user);
    $("#ar_img").src = 'img/users/' + user.image;
    $(".ar_email").html(user.email);
    $("#ar_nom").html(user.name);

    document.getElementById("ar_edit").href = `profile/${user.id}`;
    document.getElementById("ar_delete").addEventListener(
        "click",
        function () {
            openDeleteModal(`profile?isDelete=true&id=${user.id}`, 'usuari')
        });
}

function sidebarMaterial() {

    $("#ar_title").html('Belladona');
    $("#ar_img").src = 'img/gui/none.webp';
    $("#ar_description").html("La belladona o tabac bord (Atropa belladonna) és una planta perenne de la família de les solanàcies. L'ús de belladona implica un risc de toxicitat elevat. Els alcaloides que conté tenen un gran efecte a petites concentracions. Entre la dosi terapèutica (dosi que es requereix per produir l'efecte esperat) i la dosi tòxica no hi ha molta diferència.");

}

function sidebarCreacioMaterials(tipus) {

    $("#ar_title").html(tipus);

    var vegetals = ['Belladona', 'Lavanda', 'Pasiflora', 'Heura verinosa', 'Iris', 'Amapola', 'Tora blava'];
    var animals = ['Ploma de faisà daurat', 'Sang d-Ocell del paradís superb', 'Pel de guineu'];
    var minerals = ['Quars rosa', 'Ull de tigre', 'Amatista'];

    var inputsVegetal = vegetals.map(v =>
        `<label class="form-label checkbox">
                    <input type="checkbox" name="recorda" form='article_form'>
                    <span class="checkbox-container"></span>
                    ${v}
                </label>`);

    var inputsAnimal = animals.map(a =>
        `<label class="form-label checkbox">
                    <input type="checkbox" name="recorda" form='article_form'>
                    <span class="checkbox-container"></span>
                    ${a}
                </label>`);

    var inputsMinerals = minerals.map(m =>
        `<label class="form-label checkbox">
                    <input type="checkbox" name="recorda" form='article_form'>
                    <span class="checkbox-container"></span>
                    ${m}
                </label>`);

    switch (tipus) {
        case 'vegetals':
            $(".ar_body").html(inputsVegetal.join(''));
            break;
        case 'animals':
            $(".ar_body").html(inputsAnimal.join(''));
            break;
        case 'minerals':
            $(".ar_body").html(inputsMinerals.join(''));
            break;
        default:
            break;
    }

}
