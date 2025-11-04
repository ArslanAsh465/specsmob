@extends('backend.layout.app')

@if(!empty($title))
    @section('title', $title)
@endif

@section('content')
    <!-- Page Header -->
    <div class="mb-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.mobile_comments.index') }}" class="text-decoration-none">Comments</a></li>
                <li class="breadcrumb-item active" aria-current="page">View Comment</li>
            </ol>
        </nav>

        <div class="row d-flex justify-content-between align-items-center">
            <div class="col-md-9">
                <h1 class="h3 mb-0">Comment Details</h1>
            </div>

            <div class="col-md-3 text-end">
                <form action="{{ route('backend.mobile_comments.destroy', $comment->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-sm btn-danger" id="btn-delete">
                        <i class="bi bi-trash me-1"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Comment Details -->
    <div class="shadow-lg rounded bg-white p-3 mt-4">
        <div class="row g-3">
            <div class="col-md-6"><strong>Mobile:</strong> {{ $comment->mobile->name ?? '-' }}</div>
            <div class="col-md-6"><strong>User:</strong> {{ $comment->user->name ?? '-' }}</div>
            <div class="col-md-6"><strong>Stars:</strong> 
                @for($i = 0; $i < 5; $i++)
                    @if($i < $comment->stars)
                        <i class="bi bi-star-fill text-warning"></i>
                    @else
                        <i class="bi bi-star text-secondary"></i>
                    @endif
                @endfor
            </div>
            <div class="col-12"><strong>Comment:</strong></div>
            <div class="col-12">{!! nl2br(e($comment->comment)) !!}</div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButton = document.getElementById('btn-delete');

            deleteButton.addEventListener('click', function () {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This will permanently delete the comment!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.closest('form').submit();
                    }
                });
            });
        });
    </script>
@endsection