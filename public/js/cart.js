function addProductToCart(productId) {
    $.ajax({
        type: 'POST',
        url: '/cart/add',
        data: {
            product_id: productId,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            console.log('Produkt wurde hinzugefügt:', response);
            updateCart(response);
        },
        error: function(xhr) {
            console.error('Fehler beim Hinzufügen des Produkts:', xhr.responseText);
        }
    });
}

function updateCart(data) {
    $('.total-count').text(data.totalCount);

    let shoppingList = $('.shopping-list');
    shoppingList.empty(); // Zuerst leeren

    if (data.productsInCart.length > 0) {
        data.productsInCart.forEach(function(product) {
            shoppingList.append('<li>' + product + '</li>');
        });
    } else {
        shoppingList.append('<li>Warenkorb ist leer</li>');
    }
}
