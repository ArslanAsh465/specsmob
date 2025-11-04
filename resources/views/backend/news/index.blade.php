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
                <li class="breadcrumb-item active" aria-current="page">News</li>
            </ol>
        </nav>
        <div class="row d-flex justify-content-between align-items-center">
            <div class="col-md-9">
                <h1 class="h3 mb-0">News</h1>
            </div>

            <div class="col-md-3 text-end">
                <a href="{{ route('backend.news.create') }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus-circle me-1"></i> Add News
                </a>
            </div>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="shadow-sm rounded bg-white p-3 mt-4">
        <form method="GET" action="{{ route('backend.news.index') }}">
            <h5>Filters</h5>

            <div class="row g-3 align-items-end">
                <!-- Mobile Filter -->
                <div class="col-md-3">
                    <label for="mobile_id" class="form-label">Mobile</label>
                    <select name="mobile_id" id="mobile_id" class="form-select">
                        <option value="">All Mobiles</option>
                        @foreach($mobiles as $mobile)
                            <option value="{{ $mobile->id }}" {{ request('mobile_id') == $mobile->id ? 'selected' : '' }}>
                                {{ $mobile->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- User Filter -->
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

                <!-- Status Filter -->
                <div class="col-md-2">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="">All</option>
                        <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
                        <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>Archived</option>
                    </select>
                </div>

                <!-- Action Buttons -->
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('backend.news.index') }}" class="btn btn-secondary w-100">Reset</a>
                </div>

            </div>
        </form>
    </div>

    <!-- News Table -->
    <div class="shadow-sm rounded bg-white p-3 mt-4">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th class="d-none d-lg-table-cell">Mobile</th>
                        <th class="d-none d-lg-table-cell">Author</th>
                        <th class="d-none d-lg-table-cell">Views</th>
                        <th class="d-none d-lg-table-cell">Comments</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($news as $item)
                        <tr>
                            <td>{{ $item->title }}</td>
                            <td class="d-none d-lg-table-cell">{{ $item->mobile->name ?? '-' }}</td>
                            <td class="d-none d-lg-table-cell">{{ $item->user->name ?? '-' }}</td>
                            <td class="d-none d-lg-table-cell">{{ $item->views ?? 0 }}</td>
                            <td class="d-none d-lg-table-cell">{{ $item->comments->count() }}</td>
                            <td>
                                @if($item->status === 'published')
                                    <span class="badge bg-success">Published</span>
                                @elseif($item->status === 'draft')
                                    <span class="badge bg-warning">Draft</span>
                                @else
                                    <span class="badge bg-secondary">Archived</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end align-items-center gap-2">
                                    <a href="{{ route('backend.news.show', $item->id) }}" class="text-secondary" title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a href="{{ route('backend.news.edit', $item->id) }}" class="text-primary" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form action="{{ route('backend.news.destroy', $item->id) }}" method="POST" class="d-inline">
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
                            <td colspan="7" class="text-center">No news found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $news->links('pagination::bootstrap-5') }}
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
                        text: "If you delete this news, all its comments will also be deleted!",
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
