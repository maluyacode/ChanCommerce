let dataTable = $('#paymentMethodsTable').DataTable({
    ajax: {
        url: '/api/payment-methods',
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
        data: 'Methods'
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

$(function () {
    let input = $('<input>').addClass('form-control').attr({
        "id": "name",
        "name": "name",
        "placeholder": "Create Payment Method",
    })
    let button = $('<button>').addClass('btn btn-secondary').html('Add').attr({
        "id": "add",
    })
    let container = $('<div>').addClass('form-group categoryForm')

    container.append(input).append(button);

    $('#paymentMethodsTable_wrapper').prepend(container);
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

$(document).on('click', 'button#add', function () {
    let name = $('#name').val();
    $.ajax({
        url: "/api/payment-methods/store",
        type: "POST",
        data: { "name": name },
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            $('#name').val("");
            alertAction("New Payment Method Added");
            $('#paymentMethodsTable').DataTable().ajax.reload();
        },
        error: function (error) {
            $.alert("Give it a name boy");
        },
    })
})

$(document).on('click', 'button.edit', function () {
    let id = $(this).attr('data-id');
    console.log(id);
    $(`.selection`).siblings('td').removeClass('colorData');
    $(`.selection`).removeClass('colorData');
    $.ajax({
        url: `/api/payment-methods/${id}/edit`,
        type: "GET",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            $('#name').attr({
                "data-id": data.id
            });
            $('#name').val(data.Methods);
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
    let id = $('#name').attr('data-id');
    let formData = {
        name: $('#name').val()
    }

    $(`.selection`).siblings('td').removeClass('colorData');
    $(`.selection`).removeClass('colorData');

    $.ajax({
        url: `/api/payment-methods/${id}/update`,
        type: "PUT",
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            $('#name').val("");
            $('#name').removeAttr('data-id');
            $('#update').attr({
                "id": "add",
            }).html("Create");
            alertAction("Payement Method Updated Successfully")
            $('#paymentMethodsTable').DataTable().ajax.reload();
        },
        error: function (error) {
            $.alert("Give it a name boy");
        },
    })
})

$(document).on('click', 'button.delete', function () {
    let id = $(this).attr("data-id");
    $.confirm({
        title: 'Delete Payment Method',
        content: 'Are you sure?',
        buttons: {
            confirm: function () {
                $.ajax({
                    url: `/api/payment-methods/${id}/delete`,
                    type: 'DELETE',
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        alertAction("Payment Method Deleted Successfully")
                        $('#paymentMethodsTable').DataTable().ajax.reload();
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
