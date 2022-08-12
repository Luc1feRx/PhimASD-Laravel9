@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt-5">
        <div class="container">

            <div class="container-fluid d-flex align-items-center justify-content-center">
                <div class="col-lg-7 d-flex justify-content-center mb-3">
                    <h3 class="display-4 text-black">Add Categories</h3>
                </div>
            </div>

            @include('pages.errors.errors')
            @include('pages.status.status')

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

                        <div class="form-group d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Add New Category</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
