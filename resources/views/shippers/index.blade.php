@extends('layouts.app')
@section('styles')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

    <link rel="stylesheet" href="{{ asset('css/shippers-index.css') }}">
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endsection

@section('headscripts')
    <!-- DataTables JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="yow">{{ __('List of Shipment Courier') }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="for-alert"></div>
            <div class="row">
                <form id="importForm" style="width: 50%;">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <button id="importButton" class="btn btn-secondary" type="submit">Import</button>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="excelFile" id="excelFile"
                                accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                            <label class="custom-file-label" for="inputGroupFile03" id="labelImport">Choose file</label>
                        </div>
                    </div>
                </form>
                <div class="col-lg-12">
                    <form></form>
                    <div class="card">
                        <div class="card-body">
                            <table id="shippersTable" class="table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Date created</th>
                                        <th scope="col">Action</th>
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
    </div>
    <div class="modal fade" id="modalDropzone" tabindex="-1" role="dialog" aria-labelledby="modalDropzoneTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDropzoneTitle" style="color: black">Upload Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id='buttonClose'>
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="dropzone" id="dropzone-image"></div>
                    <div class="container" style="display: flex; gap: 5px; margin-top: 10px;">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="saveWithoutImg">Save Without Image</button>
                    <button type="button" class="btn btn-primary" id="saveWithImg">Save With Image</button>
                    <button type="button" class="btn btn-primary" id="updateImg">Update</button>
                </div>
            </div>
        </div>
    </div>
    <div id="imageContainer">

    </div>
    <script>
        // Initialize Dropzone, processes
        initilizeDropzone();
        var uploadedDocumentMap = {}

        function initilizeDropzone() {
            Dropzone.options.dropzoneImage = {
                url: '{{ route('shippers.storeMedia') }}',
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
    <script src="{{ asset('js/shippers-index.js') }}"></script>
@endsection
