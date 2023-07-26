$(function () {
    let input = $('<input>').addClass('form-control').attr({
        "id": "name",
        "name": "cat_name",
        "placeholder": "Create category",
    })
    let button = $('<button>').addClass('btn btn-secondary').html('Add').attr({
        "id": "add",
    })
    let container = $('<div>').addClass('form-group categoryForm')

    container.append(input).append(button);

    $('#category-table_wrapper').prepend(container);
});

$(document).on('click', 'button#add', function () {
    let name = $('#name').val();
    if (!name) {
        $.alert("Category Name Reqired");
    }
    $.ajax({
        url: "/api/category/store",
        type: "POST",
        data: { "cat_name": name },
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            $('#name').val("");

            $('.for-alert').prepend(`
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                New Category Created
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        `);
            $('.alert').fadeOut(5000, function () {
                $(this).remove();
            });
            $('#category-table').DataTable().ajax.reload();
        },
        error: function (error) {
        },
    })
})

$(document).on('click', 'button.edit', function () {
    let id = $(this).attr('data-id');
    console.log(id);
    $(`.selection`).siblings('td').removeClass('colorData');
    $(`.selection`).removeClass('colorData');
    $.ajax({
        url: `/api/category/${id}/edit`,
        type: "GET",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            $('#name').attr({
                "data-id": data.id
            });
            $('#name').val(data.cat_name);
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
    let name = $('#name').val();
    console.log(name);
    let formData = {
        cat_name: name
    }
    if (!name) {
        $.alert("Category Name Reqired");
        $('#name').val(name);
    }
    $(`.selection`).siblings('td').removeClass('colorData');
    $(`.selection`).removeClass('colorData');

    $.ajax({
        url: `/api/category/${id}/update`,
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

            $('.for-alert').prepend(`
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Category Updated
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        `);
            $('.alert').fadeOut(5000, function () {
                $(this).remove();
            });
            $('#category-table').DataTable().ajax.reload();
        },
        error: function (error) {
        },
    })
})

$(document).on('click', 'button.delete', function () {
    let id = $(this).attr("data-id");
    $.confirm({
        title: 'Delete Category',
        content: 'Are you sure?',
        buttons: {
            confirm: function () {
                $.ajax({
                    url: `/api/category/${id}/delete`,
                    type: 'DELETE',
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        $('.for-alert').prepend(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Successfully Deleted!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    `);
                        $('.alert').fadeOut(5000, function () {
                            $(this).remove();
                        });
                        $('#category-table').DataTable().ajax.reload();
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
