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
                        <h3 class="mb-0">Categories</h3>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#eModal">
                            Add Category
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
                                @foreach ($categories as $item)
                                    <tr>
                                        <th>
                                            <div class="media align-items-center">
                                                <span class="name mb-0 text-sm">{{ $item->name }}</span>
                                            </div>
                                        </th>
                                        <td class="budget">
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
                                                    <a class="dropdown-item"
                                                        href="{{ route('categories.edit', ['category' => $item->id]) }}">Edit</a>
                                                        <button onclick="DeleteRow({{$item->id}}, `{{ route('categories.destroy', ['category'=>$item->id]) }}`)" class="dropdown-item" id="btn-delete" style="outline: none; cursor: pointer">Delete</button>
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
                                {!! $categories->links() !!}
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
                        <h5 class="modal-title" id="exampleModalLabel">Create a category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form method="post" action="{{ route('categories.store') }}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            placeholder="Enter name" name="name">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            placeholder="Enter slug" name="slug">
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
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
                            <h5 class="modal-title" id="exampleModalLabel">Updating category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
    
                            <form method="post" action="{{ route('categories.store') }}">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                                placeholder="Enter name" name="name">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                                placeholder="Enter slug" name="slug">
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
    
                        </form>
                    </div>
                </div>
            </div>
    </div>
@endsection

@section('foot')
    <script type="text/javascript">
        $(document).on('click', '.pagination span', function(e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            getData(page);
        });


        function getData(page) {
            $.ajax({
                type: "GET",
                url: "http://127.0.0.1:8000/admin/all_categories" + "?page=" + page,
                dataType: "JSON",
                success: function(res) {
                    $('tbody').html("");
                    $.each(res.data, function(index, category) {
                        $('tbody').append('<tr>' +
                            '<th>' +
                            '<div class="media align-items-center">' +
                            '<span class="name mb-0 text-sm">' + category.name + '</span>' +
                            '</div>' +
                            '</th>' +
                            '<td class="budget">' + category.slug + '</td>' +
                            '<td>' +
                            '<span class="badge badge-dot mr-4">' +
                            '<span class="status">' + moment(category.created_at).format(
                                "DD-MM-YYYY") + '</span>' +
                            '</span>' +
                            '</td>' +
                            '<td class="text-right">' +
                            '<div class="dropdown">' +
                            '<a class="btn btn-sm btn-icon-only text-light" role="button"' +
                            'data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                            '<i class="fas fa-ellipsis-v"></i>' +
                            '</a>' +
                            '<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">' +
                            '<a class="dropdown-item"' +
                            'href="' + `categories/${category.id}/edit` + '">Edit</a>' +
                            '<button onclick="DeleteRow(' +
                            `'${category.id}'` + ', ' +
                            `'http://127.0.0.1:8000/admin/categories/${category.id}'` +
                            ')" class="dropdown-item" style="outline: none; cursor: pointer">Delete</button>' +
                            '</div>' +
                            '</div>' +
                            '</td>' +
                            '</tr>');
                    });
                }
            });
        }
    </script>
@endsection
