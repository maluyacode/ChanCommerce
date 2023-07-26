@extends('layouts.app')
@section('styles')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

    <link rel="stylesheet" href="{{ asset('css/customer-index.css') }}">

    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
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
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
@endsection
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="yow">{{ __('List of Accounts') }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="for-alert">

            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="accountsTable" class="table-bordered">
                                <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>Customer</th>
                                        <th>Contact</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Account</th>
                                        <th>Date Registered</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="accountModal" tabindex="-1" aria-labelledby="accountModalLabel" aria-hidden="true">
            <!-- Modal -->
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="accountModalLabel"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body accountModal">
                        <form id="accountForm" action="#" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Account Name</label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name"
                                    placeholder="Enter Account Name">
                                    <div class="invalid-feedback">
                                    </div>
                            </div>
                            <div class="form-group">
                                <label for="country">Account Contact</label>
                                <input type="text" class="form-control" id="contact"
                                    placeholder="Enter Account Contact" name="contact">
                                    <div class="invalid-feedback">
                                    </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Account Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter Account Email"
                                    name="email">
                                    <div class="invalid-feedback">
                                    </div>
                            </div>
                            <div class="form-group">
                                <label for="country">Account Home Address</label>
                                <input type="text" class="form-control" id="address"
                                    placeholder="Enter Account Home Address" name="address">
                                    <div class="invalid-feedback">
                                    </div>
                            </div>
                            <div class="form-group">
                                <label for="type">Account Type</label>
                                <select class="form-control" name="usertype" id="usertype">
                                    <option value="Admin">Admin</option>
                                    <option value="User">User / Customer</option>
                                </select>
                                <div class="invalid-feedback">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password">Account Password</label>
                                <input type="password" id="password" class="form-control" name="password">
                                <input type="checkbox" onclick="showPassword()"><label for="">Show Password</label>
                            </div>
                            <div class="form-group">
                                <label for="images">Item Image</label>
                                <div class="dropzone" id="dropzone-image"></div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button id="save" type="button" class="btn btn-primary">Save</button>
                        <button id="update" type="button" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Initialize Dropzone, processes
        initilizeDropzone();
        var uploadedDocumentMap = {}

        function initilizeDropzone() {
            Dropzone.options.dropzoneImage = {
                url: '{{ route('customers.storeMedia') }}',
                maxFilesize: 2,
                acceptedFiles: 'image/*',
                addRemoveLinks: true,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(file, response) {
                    $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
                    uploadedDocumentMap[file.name] = response.name
                },
                removedfile: function(file) {
                    file.previewElement.remove()
                    var name = ''
                    if (typeof file.file_name !== 'undefined') {
                        name = file.file_name
                    } else {
                        name = uploadedDocumentMap[file.name]
                    }
                    $('form').find('input[name="document[]"][value="' + name + '"]').remove()
                },
                error: function(file) {
                    alert("Only image will be accepted.");
                    file.previewElement.remove();
                    $('.dz-message').css({
                        display: "block",
                    })
                },
                init: function() {
                    @if (isset($project) && $project->document)
                        var files = {!! json_encode($project->document) !!}
                        for (var i in files) {
                            var file = files[i]
                            this.options.addedfile.call(this, file)
                            file.previewElement.classList.add('dz-complete')
                            $('form').append('<input type="hidden" name="document[]" value="' + file.file_name +
                                '">')
                        }
                    @endif
                },
            }
        }
    </script>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/customer-index.js') }}" defer></script>
@endsection
