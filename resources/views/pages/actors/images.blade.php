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
                            <a style="color: aliceblue" class="btn btn-primary"
                            href="{{ route('actors.index') }}">Quay về</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            @foreach ($images as $item)
                            <div class="col-lg-4">
                                <img src="{{ \Storage::disk('s3')->temporaryURL('uploads/actors/'.$item->images, now()->addMinutes(30)) }}"
                                width="200px" height="230px" class="p-1" alt="" srcset="">
                            </div>
                            <br/>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
