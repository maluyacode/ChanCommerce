let dataTable = $('#stockTable').DataTable({
    ajax: {
        url: '/api/item/stocks',
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
        data: 'quantity'
    },
    {
        data: 'description'
    },
    {
        data: null,
        render: function (data) {
            return `<div class="action-buttons"><button type="button" data-bs-toggle="modal" data-bs-target="#accountModal" data-id="${data.id}" class="btn btn-primary edit">
                    <i class="bi bi-plus-square"></i> Add Quantity
                </button>`;
        },
        searchable: false,
    }
    ]

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

$(document).on('click', '.edit', function () {
    let id = $(this).attr('data-id');
    $.confirm({
        title: 'Update Stock',
        content: '' +
            '<form action="" class="formName">' +
            '<div class="form-group">' +
            '<label>Provide the Quantity, and it will be added to the stock.</label>' +
            '<input type="text" placeholder="Quantity" class="name form-control" required />' +
            '</div>' +
            '</form>',
        buttons: {
            formSubmit: {
                text: 'Submit',
                btnClass: 'btn-blue',
                action: function () {
                    var quantity = this.$content.find('.name').val();
                    if (!quantity) {
                        $.alert('Akala mo lang meron, pero wala wala wala! ');
                        return false;
                    }
                    let formData = {
                        "quantity": quantity
                    }
                    $.ajax({
                        url: `/api/item/update/${id}/stock`,
                        type: "PUT",
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: "json",
                        success: function (data) {
                            alertAction("Stock Updated Succesfully")
                            $('#stockTable').DataTable().ajax.reload();
                        },
                        error: function (error) {
                            $.alert('Error');
                        }
                    })
                }
            },
            cancel: function () {
                //close
            },
        },
        onContentReady: function () {
            // bind to events
            var jc = this;
            this.$content.find('form').on('submit', function (e) {
                // if the user submits the form by pressing enter in the field.
                e.preventDefault();
                jc.$$formSubmit.trigger('click'); // reference the button and click it
            });
        }
    });
});
