@extends('layouts.app')

@section('content')
    @include('layouts.headers.cardsdashboard')

    <div class="container-fluid mt--6">
        @include('pages.errors.errors')
        @include('pages.status.status')
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0 d-flex justify-content-between">
                        <h3 class="mb-0">Countries</h3>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#eModal">
                            Add Country
                        </button>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">Name</th>
                                    <th scope="col" class="sort" data-sort="budget">Slug</th>
                                    <th scope="col" class="sort" data-sort="status">Create At</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach ($countries as $item)
                                    <tr id="{{ $item->id }}">
                                        <th data-target="name_category">
                                            <span class="name mb-0 text-sm">{{ $item->name }}</span>
                                        </th>
                                        <td class="budget" data-target="slug_category">
                                            {{ $item->slug }}
                                        </td>
                                        <td>
                                            <span class="badge badge-dot mr-4">
                                                <span class="status">{{ $item->created_at }}</span>
                                            </span>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item btn-update" data-toggle="modal"
                                                        data-target="#updateModal" data-id="{{ $item->id }}"
                                                        style="outline: none; cursor: pointer"
                                                        data-id="{{ $item->id }}">Edit</a>
                                                    <button
                                                        onclick="DeleteRow({{ $item->id }}, `{{ route('countries.destroy', ['country' => $item->id]) }}`)"
                                                        class="dropdown-item" id="btn-delete" data-id="1"
                                                        style="outline: none; cursor: pointer">Delete</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Card footer -->
                    <div class="card-footer py-4">
                        <nav aria-label="...">
                            <div class="pagination justify-content-end mb-0">
                                {!! $countries->links() !!}
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Create Modal -->
        <div class="modal fade" id="eModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create a country</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <ul class="errors"></ul>
                        <form method="post" id="CreateCountry">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Enter name" id="slug"
                                            onkeyup="ChangeToSlug()" name="name">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Enter slug" name="slug"
                                            id="convert_slug">
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn-save">Save</button>
                    </div>

                    </form>
                </div>
            </div>
        </div>


        <!-- Update Modal -->
        <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Updating country</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul class="errors"></ul>
                        <form method="post" id="updateForm">
                            @method('PUT')
                            {{ csrf_field() }}
                            <input type="hidden" name="id" id="id_country">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control name-update" placeholder="Enter name" id="slug"
                                        onkeyup="ChangeToSlug()" name="name">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control slug-update" placeholder="Enter slug"
                                            name="slug" id="convert_slug">
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="update-submit">Update</button>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('foot')
    <script type="text/javascript">
        //get list countries
        // function getData(page) {
        //     $.ajax({
        //         type: "GET",
        //         url: page > 1 ? "http://127.0.0.1:8000/admin/all_countries" + "?page=" + page :
        //             "http://127.0.0.1:8000/admin/all_countries",
        //         dataType: "JSON",
        //         success: function(res) {
        //             $('tbody').html("");
        //             $.each(res.data, function(index, country) {
        //                 $('tbody').append('<tr id="' + country.id + '">' +
        //                     '<th data-target="name_category">' +
        //                     '<span class="name mb-0 text-sm">' + country.name + '</span>' +
        //                     '</th>' +
        //                     '<td class="budget"' + country.slug +
        //                     '</td>' +
        //                     '<td>' +
        //                     '<span class="badge badge-dot mr-4">' +
        //                     '<span class="status">' + moment(country.created_at).format(
        //                         "DD-MM-YYYY") + '</span>' +
        //                     '</span>' +
        //                     '</td>' +
        //                     '<td class="text-right">' +
        //                     '<div class="dropdown">' +
        //                     '<a class="btn btn-sm btn-icon-only text-light" role="button"' +
        //                     'data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
        //                     '<i class="fas fa-ellipsis-v"></i>' +
        //                     '</a>' +
        //                     '<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">' +
        //                     '<a class="dropdown-item btn-update" data-toggle="modal" data-target="#updateModal" data-id="' +
        //                     country.id +
        //                     '" style="outline: none; cursor: pointer" data-role="update">Edit</a>' +
        //                     '<button onclick="DeleteRow(' +
        //                     `'${country.id}'` + ', ' +
        //                     `'http://127.0.0.1:8000/admin/countries/${country.id}'` +
        //                     ')" class="dropdown-item" style="outline: none; cursor: pointer" id="btn-delete" data-id="' +
        //                     res.meta.current_page + '">Delete</button>' +
        //                     '</div>' +
        //                     '</div>' +
        //                     '</td>' +
        //                     '</tr>');
        //             });
        //         }
        //     });
        // }

        //add countries
        $(document).ready(function() {
            $('body').on('submit', '#CreateCountry', function(e) {
                e.preventDefault();
                var name = $('input[name=name]').val();
                var slug = $('input[name=slug]').val();

                $("#btn-save").html('Please Wait...');
                $("#btn-save").attr("disabled", true);

                $.ajax({
                    type: "POST",
                    url: "{{ route('countries.store') }}",
                    data: {
                        name: name,
                        slug: slug,
                    },
                    dataType: 'json',
                    success: function(data) {
                        Swal.fire(
                            'Successfully!',
                            data.message,
                            'success'
                        )
                        $('#CreateCountry')[0].reset();
                        $('.table').load(location.href + ' .table');
                        setTimeout(() => {
                            $('#eModal').modal('hide');
                        }, 1000);
                        $("#btn-save").html('Save');
                        $("#btn-save").attr("disabled", false);

                    },
                    error: function(jqXHR) {
                        $('.errors').html("");
                        $('.errors').addClass('alert alert-danger');
                        $.each(jqXHR.responseJSON.errors, function(index, error) {
                            $('.errors').append('<li>' + error + '</li>');
                        });
                        $("#btn-save").html('Save');
                        $("#btn-save").attr("disabled", false);
                    }
                });
            });
        });


        //get data edit countries
        $(document).on('click', '.btn-update', function(e) {
            e.preventDefault();
            var id = $(this).attr("data-id");
            $('.errors').html('');
            $('.errors').removeClass('alert alert-danger');
            $.ajax({
                type: "GET",
                url: 'countries/' + id + '/edit',
                success: function(response) {
                    $('.name-update').val(response.country.name);
                    $('.slug-update').val(response.country.slug);
                    $('#id_country').val(response.country.id);
                }
            });
        });

        //update countries
        $(document).on('submit', '#updateForm', function(e) {
            e.preventDefault();
            var id = $('#id_country').val();
            var name = $('.name-update').val();
            var slug = $('.slug-update').val();

            $("#update-submit").html('Please Wait...');
            $("#update-submit").attr("disabled", true);

            $.ajax({
                type: "PUT",
                url: "countries/" + id,
                data: {
                    name: name,
                    slug: slug,
                },
                dataType: "JSON",
                success: function(response) {
                    Swal.fire(
                        'Successfully!',
                        response.message,
                        'success'
                    )
                    $('.table').load(location.href + ' .table');
                    setTimeout(() => {
                        $('#updateModal').modal('hide');
                    }, 1000);
                    $("#update-submit").html('Save');
                    $("#update-submit").attr("disabled", false);
                },
                error: function(jqXHR) {
                    $('.errors').html("");
                    $('.errors').addClass('alert alert-danger');
                    $.each(jqXHR.responseJSON.errors, function(index, error) {
                        $('.errors').append('<li>' + error + '</li>');
                    });
                    $("#update-submit").html('Update');
                    $("#update-submit").attr("disabled", false);
                }

            });
        });
    </script>
@endsection
