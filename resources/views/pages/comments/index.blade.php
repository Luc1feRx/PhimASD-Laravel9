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
                        <h3 class="mb-0">Comments</h3>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">action</th>
                                    <th scope="col" class="sort" data-sort="name">User</th>
                                    <th scope="col" class="sort" data-sort="name">Movie</th>
                                    <th scope="col" class="sort" data-sort="name">Content</th>
                                    <th scope="col" class="sort" data-sort="name">Create_At</th>
                                    <th scope="col" class="sort" data-sort="name">Approve</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @if (!$comments->count())
                                    No Data!!!!
                                @else
                                    @foreach ($comments as $item)
                                        <tr id="{{ $item->id }}">
                                            <td>
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#"
                                                        role="button" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    {{-- <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <button
                                                            onclick="DeleteRow({{ $item->id }}, `{{ route('actors.destroy', ['actor' => $item->id]) }}`)"
                                                            class="dropdown-item" id="btn-delete" data-id="1"
                                                            style="outline: none; cursor: pointer">Delete</button>
                                                    </div> --}}
                                                </div>
                                            </td>
                                            <td>
                                                <span class="name mb-0 text-sm">{{ $item->user->name }}</span>
                                            </td>
                                            <td>
                                                <span class="name mb-0 text-sm">{{ $item->movie->name }}</span>
                                            </td>
                                            <td>
                                                <span class="name mb-0 text-sm">{{ $item->content }}</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-dot mr-4">
                                                    <span class="status">{{ $item->created_at }}</span>
                                                </span>
                                            </td>

                                            <td>
                                                @if ($item->state == 0)
                                                    <div class="col-sm-2">
                                                        <form action="{{ route('ChangeStateToApprove', ['id'=>$item->id]) }}" method="post">
                                                            {{ csrf_field() }}
                                                            <button class="btn btn-success">
                                                                Approve
                                                            </button>
                                                        </form>
                                                    </div>
                                                @else
                                                    <div class="col-sm-2">
                                                        <form action="{{ route('ChangeStateToRefuse', ['id'=>$item->id]) }}" method="post">
                                                            {{ csrf_field() }}
                                                            <button class="btn btn-warning">
                                                                Refuse
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
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

                            </div>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
