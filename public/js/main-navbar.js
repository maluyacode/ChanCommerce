$(function () {
    let id = $('#cart-number').attr('data-id');
    $.ajax({
        url: `/api/cart/${id}/count/`,
        type: "GET",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            $('#cart-number').attr({
                "value": data.cart,
            })
        },
        error: function (error) {
            alert('can"t count');
        }
    })

})
