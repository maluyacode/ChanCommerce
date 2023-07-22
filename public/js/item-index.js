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
            console.log(data);
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

$('#save').on('click', function () {

});
