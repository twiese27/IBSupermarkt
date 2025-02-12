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
            updateCartIcon(response);
        },
        error: function(xhr) {
            console.error('Fehler beim Hinzufügen des Produkts:', xhr.responseText);
        }
    });
}

function updateCartIcon(data) {
    // Update the total count in the cart icon
    let totalCount = data.totalCount;
    $('.shopping .single-icon span').text(totalCount);
    $('.dropdown-cart-header span').text(totalCount);

    // Optionally, update the shopping list in the header as well
    let shoppingList = '';
    $.each(data.cart, function(productId, item) {
        shoppingList += `<li><strong>${item.name}</strong> - Menge: ${item.quantity}</li>`;
    });

    $('.shopping-item .shopping-list').html(shoppingList);
}


function increaseProduct(productId) {
    let inputField = $("#quantity-" + productId);
    let newQuantity = parseInt(inputField.val(), 10) + 1;

    updateProductQuantity(productId, newQuantity);
}

function decreaseProduct(productId) {
    let inputField = $("#quantity-" + productId);
    let currentQuantity = parseInt(inputField.val(), 10);

    if (currentQuantity > 1) {
        let newQuantity = currentQuantity - 1;
        updateProductQuantity(productId, newQuantity);
    }
}

function updateProductQuantity(productId, quantity) {
    $.ajax({
        type: 'POST',
        url: '/cart/update',
        data: {
            product_id: productId,
            quantity: quantity,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            console.log('Produktmenge geändert:', response);
            $("#quantity-" + productId).val(quantity);
            updateProductTotalPrice(productId, quantity);
        },
        error: function(xhr) {
            console.error('Fehler beim Ändern der Produktmenge:', xhr.responseText);
        }
    });
}


function updateProductTotalPrice(productId, quantity) {
    $.ajax({
        type: 'POST',
        url: '/cart/total-price',
        data: {
            product_id: productId,
            quantity: quantity,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            console.log('Preis des Artikels aktualisiert:', response);
            let roundedPrice = parseFloat(response.price).toFixed(2);
            $('#total-' + productId).text(roundedPrice + ' €');
            updateTotalCartPrice();
        },
        error: function(xhr) {
            console.error('Fehler beim Aktualisieren des Preises des Artikels:', xhr.responseText);
        }
    });
}

function updateTotalCartPrice() {
    $.ajax({
        type: 'POST',
        url: '/cart/total-cart-price',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            console.log('Preis des Warenkorbs aktualisiert:', response);
            let roundedTotal = parseFloat(response.total).toFixed(2);
            let roundedSubtotal = parseFloat(response.subtotal).toFixed(2);
            $('#total').text(roundedTotal + ' €');
            $('#subtotal').text(roundedSubtotal + ' €');
        },
        error: function(xhr) {
            console.error('Fehler beim Aktualisieren des Preises des Warenkorbs:', xhr.responseText);
        }
    });
}
