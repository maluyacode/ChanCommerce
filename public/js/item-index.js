// initialize datatable
let dataTable = $('#itemsTable').DataTable({
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
                <button type="button" data-id="${data.id}" class="btn btn-danger btn-delete delete">
                    <i class="fas fa-trash" style="color:white"></i>
                </button>`;
        }
    }
    ]

});

// make create button
$('.dt-buttons').prepend(
    '<button type="button" id="create" data-bs-toggle="modal" data-bs-target="#itemModal" class="dt-button">Create</buttons>'
);


$('#create').on('click', function () {
    $('#item_id').remove();
    $('#draggable').remove();
    $('#update').hide();
    $('#save').show();
    $('#itemForm').trigger("reset");

    $('input[name="document[]"]').remove();
    $('.dz-preview').remove()
    $('.dz-message').css({
        display: "block",
    })

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


$('#save').on('click', function (event) {
    event.preventDefault();
    let formData = new FormData($('#itemForm')[0]);
    // for (var pair of formData.entries()) {
    //     console.log(pair[0] + ', ' + pair[1]);
    // }
    $('#itemModal *').prop('disabled', true);
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
            $('#itemModal *').prop('disabled', false);
            $('#itemModal').modal("hide");
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


$(document).on('click', 'button.edit', function () {
    $('#save').hide();
    $('#update').show();
    $('#item_id').remove();

    $('input[name="document[]"]').remove();
    $('.dz-preview').remove()
    $('.dz-message').css({
        display: "block",
    })

    let id = $(this).attr('data-id');

    $.ajax({
        url: `/api/item/${id}/edit`,
        type: "GET",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            $('#draggable').remove();
            let category = $('#category');
            let supplier = $('#supplier');

            let container = $('<div>').attr({ id: "draggable", })
            $('#itemForm').append($(`<input type="hidden" value="${id}" id="item_id">`))

            category.find('option').remove()
            supplier.find('option').remove()

            $('#name').val(data.item.item_name);
            supplier.append($('<option>').attr({ 'selected': true }).val(data.item.supplier.id).html(data.item.supplier.sup_name));
            category.append($('<option>').attr({ 'selected': true }).val(data.item.category.id).html(data.item.category.cat_name));
            $('#sellprice').val(data.item.sellprice);

            $.each(data.item.media, function (id, value) {
                container.append($('<img>').attr("src", `${value.original_url}`))
            })

            $('#itemModal').append(container);

            $.each(data.categories, function (key, value) {
                category.append($('<option>').val(key).html(value))
            })

            $.each(data.suppliers, function (key, value) {
                supplier.append($('<option>').val(key).html(value))
            })

            $("#draggable").draggable();
        },
        error: function (error) {
            alert("error");
        },
    })
});


$('#update').on('click', function (event) {
    event.preventDefault();

    let id = $('#item_id').val();
    let formData = new FormData($('#itemForm')[0]);
    for (var pair of formData.entries()) {
        console.log(pair[0] + ', ' + pair[1]);
    }

    formData.append('_method', 'PUT');

    $('#itemModal *').prop('disabled', true);

    $.ajax({
        url: `/api/item/${id}/update`,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: "json",
        success: function (data, status) {
            $('#itemModal').modal("hide");
            $('#itemModal *').prop('disabled', false);
            $('#itemForm').trigger("reset");
            $('input[name="document[]"]').remove();
            $('.dz-preview').remove()
            $('.dz-message').css({
                display: "block",
            })

            $('.for-alert').prepend(`
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Successfully Updated!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        `);
            $('.alert').fadeOut(5000, function () {
                $(this).remove();
            });
            $('#item_id').remove();
            $('#itemsTable').DataTable().ajax.reload();

        },
        error: function (error) {
            console.log(error.responseJSON.errors);
            alert("error");
            $('#itemModal *').prop('disabled', false);
        }
    })
})


$(document).on('click', 'button.delete', function () {
    let id = $(this).attr("data-id");
    $.confirm({
        title: 'Delete Item',
        content: 'Are you sure?',
        buttons: {
            confirm: function () {
                $.ajax({
                    url: `/api/item/${id}/delete`,
                    type: 'DELETE',
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        $('.for-alert').prepend(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Successfully Deleted!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    `);
                        $('.alert').fadeOut(5000, function () {
                            $(this).remove();
                        });
                        $('#itemsTable').DataTable().ajax.reload();
                    },
                    error: function () {
                        alert('error')
                    }
                })
            },

            cancel: function () {
                $.alert('Canceled!');
            },
        }
    });
});
