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
                        <h3 class="mb-0">Actors</h3>
                        <a style="color: aliceblue" class="btn btn-primary"
                            href="{{ route('actors.create', ['id' => $movie_id]) }}">Add
                            Actor</a>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">action</th>
                                    <th scope="col" class="sort" data-sort="name">View Images</th>
                                    <th scope="col" class="sort" data-sort="name">Image</th>
                                    <th scope="col" class="sort" data-sort="name">name</th>
                                    <th scope="col" class="sort" data-sort="name">DOB</th>
                                    <th scope="col" class="sort" data-sort="name">POB</th>
                                    <th scope="col" class="sort" data-sort="name">Create_At</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @if (!$actors->count())
                                    No Data!!!!
                                @else
                                    @foreach ($actors as $item)
                                        <tr id="{{ $item->id }}">
                                            <td>
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#"
                                                        role="button" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <a class="dropdown-item btn-update" href="{{ route('actors.edit', ['id'=>$item->id]) }}"
                                                            style="outline: none; cursor: pointer"
                                                            >Edit</a>
                                                        <button
                                                            onclick="DeleteRow({{ $item->id }}, `{{ route('actors.destroy', ['actor' => $item->id]) }}`)"
                                                            class="dropdown-item" id="btn-delete" data-id="1"
                                                            style="outline: none; cursor: pointer">Delete</button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <a style="color: aliceblue" class="btn btn-primary"
                                                href="{{ route('actors.viewImages', ['id' => $item->id]) }}">View Images</a>
                                            </td>
                                            <td>
                                                <img src="{{ \Storage::disk('s3')->temporaryURL('uploads/actors/'.$item->image, now()->addMinutes(10)) }}"
                                                    width="200px" height="300px" alt="" srcset="">
                                            </td>
                                            <td>
                                                <span class="name mb-0 text-sm">{{ $item->name }}</span>
                                            </td>
                                            <td>
                                                <span class="name mb-0 text-sm">{{ $item->dob }}</span>
                                            </td>
                                            <td>
                                                <span class="name mb-0 text-sm">{{ $item->country->name ?? 'none' }}</span>
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
                                {!! $actors->links() !!}
                            </div>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

