@extends('layouts.app')

@section('content')
    @include('layouts.headers.cardsdashboard')

    <div class="container-fluid mt--6">
        @include('pages.errors.errors')
        @include('pages.status.status')
        <div class="row append-list">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0 d-flex justify-content-between">
                        <h3 class="mb-0">Episodes</h3>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-id="{{ $movie_id }}" id="btn-episodes"
                            data-toggle="modal" data-target="#eModal">Add
                            Episode</button>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">action</th>
                                    <th scope="col" class="sort" data-sort="name">Name of movie</th>
                                    <th scope="col" class="sort" data-sort="name">Name of episode</th>
                                    <th scope="col" class="sort" data-sort="budget">Slug</th>
                                    <th scope="col" class="sort" data-sort="budget">Episodes</th>
                                    <th scope="col" class="sort" data-sort="budget">Link 1</th>
                                    <th scope="col" class="sort" data-sort="budget">Link 2</th>
                                    <th scope="col" class="sort" data-sort="budget">Link 3</th>
                                    <th scope="col" class="sort" data-sort="status">Create At</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @if (!isset($episodes))
                                    No Data!!!!
                                @else
                                    @foreach ($episodes as $item)
                                        <tr id="{{ $item->id }}">
                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#"
                                                        role="button" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <a class="dropdown-item btn-update" data-toggle="modal"
                                                            data-target="#updateModal" data-id="{{ $item->id }}"
                                                            style="outline: none; cursor: pointer"
                                                            data-id="{{ $item->id }}">Edit</a>
                                                        <button
                                                            onclick="DeleteRow({{ $item->id }}, `{{ route('movies.destroy', ['movie' => $item->id]) }}`)"
                                                            class="dropdown-item" id="btn-delete" data-id="1"
                                                            style="outline: none; cursor: pointer">Delete</button>
                                                    </div>
                                                </div>
                                            </td>
                                            <th>
                                                <span class="name mb-0 text-sm">{{ $item->name }}</span>
                                            </th>
                                            <th>
                                                <span class="name mb-0 text-sm">{{ $item->nameofep }}</span>
                                            </th>
                                            <td class="budget">
                                                {{ $item->slug }}
                                            </td>
                                            <td class="budget">
                                                {{ $item->episodes }}
                                            </td>
                                            <td class="budget">
                                                {!! $item->link1 !!}
                                            </td>
                                            <td class="budget">
                                                {!! $item->link2 !!}
                                            </td>
                                            <td class="budget">
                                                {!! $item->link3 !!}
                                            </td>
                                            <td>
                                                <span class="badge badge-dot mr-4">
                                                    <span class="status">{{ $item->created_at }}</span>
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- Card footer -->
                    <div class="card-footer py-4">
                        <nav aria-label="...">
                            <div class="pagination justify-content-end mb-0">
                                {!! $episodes->links() !!}
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        {{-- create a episode --}}
        <div class="modal fade eModal" id="eModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create a Episode</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <ul class="errors"></ul>
                        <form method="post" id="CreateEpisode">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="hidden" class="form-control" name="movie_id" value="{{ $movie_id }}">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Name of Episode</label>
                                        <input type="text" class="form-control" placeholder="Enter name" id="slug"
                                            onkeyup="ChangeToSlug()" name="nameofep">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Slug</label>
                                        <input type="text" class="form-control" placeholder="Enter slug"
                                            name="slug" id="convert_slug">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Link 1 (ggdrive)</label>
                                        <input type="text" class="form-control" placeholder="Enter link"
                                            name="link1">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Link 2 (Hydrax)</label>
                                        <input type="text" class="form-control" placeholder="Enter link"
                                            name="link2" value='<p><iframe allowfullscreen frameborder="0" height="360px" src="https://short.ink/" width="660px"></iframe></p>'>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Link 3</label>
                                        <input type="text" class="form-control" placeholder="Enter link"
                                            name="link3"
                                            value='<div class="flowplayer" style="width:560px;height:350px"><video controls><source type="video/mp4" src=""></video></div>'>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Episodes</label>
                                        <select name="episodes" class="form-control" id="EpisodesSelect">

                                        </select>
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


        {{-- update a episode --}}
        <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Updating movie</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul class="errors-update"></ul>
                        <form method="post" id="updateForm" enctype="multipart/form-data">
                            @method('PUT')
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="hidden" class="form-control" name="movie_id" value="{{ $movie_id }}">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Name of Episode</label>
                                        <input type="text" class="form-control nameofepisode" placeholder="Enter name" id="slug"
                                            onkeyup="ChangeToSlug()" name="nameofep">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Slug</label>
                                        <input type="text" class="form-control slug" placeholder="Enter slug"
                                            name="slug" id="convert_slug">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Link 1 (ggdrive)</label>
                                        <input type="text" class="form-control" placeholder="Enter link"
                                            name="link1"
                                            value='<p><iframe allowfullscreen frameborder="0" height="360px" src="" width="660px"></iframe></p>'>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Link 2 (OK.ru)</label>
                                        <input type="text" class="form-control" placeholder="Enter link"
                                            name="link2">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Link 3 (Hydrax)</label>
                                        <input type="text" class="form-control" placeholder="Enter link"
                                            name="link3"
                                            value='<p><iframe allowfullscreen frameborder="0" height="360px" src="https://short.ink/" width="660px"></iframe></p>'>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Episodes</label>
                                        <select name="episodes" class="form-control episodes" id="EpisodesSelect">

                                        </select>
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



        <!-- Update Modal -->
        {{-- <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Updating movie</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul class="errors-update"></ul>
                        <form method="post" id="updateForm" enctype="multipart/form-data">
                            @method('PUT')
                            {{ csrf_field() }}
                            <input type="hidden" name="id" id="id_movie">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Name</label>
                                        <input type="text" class="form-control name-update" placeholder="Enter name"
                                            name="name" id="slug" onkeyup="ChangeToSlug()">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Slug</label>
                                        <input type="text" class="form-control slug-update" placeholder="Enter slug"
                                            name="slug" id="convert_slug">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Name Eng</label>
                                        <input type="text" class="form-control name_eng-update"
                                            placeholder="Enter name_eng eng" id="name_eng" name="name_eng">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Description</label>
                                        <textarea name="description" id="description_update" class="form-control" cols="30" rows="10"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Episodes</label>
                                        <input type="text" class="form-control episodes-update" placeholder="Enter number of episodes"
                                            name="episodes">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Trailer</label>
                                        <input type="text" class="form-control trailer_update"
                                            placeholder="Enter trailer of movie" name="trailer">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Year Release</label>
                                        <input type="text" class="form-control datepicker3" readonly
                                            name="year_release" style="width: 60px;" />
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Duration</label>
                                        <input type="text" class="form-control duration-update"
                                            placeholder="Enter duration of movie" name="duration">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Genres</label>
                                        @foreach ($genres as $genre)
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input genres-update"
                                                    name="genres[]" id="{{ $genre->id }}-{{ $genre->name }}"
                                                    value="{{ $genre->id }}">
                                                <label class="custom-control-label"
                                                    for="{{ $genre->id }}-{{ $genre->name }}">{{ $genre->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Categories</label>
                                        @foreach ($categories as $category)
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input genres-update"
                                                    name="categories[]" id="{{ $category->id }}-{{ $category->name }}"
                                                    value="{{ $category->id }}">
                                                <label class="custom-control-label"
                                                    for="{{ $category->id }}-{{ $category->name }}">{{ $category->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Country</label>
                                        <select name="country" class="form-control" id="countrySelect">
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Resolution</label>
                                        <select name="resolution" class="form-control" id="resolutionSelect">
                                            <option value="1">FullHD</option>
                                            <option value="0">CAM</option>
                                            <option value="2">HDRip</option>
                                            <option value="3">HD</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Subtitle</label>
                                        <select name="subtitle" class="form-control" id="subtitleSelect">
                                            <option value="1">Phụ đề</option>
                                            <option value="0">Thuyết minh</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Status</label>
                                        <select name="status" class="form-control" id="statusSelect">
                                            <option value="1">Hiển Thị</option>
                                            <option value="0">Ẩn</option>
                                        </select>
                                    </div>

                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="image"
                                            id="customFileUpdate" lang="en">
                                        <label class="custom-file-label" for="customFileLang">Select file</label>
                                    </div>

                                    <div class="form-group">
                                        <img id="preview-image-update" width="300px">
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
        </div> --}}

    </div>
@endsection

@section('foot')
    <script type="text/javascript">
        $(document).ready(function() {

            $('#btn-episodes').click(function() {
                var id = $(this).attr('data-id');
                $.ajax({
                    type: "GET",
                    url: "{{ route('episodes.SelectEpisodes') }}",
                    data: {
                        id_phim: id
                    },
                    success: function(data) {
                        $('#EpisodesSelect').html(data);
                        $('.episodes').html(data);
                    }
                });
            });

        });

        //add new episodes
        $(document).ready(function() {
            $('#CreateEpisode').submit(function(e) {
                e.preventDefault();
                $('.errors').html('');
                $('.errors').removeClass('alert alert-danger');
                $("#btn-save").html('Please Wait...');
                $("#btn-save").attr("disabled", true);
                var form = this;
                $.ajax({
                    type: "POST",
                    url: "{{ route('episodes.store') }}",
                    data: new FormData(form),
                    processData: false,
                    dataType: "json",
                    cache: false,
                    contentType: false,
                    success: function(response) {
                        Swal.fire(
                            'Successfully!',
                            response.message,
                            'success'
                        )
                        $('.table').load(location.href + ' .table-flush');
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

        //get data edit episodes
        $(document).on('click', '.btn-update', function(e) {
            e.preventDefault();
            var id = $(this).attr("data-id");
            $('.errors').html('');
            $('.errors').removeClass('alert alert-danger');
            $.ajax({
                type: "GET",
                url: 'episodes/' + id + '/edit',
                success: function(response) {
                    $('.name-update').val(response.movie.name);
                    $('.slug-update').val(response.movie.slug);
                    $('.duration-update').val(response.movie.duration);
                    $('.trailer_update').val(response.movie.trailer);
                    $('.episodes-update').val(response.movie.episodes);
                    $('.name_eng-update').val(response.movie.name_eng);
                    $('#description_update').val(YourEditor.data.set(response.movie.description));
                    $('#categoriesSelect option[value="' + response.movie.id_category + '"]').prop(
                        'selected', true);
                    $('#genresSelect option[value="' + response.movie.id_genre + '"]').prop('selected',
                        true);
                    $('#countrySelect option[value="' + response.movie.id_country + '"]').prop(
                        'selected', true);
                    $('#statusSelect option[value="' + response.movie.status + '"]').prop('selected',
                        true);
                    $('#resolutionSelect option[value="' + response.movie.resolution + '"]').prop(
                        'selected',
                        true);
                    $('#subtitleSelect option[value="' + response.movie.subtitle + '"]').prop(
                        'selected',
                        true);
                    // $('.genres-update').each(function (){
                    //     $('.genres-update[name=genres[0]]').prop('checked', true);
                    // });
                    // $('.genres-update[name=genres]').prop('checked', true);
                    $('#id_movie').val(response.movie.id);
                    $('.datepicker3').val(response.movie.year_release);
                    $("#preview-image-update").attr('src', '/storage/uploads/movies/' + response.movie
                        .image);
                    console.log(response.movie);
                }
            });
        });
    </script>

    {{-- <script type="text/javascript">
        //update movie
        $(document).ready(function() {
            $('#updateForm').submit(function(e) {
                e.preventDefault();
                $('.errors-update').html('');
                $('.errors-update').removeClass('alert alert-danger');

                $("#update-submit").html('Please Wait...');
                $("#update-submit").attr("disabled", true);
                var id = $("#id_movie").val();
                var form_update = this;

                $.ajax({
                    type: "POST",
                    url: "movies/" + id,
                    data: new FormData(form_update),
                    processData: false,
                    dataType: "json",
                    contentType: false,
                    success: function(response) {
                        Swal.fire(
                            'Successfully!',
                            response.message,
                            'success'
                        )
                        $('.table').load(location.href + ' .table-flush');
                        setTimeout(() => {
                            $('#updateModal').modal('hide');
                        }, 1000);
                        $("#update-submit").html('Save');
                        $("#update-submit").attr("disabled", false);
                    },
                    error: function(jqXHR) {
                        $('.errors-update').html("");
                        $('.errors-update').addClass('alert alert-danger');
                        $.each(jqXHR.responseJSON.errors, function(index, error) {
                            $('.errors-update').append('<li>' + error + '</li>');
                        });
                        $("#update-submit").html('Update');
                        $("#update-submit").attr("disabled", false);
                    }

                });
            });
        });
    </script> --}}
@endsection
