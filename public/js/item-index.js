$('#itemsTable').DataTable({
    ajax: {
        url: '/api/items',
        dataSrc: ''
    },
    responsive: true,
    autoWidth: false,
    dom: 'Bfrtip',
    buttons: [
        'copyHtml5',
        'excelHtml5',
        'csvHtml5',
        'pdfHtml5'
    ],
    columns: [{
        data: 'id'
    },
    {
        data: 'item_name'
    },
    {
        data: 'category.cat_name'
    },
    {
        data: 'supplier.sup_name'
    },
    {
        data: 'sellprice'
    },
    {
        data: null,
        render: function (data) {
            let createdDate = new Date(data.created_at);
            return createdDate.toLocaleDateString("en-US");
        }
    },
    {
        data: null,
        render: function (data) {
            return `<button type="button" data-bs-toggle="modal" data-bs-target="#itemModal" data-id="${data.id}" class="btn btn-primary edit">
                    <i class="fas fa-edit"></i>
                </button>
                <button type="button" data-id="${data.id}" class="btn btn-danger btn-delete">
                    <i class="fas fa-trash" style="color:white"></i>
                </button>`;
        }
    }
    ]

});

$('.dt-buttons').prepend(
    '<button type="button" id="create" data-bs-toggle="modal" data-bs-target="#itemModal" class="dt-button">Create</buttons>'
);

$('#create').on('click', function () {
    $('#update').hide();
    $('#save').show();
    $.ajax({
        url: "api/item/create",
        type: "GET",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            let category = $('#category');
            let supplier = $('#supplier');

            category.find('option').remove()
            supplier.find('option').remove()

            category.append($('<option>').html('Please select'))
            supplier.append($('<option>').html('Please select'))

            $.each(data.categories, function (key, value) {
                category.append($('<option>').val(key).html(value))
            })

            $.each(data.suppliers, function (key, value) {
                supplier.append($('<option>').val(key).html(value))
            })

        },
        error: function (error) {
            alert("error");
        },
    })

})

$(document).on('click', 'button.edit', function () {
    $('#save').hide();
    $('#update').show();
})

$('#save').on('click', function (event) {
    event.preventDefault();
    let formData = new FormData($('#itemForm')[0]);
    // for (var pair of formData.entries()) {
    //     console.log(pair[0] + ', ' + pair[1]);
    // }
    $('#itemModal').modal("hide");
    $.ajax({
        url: '/api/item/store',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: "json",
        success: function (data, status) {
            $('.buttons-reload').trigger('click');
            $('#itemForm').trigger("reset");
            $('input[name="document[]"]').remove();
            $('.dz-preview').remove()
            $('.dz-message').css({
                display: "block",
            })

            $('.for-alert').prepend(`
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                New Item Created
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        `);
            $('.alert').fadeOut(5000, function () {
                $(this).remove();
            });

        },
        error: function (error) {
            alert("error");
        }
    })
});
