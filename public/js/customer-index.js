let dataTable = $('#accountsTable').DataTable({
    ajax: {
        url: '/api/customers',
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
            if (!data.media[0]) {
                return "No Images In media"
            } else {
                return `<img src="${data.media[0]?.original_url}" data-id="${data.id}">
                     <span class="hover-text viewImage" data-id="${data.id}">View Images</span>`;
            }
        },
        class: "item-image",
    },
    {
        data: 'customer_name'
    },
    {
        data: 'contact'
    },
    {
        data: 'user.email',
        class: 'lowercase'
    },
    {
        data: 'address'
    },
    {
        data: 'user.usertype'
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
            return `<div class="action-buttons"><button type="button" data-bs-toggle="modal" data-bs-target="#accountModal" data-id="${data.id}" class="btn btn-primary edit">
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

let validate;
$(function () {

    validate = $('#accountForm').validate({
        rules: {
            customer_name: {
                required: true,
                minlength: 5,
            },
            contact: {
                required: true,
            },
            email: {
                required: true,
                email: true,
            },
            usertype: {
                required: true,
            },
            address: {
                required: true,
            },
            password: {
                required: true,
                minlength: 8,
            },
            usertype: {
                required: true,
            },
        }
    })

})

$('.dt-buttons').prepend(
    '<button type="button" id="create" data-bs-toggle="modal" data-bs-target="#accountModal" class="dt-button">Create</buttons>'
);

$('#accountModal').on('hidden.bs.modal', function () {
    $('div.invalid-feedback').empty()
})

function showPassword() {
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

let updateButton = $('#update');
let saveButton = $('#save');

function resetForm() {
    $('.image-container').remove();
    $('#accountForm').trigger("reset");
    $('input[name="document[]"]').remove();
    $('#hidden_id').remove();
    $('.dz-preview').remove()
    $('.dz-message').css({
        display: "block",
    })
    $('#accountModal *').prop('disabled', false);
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

function showImageEdit(media) {
    let container = $('<div>').addClass('image-container');
    $.each(media, function (index, image) {
        container.append($('<img>')
            .attr({
                src: image.original_url
            })
        )
    })
    $('.accountModal').prepend(container);
}

$(document).on('click', 'button#create', function () {
    validate.resetForm();
    updateButton.hide();
    saveButton.show();
    $('.image-container').remove();
    resetForm();
})

saveButton.on('click', function () {
    if ($('#accountForm').valid()) {


        console.log("SAdsa");
        let formData = new FormData($('#accountForm')[0]);
        $('#accountModal *').prop('disabled', true);
        // for (var pair of formData.entries()) {
        //     console.log(pair[0] + ', ' + pair[1]);
        // }

        $.ajax({
            url: '/api/customers/',
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            success: function (data, status) {
                $('#accountModal *').prop('disabled', false);
                $('#accountModal').modal("hide");
                resetForm();
                alertAction("Account Created Successfuly");
                $('#accountsTable').DataTable().ajax.reload();
            },
            error: function (error) {
                errorsShow(error.responseJSON.errors)
                if (error.responseJSON.errors.password) {
                    $('#password').siblings('div').html(error.responseJSON.errors.password).css({
                        display: "block"
                    })
                }
                $('#accountModal *').prop('disabled', false);
            }
        })
    }
})

$(document).on('click', 'button.edit', function () {
    validate.resetForm();
    let id = $(this).attr('data-id');
    resetForm();
    updateButton.show();
    saveButton.hide();

    $.ajax({
        url: `/api/customers/${id}/edit`,
        type: "GET",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            $('#accountForm').prepend($('<input>').attr({
                type: "hidden",
                value: data.user_id,
                id: "hidden_id",
            }))
            $('#customer_name').val(data.customer_name)
            $('#contact').val(data.contact)
            $('#email').val(data.user.email)
            $('#address').val(data.address)
            $('#usertype').val(data.user.usertype)
            showImageEdit(data.media);
        },
        error: function (error) {
            $.alert("Error Occured");
        },
    })
});

updateButton.on('click', function (event) {

    if ($('#accountForm').valid()) {
        let id = $('#hidden_id').val();

        let formData = new FormData($('#accountForm')[0]);
        for (var pair of formData.entries()) {
            console.log(pair[0] + ', ' + pair[1]);
        }

        formData.append('_method', 'PUT');

        $('#accountModal *').prop('disabled', true);

        $.ajax({
            url: `/api/customers/${id}`,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            success: function (data, status) {
                $('#accountModal *').prop('disabled', false);
                $('#accountModal').modal("hide");
                resetForm()
                alertAction("Account Updated Succesfully")
                $('#accountsTable').DataTable().ajax.reload();
            },
            error: function (error) {
                errorsShow(error.responseJSON.errors)
                $('#accountModal *').prop('disabled', false);
            }
        })
    }
})

$(document).on('click', 'button.delete', function () {
    let id = $(this).attr("data-id");
    $.confirm({
        title: 'Delete Account',
        content: 'Are you sure?',
        buttons: {
            confirm: function () {
                $.ajax({
                    url: `/api/customers/${id}`,
                    type: 'DELETE',
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        resetForm()
                        alertAction("Account Deleted Succesfully")
                        $('#accountsTable').DataTable().ajax.reload();
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


function errorsShow(message) {
    $('.invalid-feedback').css({
        display: "none"
    })

    if (message.customer_name) {
        $('#customer_name').siblings('div').html(message.customer_name).css({
            display: "block"
        })
    }

    if (message.contact) {
        $('#contact').siblings('div').html(message.contact).css({
            display: "block"
        })
    }

    if (message.email) {
        $('#email').siblings('div').html(message.email).css({
            display: "block"
        })
    }

    if (message.address) {
        $('#address').siblings('div').html(message.address).css({
            display: "block"
        })
    }

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

$(document).on('click', '.viewImage', function (event) {
    let id = $(this).attr('data-id');
    event.preventDefault();
    console.log(id);

    $.ajax({
        url: `/api/customer/media/${id}`,
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
            }).addClass('btn btn-success'));
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

$('#importForm').on('submit', function (e) {

    e.preventDefault()
    let file = $('#excelFile').val();
    if (file) {
        let formData = new FormData($(this)[0]);
        for (var pair of formData.entries()) {
            console.log(pair[0] + ', ' + pair[1]);
        }
        $.ajax({
            url: '/api/customer/import',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            success: function (responseData) {
                $('#labelImport').html('Choose file');
                $('#importForm').trigger("reset");
                $('#accountsTable').DataTable().ajax.reload();
                alertAction('Imported Successfully')

            },
            error: function (responseError) {
                errorDisplay(responseError.responseJSON.errors);
            }
        })
    } else {
        $.alert('Put Excel File First')
    }
})

$('#excelFile').on('change', function (e) {
    $('#labelImport').html(e.target.files[0].name);
})
