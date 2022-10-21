@extends('layouts.app')

@section('content')
    @include('layouts.headers.cardsdashboard')

    <div class="container-fluid mt--6">
        @include('pages.errors.errors')
        @include('pages.status.status')
        <div class="col-xl-12 order-xl-1">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Create an actor</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('actors.store') }}" enctype="multipart/form-data" method="POST">
                        {{ csrf_field() }}
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="hidden" name="movie_id" value="{{$movie_id}}">
                                        <label class="form-control-label" for="input-username">Name</label>
                                        <input type="text" class="form-control"
                                        id="slug" onkeyup="ChangeToSlug()" placeholder="Enter name of actor" name="name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Slug</label>
                                        <input type="text" class="form-control" placeholder="Enter slug"
                                            name="slug" id="convert_slug">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Choose a day: </label>
                                        <div id="datepicker3" class="input-group date" data-date-format="dd-mm-yyyy"> <input class="form-control" name="dob" readonly="" type="text"> <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text" id="inputGroupFileAddon01">Cover</span>
                                            </div>
                                            <div class="custom-file">
                                              <input type="file" class="custom-file-input" 
                                              onchange="document.getElementById('cover_actor').src = window.URL.createObjectURL(this.files[0])" 
                                              id="inputGroupFile01" name="image">
                                              <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                            </div>
                                          </div>
                                          <br>
                                          <img id="cover_actor" style="width: 200px;"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label>Choose a gender: </label>
                                    <div class="form-check">
                                        <input class="form-check-input" value="1" type="radio" name="sex" id="sex" checked>
                                        <label class="form-check-label" for="sex">
                                          Male
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" value="0" type="radio" name="sex" id="sex">
                                        <label class="form-check-label" for="sex">
                                          Female
                                        </label>
                                      </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Biographic</label>
                                        <textarea name="bio" id="description" class="form-control" cols="30" rows="30"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text" id="inputGroupFileAddon01">Images</span>
                                            </div>
                                            <div class="custom-file">
                                              <input type="file" class="custom-file-input" 
                                              onchange="document.getElementById('images_actor').src = window.URL.createObjectURL(this.files[0])" 
                                              id="inputGroupFile01" name="images[]" multiple aria-describedby="inputGroupFileAddon01">
                                              <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                            </div>
                                          </div>
                                          <br>
                                          <img id="images_actor" style="width: 200px;"/>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <label class="input-group-text" for="inputGroupSelect01">Countries</label>
                                        </div>
                                        <select class="custom-select" name="country" id="inputGroupSelect01">
                                                @foreach ($countries as $country)
                                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                                @endforeach
                                        </select>
                                      </div>
                                </div>
                                <div class="col-lg-6">
                                    <button type="submit" class="btn btn-primary" id="btn-save">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('foot')
<script type="text/javascript">
    $(function () {  
    $("#datepicker3").datepicker({         
    autoclose: true,         
    todayHighlight: true 
    }).datepicker('update', new Date());
    });
;
    </script>
@endsection
