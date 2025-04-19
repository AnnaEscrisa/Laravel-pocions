let filter = $('#filterButton');
let order = $('#orderButton');

order.on('keyup', function(e) {
    if (e.key === ' ' || e.key == 'Enter') {
        $(this).trigger('click')
    }
})

filter.on('keyup', function(e) {
    if (e.key === ' ' || e.key == 'Enter') {
        $(this).trigger('click')
    }
})

//for each article_card, if pressed enter trigger a click

let article_cards = $('.article_card');

article_cards.on('keyup', function(e) {
    if (e.key === 'Enter') {
        $(this).trigger('click')
    }
})
