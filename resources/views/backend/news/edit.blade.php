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
                <li class="breadcrumb-item"><a href="{{ route('backend.news.index') }}" class="text-decoration-none">News</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit News</li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0">Edit News</h1>
        </div>
    </div>

    <!-- Edit News Form -->
    <div class="shadow-sm rounded bg-white p-3 mt-4">
        <form action="{{ route('backend.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <!-- Mobile -->
                <div class="col-12">
                    <label for="mobile_id" class="form-label">Related Mobile</label>
                    <select name="mobile_id" id="mobile_id" class="form-select @error('mobile_id') is-invalid @enderror" required>
                        <option value="">Select Mobile</option>
                        @foreach($mobiles as $mobile)
                            <option value="{{ $mobile->id }}" {{ old('mobile_id', $news->mobile_id) == $mobile->id ? 'selected' : '' }}>{{ $mobile->name }}</option>
                        @endforeach
                    </select>
                    @error('mobile_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Title -->
                <div class="col-12">
                    <label for="title" class="form-label">News Title</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $news->title) }}" placeholder="Enter news title" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Image -->
                <div class="col-12">
                    <label for="image" class="form-label">Image</label>
                    @if($news->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $news->image) }}" alt="News Image" class="img-thumbnail" style="max-width: 150px;">
                        </div>
                    @endif
                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Body -->
                <div class="col-12">
                    @include('backend.layout.ckeditor', ['name' => 'body', 'label' => 'Content', 'value' => old('body', $news->body)])
                </div>

                <!-- SEO -->
                <div class="col-12">
                    <label for="seo_title" class="form-label">SEO Title</label>
                    <input type="text" name="seo_title" id="seo_title" class="form-control @error('seo_title') is-invalid @enderror" value="{{ old('seo_title', $news->seo_title) }}" placeholder="Enter SEO Title">
                    @error('seo_title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="seo_keywords" class="form-label">SEO Keywords</label>
                    <input type="text" name="seo_keywords" id="seo_keywords" class="form-control @error('seo_keywords') is-invalid @enderror" value="{{ old('seo_keywords', $news->seo_keywords) }}" placeholder="Enter SEO Keywords">
                    @error('seo_keywords')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="seo_description" class="form-label">SEO Description</label>
                    <textarea name="seo_description" id="seo_description" rows="2" class="form-control @error('seo_description') is-invalid @enderror">{{ old('seo_description', $news->seo_description) }}</textarea>
                    @error('seo_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Status -->
                <div class="col-12">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="draft" {{ old('status', $news->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status', $news->status) == 'published' ? 'selected' : '' }}>Published</option>
                        <option value="archived" {{ old('status', $news->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <!-- Submit Button -->
                <div class="col-12 mt-3">
                    <button class="btn btn-primary">Update News</button>
                </div>
            </div>
        </form>
    </div>
@endsection
