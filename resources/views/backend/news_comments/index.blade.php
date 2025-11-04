@extends('backend.layout.app')

@if(!empty($title))
    @section('title', $title)
@endif

@section('content')
    <!-- Page Header -->
    <div class="mb-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">News Comments</li>
            </ol>
        </nav>
        <div class="row d-flex justify-content-between align-items-center">
            <div class="col-md-9">
                <h1 class="h3 mb-0">News Comments</h1>
            </div>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="shadow-lg rounded bg-white p-3 mt-4">
        <form method="GET" action="{{ route('backend.news_comments.index') }}">
            <h5>Filters</h5>

            <div class="row g-3 align-items-end">
                <!-- News -->
                <div class="col-md-3">
                    <select name="news_id" class="form-select">
                        <option value="">All News</option>
                        @foreach($news as $item)
                            <option value="{{ $item->id }}" {{ request('news_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Users -->
                <div class="col-md-3">
                    <label for="user_id" class="form-label">User</label>
                    <select name="user_id" id="user_id" class="form-select">
                        <option value="">All Users</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Stars -->
                <div class="col-md-2">
                    <select name="stars" class="form-select">
                        <option value="">All Ratings</option>
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ request('stars') == $i ? 'selected' : '' }}>{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                        @endfor
                    </select>
                </div>

                <!-- Status -->
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">All Statuses</option>
                        <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <!-- Search & Reset Buttons -->
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
                <div class="col-md-1">
                    <a href="{{ route('backend.news_comments.index') }}" class="btn btn-secondary w-100">Reset</a>
                </div>

            </div>
        </form>
    </div>

    <!-- News Comments Table -->
    <div class="shadow-lg rounded bg-white p-3 mt-4">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="d-none d-lg-table-cell">News</th>
                        <th class="d-none d-lg-table-cell">User</th>
                        <th>Comment</th>
                        <th class="d-none d-lg-table-cell">Stars</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($comments as $comment)
                        <tr>
                            <td>{{ \Illuminate\Support\Str::limit($comment->news->title, 30) }}</td>
                            <td class="d-none d-lg-table-cell">{{ $comment->user->name }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($comment->comment, 30) }}</td>
                            <td class="d-none d-lg-table-cell">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $comment->stars)
                                        <i class="bi bi-star-fill text-warning"></i>
                                    @else
                                        <i class="bi bi-star text-muted"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>
                                @if($comment->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end align-items-center gap-2">
                                    <a href="{{ route('backend.news_comments.show', $comment->id) }}" class="text-secondary" title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <form action="{{ route('backend.news_comments.destroy', $comment->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-link p-0 text-danger btn-delete" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No news comment found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $comments->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.btn-delete');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const form = this.closest('form');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This will delete the comment permanently!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
