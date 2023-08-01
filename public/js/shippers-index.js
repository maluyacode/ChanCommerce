let dataTable = $('#shippersTable').DataTable({
    ajax: {
        url: '/api/shippers',
        dataSrc: ''
    },
    responsive: true,
    autoWidth: false,
    dom: 'Bfrtip',
    columns: [{
        data: 'id',
        class: 'selection'
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
        data: 'name'
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
            return `<button type="button" data-id="${data.id}" class="btn btn-primary edit">
                    <i class="fas fa-edit"></i>
                </button>
                <button type="button" data-id="${data.id}" class="btn btn-danger btn-delete delete">
                    <i class="fas fa-trash" style="color:white"></i>
                </button>`;
        }
    }
    ]
});

$(function () {
    let input = $('<input>').addClass('form-control').attr({
        "id": "name",
        "name": "name",
        "placeholder": "Create Shipment Method",
    })
    let button = $('<button>').addClass('btn btn-secondary').html('Add').attr({
        "id": "add",
        // "data-target": "#modalDropzone",
        // "data-toggle": "modal",
    })
    let container = $('<div>').addClass('form-group categoryForm')

    container.append(input).append(button);

    $('#shippersTable_wrapper').prepend(container);
});

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

$('#buttonClose').on('click', function () {
    $('#modalDropzone').modal('hide');
})

$(document).on('click', 'button#add', function () {
    $('#saveWithImg').show()
    $('#saveWithoutImg').show()
    $('#updateImg').hide()
    $('form').empty();
    $('.dz-preview').remove()
    $('.dz-message').css({
        display: "block",
    })
    let name = $('#name').val();
    if (!name) {
        $.alert("Give it a name boy");

    } else {
        $('#modalDropzone').modal('show');
    }
})

$('#saveWithoutImg').on('click', function () {
    let name = $('#name').val();
    $.ajax({
        url: "/api/shippers/store",
        type: "POST",
        data: { "name": name },
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            alertAction("New Shipment Courier Successfully Added");
            $('#modalDropzone').modal('hide');
            $('form').empty();
            $('#name').val("");
            $('#shippersTable').DataTable().ajax.reload();
        },
        error: function (error) {
            $.alert("Give it a name boy");
            $('form').empty();
        },
    })
    $('.dz-preview').remove()
    $('.dz-message').css({
        display: "block",
    })
})

$('#saveWithImg').on('click', function () {
    // console.log($('input[name="document[]"]').val())
    if ($('input[name="document[]"]').val() === undefined) {
        $.alert("Requires Image");
    } else {
        console.log("asdsa");
        let name = $('#name').clone();
        let form = $('form').append(name.attr({ "type": "hidden" }));
        let formData = new FormData(form[0]);
        for (var pair of formData.entries()) {
            console.log(pair[0] + ', ' + pair[1]);
        }
        $.ajax({
            url: "/api/shippers/store",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                alertAction("New Shipment Courier Successfully Added");
                $('form').empty();
                $('#name').val("");
                $('#buttonClose').trigger('click');
                $('#shippersTable').DataTable().ajax.reload();
            },
            error: function (error) {
                $.alert("Give it a name boy");
                $('form').empty();
            },
        })
    }
})


$(document).on('click', 'button.edit', function () {
    $('.container').empty()
    $('form').empty();
    $('.dz-preview').remove()
    $('.dz-message').css({
        display: "block",
    })
    let id = $(this).attr('data-id');
    console.log(id);
    $(`.selection`).siblings('td').removeClass('colorData');
    $(`.selection`).removeClass('colorData');
    $.ajax({
        url: `/api/shippers/${id}/edit`,
        type: "GET",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            $('#name').attr({
                "data-id": data.id
            });
            $('#name').val(data.name);
            $.each(data.media, function (index, value) {
                $('.container').append($('<img>').attr({
                    "src": value.original_url
                }).css({
                    "width": "100px",
                    "height": "100px",
                    "object-fit": "cover",
                }))
            })
            $('#add').attr({
                "id": "update",
            }).html("Update");
            $('.selection').filter(function () {
                return $(this).text().trim() === id;
            }).siblings('td').addClass('colorData');
            $('.selection').filter(function () {
                return $(this).text().trim() === id;
            }).addClass('colorData');
        },
        error: function (error) {
            alert("error");
        },
    })
});

$(document).on('click', 'button#update', function () {
    let name = $('#name').val();

    if (!name) {
        $.alert("Give it a name boy");
        return
    }
    $('#saveWithImg').hide()
    $('#saveWithoutImg').hide()
    $('#updateImg').show()
    $('#modalDropzone').modal('show');


    $(`.selection`).siblings('td').removeClass('colorData');
    $(`.selection`).removeClass('colorData');
})

$('#updateImg').on('click', function () {
    let id = $('#name').attr("data-id");
    let name = $('#name').clone();
    let form = $('form').append(name.attr({ "type": "hidden" }));
    let formData = new FormData(form[0]);
    // for (var pair of formData.entries()) {
    //     console.log(pair[0] + ', ' + pair[1]);
    // }
    formData.append('_method', 'PUT');
    $.ajax({
        url: `/api/shippers/${id}/update`,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            $('#name').removeAttr('data-id');
            $('#update').attr({
                "id": "add",
            }).html("Create");
            alertAction("Shipment Courier Updated Successfully")
            $('#shippersTable').DataTable().ajax.reload();
            $('#modalDropzone').modal('hide');
            $('.container').empty()
            $('form').empty();
            $('.dz-preview').remove()
            $('.dz-message').css({
                display: "block",
            })
            $('#name').val("");
        },
        error: function (error) {
            $.alert("Give it a name boy");
        },
    })

})

$(document).on('click', 'button.delete', function () {
    let id = $(this).attr("data-id");
    $.confirm({
        title: 'Delete Shipment Method',
        content: 'Are you sure?',
        buttons: {
            confirm: function () {
                $.ajax({
                    url: `/api/shippers/${id}/delete`,
                    type: 'DELETE',
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        alertAction("Payment Method Deleted Successfully")
                        $('#shippersTable').DataTable().ajax.reload();
                    },
                    error: function () {
                        $.alert('Error')
                    }
                })
            },
            cancel: function () {
                $.alert('Canceled!');
            },
        }
    });
});

$(document).on('click', '.viewImage', function (event) {
    let id = $(this).attr('data-id');
    event.preventDefault();
    console.log(id);

    $.ajax({
        url: `/api/shipper/media/${id}`,
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
            url: '/api/shipper/import',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            success: function (responseData) {

                $('#importForm').trigger("reset");

            },
            error: function (responseError) {
                errorDisplay(responseError.responseJSON.errors);
            }
        })
    } else {
        $.alert('Put Excel File First')
    }
})
