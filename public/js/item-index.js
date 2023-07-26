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
        data: null,
        render: function (data) {
            return `<img src="${data.media[0]?.original_url}" data-id="${data.id}">
                     <span class="hover-text viewImage" data-id="${data.id}">View Images</span>`;
        },
        class: "item-image",
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
            return `<div class="action-buttons"><button type="button" data-bs-toggle="modal" data-bs-target="#itemModal" data-id="${data.id}" class="btn btn-primary edit">
                    <i class="fas fa-edit"></i>
                </button>
                <button type="button" data-id="${data.id}" class="btn btn-danger btn-delete delete">
                    <i class="fas fa-trash" style="color:white"></i>
                </button></div>`;
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
            alertAction("New Item Created")
            $('#itemsTable').DataTable().ajax.reload();

        },
        error: function (error) {
            errorsShow(error.responseJSON.errors);
            $('#itemModal *').prop('disabled', false);
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
            alertAction("Item Updated Successfully")
            $('#item_id').remove();
            $('#itemsTable').DataTable().ajax.reload();

        },
        error: function (error) {
            errorsShow(error.responseJSON.errors);
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
                        alertAction("Item Deleted Successfully")
                        $('#itemsTable').DataTable().ajax.reload();
                    },
                    error: function () {
                        alert('error')
                    }
                })
            },

            cancel: function () {

            },
        }
    });
});


function errorsShow(message) {
    $('.invalid-feedback').css({
        display: "none"
    })
    $('#name').siblings('div').html(message.item_name).css({
        display: "block"
    })
    $('#category').siblings('div').html(message.cat_id).css({
        display: "block"
    })
    $('#supplier').siblings('div').html(message.sup_id).css({
        display: "block"
    })
    $('#sellprice').siblings('div').html(message.sellprice).css({
        display: "block"
    })
}

$('input').on("keyup", function () {
    $(this).siblings('div').css({
        display: "none"
    })
})

$('select').on("change", function () {
    $(this).siblings('div').css({
        display: "none"
    })
})

function alertAction(message) {
    $('.for-alert').prepend(`
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        ${message}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
`);
    $('.alert').fadeOut(5000, function () {
        $(this).remove();
    });
}

$(document).on('click', '.viewImage', function (event) {
    let id = $(this).attr('data-id');
    event.preventDefault();
    console.log(id);

    $.ajax({
        url: `/api/item/media/${id}`,
        type: 'GET',
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            // console.log(data.media[0].original_url);
            let container = $('<div>').attr("id", "containsImages").css({
                "position": "absolute",
                "top": "10%",
                "height": "50%",
                "display": "flex",
                "justify-content": "center",
                "gap": "10px",
                "flex-wrap": "wrap",
                "background-color": "#C51605",
            });
            $.each(data.media, function (index, value) {
                container.append(
                    $('<img>').attr({
                        src: value.original_url
                    }).css({
                        "width": "200px",
                        "height": "200px",
                        "object-fit": "cover",
                    })
                )
            });
            container.append($('<button>').attr({
                id: "closeImages",
            }).html("Closure na bai!").css({
                "flex-basis": "100%",
            }));
            $('.card-body').append(container);
        },
        error: function () {
            alert('error')
        }
    })
})

$(document).on('click', '#closeImages', function () {
    $('#containsImages').remove();
})
