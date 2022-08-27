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
                        <h3 class="mb-0">Movies</h3>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#eModal">Add Movie</button>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">Image</th>
                                    <th scope="col" class="sort" data-sort="name">Name</th>
                                    <th scope="col" class="sort" data-sort="name">Eng title</th>
                                    <th scope="col" class="sort" data-sort="budget">Slug</th>
                                    <th scope="col" class="sort" data-sort="budget">Resolution</th>
                                    <th scope="col" class="sort" data-sort="budget">Duration</th>
                                    <th scope="col" class="sort" data-sort="budget">Seasons</th>
                                    <th scope="col" class="sort" data-sort="budget">Trailer</th>
                                    <th scope="col" class="sort" data-sort="budget">Categories</th>
                                    <th scope="col" class="sort" data-sort="budget">Genres</th>
                                    <th scope="col" class="sort" data-sort="budget">Country</th>
                                    <th scope="col" class="sort" data-sort="budget">Years</th>
                                    <th scope="col" class="sort" data-sort="budget">Subtitle</th>
                                    <th scope="col" class="sort" data-sort="budget">Status</th>
                                    <th scope="col" class="sort" data-sort="status">Create At</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach ($movies as $item)
                                    <tr id="{{ $item->id }}">
                                        <td class="budget">
                                            <img src="{{ asset('storage/uploads/movies/' . $item->image) }}" width="200px"
                                                height="250px" alt="" srcset="">
                                        </td>
                                        <th>
                                            <span class="name mb-0 text-sm">{{ $item->name }}</span>
                                        </th>
                                        <th>
                                            <span class="name mb-0 text-sm">{{ $item->name_eng }}</span>
                                        </th>
                                        <td class="budget">
                                            {{ $item->slug }}
                                        </td>
                                        <td class="budget">
                                            @if ($item->resolution == 0)
                                                CAM
                                            @elseif($item->resolution == 1)
                                                FullHD
                                            @elseif($item->resolution == 2)
                                                HDRip
                                            @elseif($item->resolution == 3)
                                                HD
                                            @endif
                                        </td>
                                        <td class="budget">
                                            {{ $item->duration }}
                                        </td>
                                        <td class="budget">
                                            <select class="form-control season-select" id="exampleFormControlSelect1" data-id="{{ $item->id }}" style="width: 70px">
                                                <option {{$item->season == 0 ? 'selected' : ''}} value="1">0</option>
                                                <option {{$item->season == 1 ? 'selected' : ''}} value="1">1</option>
                                                <option {{$item->season == 2 ? 'selected' : ''}} value="2">2</option>
                                                <option {{$item->season == 3 ? 'selected' : ''}} value="3">3</option>
                                                <option {{$item->season == 4 ? 'selected' : ''}} value="4">4</option>
                                                <option {{$item->season == 5 ? 'selected' : ''}} value="5">5</option>
                                                <option {{$item->season == 6 ? 'selected' : ''}} value="6">6</option>
                                                <option {{$item->season == 7 ? 'selected' : ''}} value="7">7</option>
                                                <option {{$item->season == 8 ? 'selected' : ''}} value="8">8</option>
                                                <option {{$item->season == 9 ? 'selected' : ''}} value="9">9</option>
                                                <option {{$item->season == 10 ? 'selected' : ''}} value="10">10</option>
                                                <option {{$item->season == 11 ? 'selected' : ''}} value="11">11</option>
                                                <option {{$item->season == 12 ? 'selected' : ''}} value="12">12</option>
                                                <option {{$item->season == 13 ? 'selected' : ''}} value="13">13</option>
                                                <option {{$item->season == 14 ? 'selected' : ''}} value="14">14</option>
                                                <option {{$item->season == 15 ? 'selected' : ''}} value="15">15</option>
                                                <option {{$item->season == 16 ? 'selected' : ''}} value="16">16</option>
                                                <option {{$item->season == 17 ? 'selected' : ''}} value="17">17</option>
                                                <option {{$item->season == 18 ? 'selected' : ''}} value="18">18</option>
                                                <option {{$item->season == 19 ? 'selected' : ''}} value="19">19</option>
                                                <option {{$item->season == 20 ? 'selected' : ''}} value="20">20</option>
                                            </select>                                           
                                        </td>
                                        <td class="budget">
                                            <iframe width="560" height="315" src="https://www.youtube.com/embed/{{$item->trailer}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        </td>
                                        <td class="budget">
                                            {{ $item->category->name }}
                                        </td>
                                        <td class="budget">
                                            @foreach ($item->movie_genre as $g)
                                                {{ $g->name }}
                                            @endforeach
                                        </td>
                                        <td class="budget">
                                            {{ $item->country->name }}
                                        </td>
                                        <td class="budget">
                                            <input type="text" class="form-control datepicker1" readonly name="year_change_quick" data-id="{{$item->id}}" style="width: 60px;" value="{{ $item->year_release }}" />
                                        </td>
                                        <td class="budget">
                                            @if ($item->subtitle == 1)
                                               Phụ đề
                                            @else
                                                Thuyết minh
                                            @endif
                                        </td>
                                        <td class="budget">
                                            @if ($item->status == 1)
                                                Hiển Thị
                                            @else
                                                Ẩn
                                            @endif
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
                                                        onclick="DeleteRow({{ $item->id }}, `{{ route('movies.destroy', ['movie' => $item->id]) }}`)"
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
                                {!! $movies->links() !!}
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
{{-- create a movie --}}
        <div class="modal fade eModal" id="eModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create a movie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <ul class="errors"></ul>
                    <form method="post" id="CreateMovie" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Name</label>
                                    <input type="text" class="form-control" placeholder="Enter name"
                                        id="slug" onkeyup="ChangeToSlug()" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Name Eng</label>
                                    <input type="text" class="form-control" placeholder="Enter name eng"
                                        id="name_eng" name="name_eng">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Duration</label>
                                    <input type="text" class="form-control" placeholder="Enter duration of movie" name="duration">
                                </div>
                                <div class="form-group">
                                    <textarea name="description" id="description" class="form-control" id="" cols="30" rows="10"></textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Genres</label>
                                        @foreach ($genres as $genre)
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="genres[]" id="{{$genre->id}}" value="{{$genre->id}}">
                                            <label class="custom-control-label" for="{{$genre->id}}">{{$genre->name}}</label>
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
                                    <label for="exampleFormControlSelect1">Trailer</label>
                                    <input type="text" class="form-control" placeholder="Enter trailer of movie" name="trailer">
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Slug</label>
                                    <input type="text" class="form-control" placeholder="Enter slug"
                                        name="slug" id="convert_slug">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Year Release</label>
                                    <input type="text" class="form-control datepicker2" readonly name="year_release" style="width: 60px;" />
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Categories</label>
                                    <select name="categories" class="form-control" id="categoriesSelect">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                        id="customFileLang" lang="en">
                                    <label class="custom-file-label" for="customFileLang">Select file</label>
                                </div>

                                <div class="form-group">
                                    <img id="preview-image" width="300px">
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
                                        <input type="text" class="form-control name_eng-update" placeholder="Enter name_eng eng"
                                            id="name_eng" name="name_eng">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Description</label>
                                        <textarea name="description" id="description_update" class="form-control" cols="30"
                                            rows="10"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Trailer</label>
                                        <input type="text" class="form-control trailer_update" placeholder="Enter trailer of movie" name="trailer">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Year Release</label>
                                        <input type="text" class="form-control datepicker3" readonly name="year_release" style="width: 60px;" />
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Duration</label>
                                        <input type="text" class="form-control duration-update" placeholder="Enter duration of movie" name="duration">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Genres</label>
                                            @foreach ($genres as $genre)
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input genres-update" name="genres[]" id="{{$genre->id}}-{{$genre->name}}" value="{{$genre->id}}">
                                                <label class="custom-control-label" for="{{$genre->id}}-{{$genre->name}}">{{$genre->name}}</label>
                                            </div>
                                            @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Categories</label>
                                        <select name="categories" class="form-control category_id" id="categoriesSelect">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
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
        </div>
    </div>
@endsection

@section('foot')
    <script type="text/javascript">
        //preview-image-add
        $(document).ready(function() {
            var image = null;
            $('#customFileLang').change(function() {
                let reader = new FileReader();

                reader.onload = (e) => {
                    $('#preview-image').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);
                console.log(this.files[0].name);
            });

        });
        //preview-image-update
        $(document).ready(function() {
            var image = null;
            $('#customFileUpdate').change(function() {
                let reader = new FileReader();

                reader.onload = (e) => {
                    $('#preview-image-update').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);
                console.log(this.files[0].name);
            });

        });


        //change season of movie
        $('.season-select').change(function() {
            var selectSeason = $(this).children("option:selected").val();
            var id = $(this).attr("data-id");

            $.ajax({
                type: "POST",
                url: "{{ route('movies.UpdateSeason') }}",
                data: {season: selectSeason, id: id},
                dataType: "json",
                cache: false,
                success: function (response) {
                    Swal.fire(
                            'Successfully!',
                            response.message,
                            'success'
                        )
                }
            });
        });

        //add movie
        $(document).ready(function() {
            $('#CreateMovie').submit(function(e) {
                e.preventDefault();
                $('.errors').html('');
                $('.errors').removeClass('alert alert-danger');
                // var value = [];
                // var arr = $('.ads_Checkbox:checked').map(function(){
                //     value.push(this.value)
                // }).get();
                $("#btn-save").html('Please Wait...');
                $("#btn-save").attr("disabled", true);
                var form = this;
                $.ajax({
                    type: "POST",
                    url: "{{ route('movies.store') }}",
                    data: new FormData(form),
                    processData: false,
                    dataType: "json",
                    cache: false,
                    contentType: false,
                    success: function(data) {
                        Swal.fire(
                            'Successfully!',
                            data.message,
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

        //get genres
        $(document).on('click', '.btn-update', function(e) {
            e.preventDefault();
            var id = $(this).attr("data-id");
            var arr = [];
            $('.errors').html('');
            $('.errors').removeClass('alert alert-danger');
            $.ajax({
                type: "GET",
                url: 'get_genres/' + id,
                success: function(response) {
                    $.each(response, function( index, value ) {
                        arr.push(JSON.parse(value.genre_id));

                        for(i=0;i<arr.length;i++){
                            $('.genres-update').each(function (index, value) {
                                $(".genres-update").prop("checked", $(this).val()==arr[i]);
                            });
                        }
                    });
                }
            });
        });


        //get data edit movie
        $(document).on('click', '.btn-update', function(e) {
            e.preventDefault();
            var id = $(this).attr("data-id");
            $('.errors').html('');
            $('.errors').removeClass('alert alert-danger');
            $.ajax({
                type: "GET",
                url: 'movies/' + id + '/edit',
                success: function(response) {
                    $('.name-update').val(response.movie.name);
                    $('.slug-update').val(response.movie.slug);
                    $('.duration-update').val(response.movie.duration);
                    $('.trailer_update').val(response.movie.trailer);
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
                    $('#resolutionSelect option[value="' + response.movie.resolution + '"]').prop('selected',
                        true);
                    $('#subtitleSelect option[value="' + response.movie.subtitle + '"]').prop('selected',
                        true);
                    // $('.genres-update').each(function (){
                    //     $('.genres-update[name=genres[0]]').prop('checked', true);
                    // });
                    console.log(response.movie.id_genre);
                    // $('.genres-update[name=genres]').prop('checked', true);
                    $('#id_movie').val(response.movie.id);
                    $('.datepicker3').val(response.movie.year_release);
                    $("#preview-image-update").attr('src', '/storage/uploads/movies/' + response.movie.image);
                    console.log(response.movie);
                }
            });
        });
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

    </script>
@endsection
