function sum(input) {
    if (toString.call(input) !== "[object Array]")
        return false;
    var total = 0;
    for (var i = 0; i < input.length; i++) {
        if (isNaN(input[i])) {
            continue;
        }
        total += Number(input[i]);
    }
    return total;
}

let dataTable = $('#ordersTable').DataTable({
    ajax: {
        url: '/api/get-orders',
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
        data: 'id',
        class: 'selection',
    },
    {
        data: 'customer.customer_name'
    },
    {
        data: null,
        render: function (data) {
            let html = data.items.map(function (item) {
                return `${item.pivot.quantity}x ` + item.item_name;
            }).join('<br />');
            return html;
        }
    },
    {
        data: 'paymentmethod.Methods'
    },
    {
        data: null,
        render: function (data) {

            let prices = data.items.map(function (item) {
                return item.sellprice * item.pivot.quantity;
            });
            return "&#8369;" + sum(prices);
        }
    },
    {
        data: 'status',
    },
    {
        data: null,
        render: function (data) {
            let createdDate = new Date(data.created_at);
            return createdDate.toLocaleDateString("en-US");
        },
    },
    {
        data: null,
        render: function (data) {
            if (data.status === "Processing") {
                return `<button type="button" data-id="${data.id}" class="btn btn-warning for-delivery">
                            <i class="bi bi-box-seam"></i> For Delivery
                        </button>
                        <button type="button" data-id="${data.id}" class="btn btn-danger cancelled">
                            <i class="bi bi-journal-x"></i> Cancel
                        </button>`;
            } else if (data.status === "For Delivery") {
                return `<button type="button" data-id="${data.id}" class="btn btn-primary shipped">
                            <i class="bi bi-truck"></i> Shipped
                        </button>`;
            } else {
                return `<button type="button" data-id="${data.id}" class="btn btn-success btn-delete delivered">
                            <i class="bi bi-wallet-fill" style="color:white"></i> Delivered
                        </button>`;
            }

        },
        searchable: false,
    }
    ]
});

$(document).on('click', '.shipped', function (event) {
    let id = $(this).attr('data-id');
    console.log(id);

    $.confirm({
        title: 'Update to Shipped',
        content: 'Are you sure?',
        buttons: {
            confirm: function () {
                $.ajax({
                    url: `/api/update-to-shipped/${id}`,
                    type: 'GET',
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        $('.for-alert').prepend(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Order Number ${data.id} Updated to Shipped Status
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    `);
                        $('.alert').fadeOut(5000, function () {
                            $(this).remove();
                        });
                        $('#ordersTable').DataTable().ajax.reload();
                    },
                    error: function () {
                        $.alert('Error!');
                    }
                })
            },
            cancel: function () {
                $.alert('Canceled!');
            },
        }
    });
})

$(document).on('click', '.delivered', function (event) {
    let id = $(this).attr('data-id');
    console.log(id);

    $.confirm({
        title: 'Update to Delivered',
        content: 'Are you sure?',
        buttons: {
            confirm: function () {
                $.ajax({
                    url: `/api/update-to-delivered/${id}`,
                    type: 'GET',
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        $('.for-alert').prepend(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Order Number ${data.id} Updated to Delivered Status
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    `);
                        $('.alert').fadeOut(5000, function () {
                            $(this).remove();
                        });
                        $('#ordersTable').DataTable().ajax.reload();
                    },
                    error: function () {
                        $.alert('Error!');
                    }
                })
            },
            cancel: function () {
                $.alert('Canceled!');
            },
        }
    });
})

$(document).on('click', '.for-delivery', function (event) {
    let id = $(this).attr('data-id');
    console.log(id);

    $.confirm({
        title: 'Update For Delivery Status',
        content: 'Are you sure?',
        buttons: {
            confirm: function () {
                $.ajax({
                    url: `/api/update-to-for-delivery/${id}`,
                    type: 'GET',
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        $('.for-alert').prepend(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Order Number ${data.id} Updated For Delivery Status
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    `);
                        $('.alert').fadeOut(5000, function () {
                            $(this).remove();
                        });
                        $('#ordersTable').DataTable().ajax.reload();
                    },
                    error: function () {
                        $.alert('Error!');
                    }
                })
            },
            cancel: function () {
                $.alert('Canceled!');
            },
        }
    });
})

$(document).on('click', '.cancelled', function (event) {
    let id = $(this).attr('data-id');
    console.log(id);

    $.confirm({
        title: 'Cancel Order',
        content: 'Are you sure?',
        buttons: {
            confirm: function () {
                $.ajax({
                    url: `/api/update-to-cancelled/${id}`,
                    type: 'GET',
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        $('.for-alert').prepend(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Order Number ${data.id} has been Cancelled
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    `);
                        $('.alert').fadeOut(5000, function () {
                            $(this).remove();
                        });
                        $('#ordersTable').DataTable().ajax.reload();
                    },
                    error: function () {
                        $.alert('Error!');
                    }
                })
            },
            cancel: function () {
                $.alert('Canceled!');
            },
        }
    });
})
