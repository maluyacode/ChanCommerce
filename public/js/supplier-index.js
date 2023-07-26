let dataTable = $('#supplierTable').DataTable({
    ajax: {
        url: '/api/suppliers',
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
        data: 'sup_name'
    },
    {
        data: 'sup_contact'
    },
    {
        data: 'sup_address',
    },
    {
        data: 'sup_email',
        class: 'lowercase'
    },
    {
        data: null,
        render: function (data) {
            return `<div class="action-buttons"><button type="button" data-bs-toggle="modal" data-bs-target="#supplierModal" data-id="${data.id}" class="btn btn-primary edit">
                    <i class="fas fa-edit"></i>
                </button>
                <button type="button" data-id="${data.id}" class="btn btn-danger btn-delete delete">
                    <i class="fas fa-trash" style="color:white"></i>
                </button></div>`;
        },
        searchable: false,
    }
    ]

});

$('.dt-buttons').prepend(
    '<button type="button" id="create" data-bs-toggle="modal" data-bs-target="#supplierModal" class="dt-button">Create</buttons>'
);

let updateButton = $('#update');
let saveButton = $('#save');

function resetForm() {
    $('#hidden_id').remove();
    $('.image-container').remove();
    $('#supplierForm').trigger("reset");
    $('#supplierModal *').prop('disabled', false);
}

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

$(document).on('click', 'button#create', function () {
    updateButton.hide();
    saveButton.show();
})

saveButton.on('click', function () {
    let formData = new FormData($('#supplierForm')[0]);
    $('#supplierModal *').prop('disabled', true);
    for (var pair of formData.entries()) {
        console.log(pair[0] + ', ' + pair[1]);
    }

    $.ajax({
        url: '/api/suppliers/',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: "json",
        success: function (data, status) {
            $('#supplierModal *').prop('disabled', false);
            $('#supplierModal').modal("hide");
            resetForm();
            alertAction("New Supplier Added Successfuly");
            $('#supplierTable').DataTable().ajax.reload();
        },
        error: function (error) {
            errorsShow(error.responseJSON.errors);
            console.log(error);
        }
    })
})

$(document).on('click', 'button.edit', function () {

    let id = $(this).attr('data-id');
    resetForm();
    updateButton.show();
    saveButton.hide();

    $.ajax({
        url: `/api/suppliers/${id}/edit`,
        type: "GET",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            $('#supplierForm').prepend($('<input>').attr({
                type: "hidden",
                value: data.id,
                id: "hidden_id",
            }))
            $('#sup_name').val(data.sup_name)
            $('#sup_contact').val(data.sup_contact)
            $('#sup_email').val(data.sup_email)
            $('#sup_address').val(data.sup_address)
        },
        error: function (error) {
            $.alert("Error Occured");
        },
    })
});

updateButton.on('click', function (event) {
    let id = $('#hidden_id').val();

    let formData = new FormData($('#supplierForm')[0]);
    for (var pair of formData.entries()) {
        console.log(pair[0] + ', ' + pair[1]);
    }

    formData.append('_method', 'PUT');

    $('#accountModal *').prop('disabled', true);

    $.ajax({
        url: `/api/suppliers/${id}/update`,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: "json",
        success: function (data, status) {
            $('#supplierModal *').prop('disabled', false);
            $('#supplierModal').modal("hide");
            resetForm()
            alertAction("Supplier Updated Succesfully")
            $('#supplierTable').DataTable().ajax.reload();
        },
        error: function (error) {
            console.log(error.responseJSON.errors);
            errorsShow(error.responseJSON.errors);

        }
    })
})
$(document).on('click', 'button.delete', function () {
    let id = $(this).attr("data-id");
    $.confirm({
        title: 'Delete Supplier',
        content: 'Are you sure?',
        buttons: {
            confirm: function () {
                $.ajax({
                    url: `/api/suppliers/${id}/delete`,
                    type: 'DELETE',
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        $('#supplierModal *').prop('disabled', false);
                        $('#supplierModal').modal("hide");
                        resetForm()
                        alertAction("Supplier Deleted Succesfully")
                        $('#supplierTable').DataTable().ajax.reload();
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
    $('#supplierModal *').prop('disabled', false);
    $('.invalid-feedback').css({
        display: "none"
    })
    if (message.sup_name) {
        $('#sup_name').siblings('div').html(message.sup_name).css({
            display: "block"
        })
    }
    if (message.sup_contact) {
        $('#sup_contact').siblings('div').html(message.sup_contact).css({
            display: "block"
        })
    }

    if (message.sup_email) {
        $('#sup_email').siblings('div').html(message.sup_email).css({
            display: "block"
        })
    }

    if (message.sup_address) {
        $('#sup_address').siblings('div').html(message.sup_address).css({
            display: "block"
        })
    }
}

$('input').on("keyup", function () {
    $(this).siblings('div').css({
        display: "none"
    })
})
