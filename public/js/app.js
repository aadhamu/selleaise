// public/js/app.js
$(document).ready(function() {
    // Cart quantity updates
    $('.btn-minus').click(function() {
        let input = $(this).closest('.input-group').find('.quantity-input');
        let value = parseInt(input.val());
        if (value > 1) {
            input.val(value - 1);
            updateCartItem(input);
        }
    });
    
    $('.btn-plus').click(function() {
        let input = $(this).closest('.input-group').find('.quantity-input');
        let value = parseInt(input.val());
        input.val(value + 1);
        updateCartItem(input);
    });
    
    function updateCartItem(input) {
        let itemId = input.data('item-id');
        let quantity = input.val();
        
        $.ajax({
            url: '/cart/' + itemId,
            method: 'PATCH',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                quantity: quantity
            },
            success: function(response) {
                // Reload or update totals
                location.reload();
            }
        });
    }
    
    // Size and color selection in product details
    $('input[name="size"]').change(function() {
        $('#selected-size').val($(this).val());
    });
    
    $('input[name="color"]').change(function() {
        $('#selected-color').val($(this).val());
    });
    
    // Initialize first selected size/color if any
    if ($('input[name="size"]:checked').length) {
        $('#selected-size').val($('input[name="size"]:checked').val());
    }
    
    if ($('input[name="color"]:checked').length) {
        $('#selected-color').val($('input[name="color"]:checked').val());
    }
});