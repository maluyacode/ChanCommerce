@extends('layouts.app')

@section('styles')
    <!-- jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
@endsection

@section('headscripts')
    <!-- DataTables JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

    <!-- DataTables Buttons JS -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="yow">{{ __('Items') }}</h1>
                    <br>
                    <button class="btn btn-success bi bi-plus-circle"> Create</button>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="itemsTable">
                                <thead>
                                    <tr>
                                        <th>Item ID</th>
                                        <th>Item Name</th>
                                        <th>Category</th>
                                        <th>Supplier</th>
                                        <th>Sell Price</th>
                                        <th>Date created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- <tr>
                                        <td>asdsadas</td>
                                        <td>asdsada</td>
                                        <td>asdsad</td>
                                        <td>asdsad</td>
                                        <td>asdsad</td>
                                        <td>asdsad</td>
                                        <td>asdsad</td>
                                        <td>asdsada</td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
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
                    render: function(data) {
                        let createdDate = new Date(data.created_at);
                        return createdDate.toLocaleDateString("en-US");
                    }
                },
                {
                    data: null,
                    render: function(data) {
                        return `<button type="button" data-id="${data.id}" class="btn btn-primary">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" data-id="${data.id}" class="btn btn-danger btn-delete">
                            <i class="fas fa-trash" style="color:white"></i>
                        </button>`;
                    }
                }
            ]

        });
    </script>
@endsection
