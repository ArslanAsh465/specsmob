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
                <li class="breadcrumb-item"><a href="{{ route('backend.mobiles.index') }}" class="text-decoration-none">Mobiles</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Mobile</li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0">Add Mobile</h1>
        </div>
    </div>

    <!-- Create Mobile Form -->
    <div class="mt-4 shadow rounded p-3 bg-white">
        <form action="{{ route('backend.mobiles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-3">
                <!-- Brand -->
                <div class="col-md-6">
                    <label for="brand_id" class="form-label">Brand</label>
                    <select name="brand_id" id="brand_id" class="form-select @error('brand_id') is-invalid @enderror" required>
                        <option value="">Select Brand</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                        @endforeach
                    </select>
                    @error('brand_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Name -->
                <div class="col-md-6">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Enter name" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Versions -->
                <div class="col-12">
                    <label for="versions" class="form-label">Versions</label>
                    <textarea name="versions" id="versions" rows="2" class="form-control @error('versions') is-invalid @enderror">{{ old('versions') }}</textarea>
                    @error('versions')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Image & Status -->
                <div class="col-md-6">
                    <label for="image" class="form-label">Mobile Image</label>
                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="col-12">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Network Section -->
                <div class="col-12 mt-3"><h5>Network</h5></div>
                <div class="col-md-6">
                    <label for="network_technology" class="form-label">Technology</label>
                    <input type="text" name="network_technology" id="network_technology" class="form-control @error('network_technology') is-invalid @enderror" value="{{ old('network_technology') }}">
                    @error('network_technology') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label for="network_2g_bands" class="form-label">2G Bands</label>
                    <input type="text" name="network_2g_bands" id="network_2g_bands" class="form-control @error('network_2g_bands') is-invalid @enderror" value="{{ old('network_2g_bands') }}">
                    @error('network_2g_bands') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label for="network_3g_bands" class="form-label">3G Bands</label>
                    <input type="text" name="network_3g_bands" id="network_3g_bands" class="form-control @error('network_3g_bands') is-invalid @enderror" value="{{ old('network_3g_bands') }}">
                    @error('network_3g_bands') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label for="network_4g_bands" class="form-label">4G Bands</label>
                    <input type="text" name="network_4g_bands" id="network_4g_bands" class="form-control @error('network_4g_bands') is-invalid @enderror" value="{{ old('network_4g_bands') }}">
                    @error('network_4g_bands') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label for="network_5g_bands" class="form-label">5G Bands</label>
                    <input type="text" name="network_5g_bands" id="network_5g_bands" class="form-control @error('network_5g_bands') is-invalid @enderror" value="{{ old('network_5g_bands') }}">
                    @error('network_5g_bands') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label for="network_speed" class="form-label">Speed</label>
                    <input type="text" name="network_speed" id="network_speed" class="form-control @error('network_speed') is-invalid @enderror" value="{{ old('network_speed') }}">
                    @error('network_speed') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Platform Section -->
                <div class="col-12 mt-3"><h5>Platform</h5></div>
                <div class="col-md-6">
                    <label for="os" class="form-label">Operating System</label>
                    <input type="text" name="os" id="os" class="form-control @error('os') is-invalid @enderror" value="{{ old('os') }}">
                    @error('os') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label for="chipset" class="form-label">Chipset</label>
                    <input type="text" name="chipset" id="chipset" class="form-control @error('chipset') is-invalid @enderror" value="{{ old('chipset') }}">
                    @error('chipset') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label for="cpu" class="form-label">CPU</label>
                    <input type="text" name="cpu" id="cpu" class="form-control @error('cpu') is-invalid @enderror" value="{{ old('cpu') }}">
                    @error('cpu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label for="gpu" class="form-label">GPU</label>
                    <input type="text" name="gpu" id="gpu" class="form-control @error('gpu') is-invalid @enderror" value="{{ old('gpu') }}">
                    @error('gpu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Memory Section -->
                <div class="col-12 mt-3"><h5>Memory</h5></div>
                <div class="col-md-6">
                    <label for="ram" class="form-label">RAM</label>
                    <input type="text" name="ram" id="ram" class="form-control @error('ram') is-invalid @enderror" value="{{ old('ram') }}">
                    @error('ram') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label for="storage" class="form-label">Storage</label>
                    <input type="text" name="storage" id="storage" class="form-control @error('storage') is-invalid @enderror" value="{{ old('storage') }}">
                    @error('storage') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Display Section -->
                <div class="col-12 mt-3"><h5>Display</h5></div>
                <div class="col-md-6">
                    <label for="display_type" class="form-label">Type</label>
                    <input type="text" name="display_type" id="display_type" class="form-control @error('display_type') is-invalid @enderror" value="{{ old('display_type') }}">
                    @error('display_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label for="display_size" class="form-label">Size</label>
                    <input type="text" name="display_size" id="display_size" class="form-control @error('display_size') is-invalid @enderror" value="{{ old('display_size') }}">
                    @error('display_size') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label for="display_resolution" class="form-label">Resolution</label>
                    <input type="text" name="display_resolution" id="display_resolution" class="form-control @error('display_resolution') is-invalid @enderror" value="{{ old('display_resolution') }}">
                    @error('display_resolution') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label for="display_protection" class="form-label">Protection</label>
                    <input type="text" name="display_protection" id="display_protection" class="form-control @error('display_protection') is-invalid @enderror" value="{{ old('display_protection') }}">
                    @error('display_protection') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Cameras Section -->
                <div class="col-12 mt-3"><h5>Cameras</h5></div>
                <div class="col-md-6">
                    <label for="camera_rear" class="form-label">Rear Camera</label>
                    <input type="text" name="camera_rear" id="camera_rear" class="form-control @error('camera_rear') is-invalid @enderror" value="{{ old('camera_rear') }}">
                    @error('camera_rear') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label for="camera_front" class="form-label">Front Camera</label>
                    <input type="text" name="camera_front" id="camera_front" class="form-control @error('camera_front') is-invalid @enderror" value="{{ old('camera_front') }}">
                    @error('camera_front') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Sound Section -->
                <div class="col-12 mt-3"><h5>Sound</h5></div>
                <div class="col-md-6">
                    <label for="loudspeaker" class="form-label">Loudspeaker</label>
                    <input type="text" name="loudspeaker" id="loudspeaker" class="form-control @error('loudspeaker') is-invalid @enderror" value="{{ old('loudspeaker') }}">
                    @error('loudspeaker') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label for="jack_3_5mm" class="form-label">3.5mm Jack</label>
                    <input type="text" name="jack_3_5mm" id="jack_3_5mm" class="form-control @error('jack_3_5mm') is-invalid @enderror" value="{{ old('jack_3_5mm') }}">
                    @error('jack_3_5mm') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Battery Section -->
                <div class="col-12 mt-3"><h5>Battery</h5></div>
                <div class="col-md-6">
                    <label for="battery_type" class="form-label">Type</label>
                    <input type="text" name="battery_type" id="battery_type" class="form-control @error('battery_type') is-invalid @enderror" value="{{ old('battery_type') }}">
                    @error('battery_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label for="battery_capacity" class="form-label">Capacity</label>
                    <input type="text" name="battery_capacity" id="battery_capacity" class="form-control @error('battery_capacity') is-invalid @enderror" value="{{ old('battery_capacity') }}">
                    @error('battery_capacity') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Misc Section -->
                <div class="col-12 mt-3"><h5>Misc</h5></div>
                <div class="col-md-6">
                    <label for="colors" class="form-label">Colors</label>
                    <input type="text" name="colors" id="colors" class="form-control @error('colors') is-invalid @enderror" value="{{ old('colors') }}">
                    @error('colors') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label for="models" class="form-label">Models</label>
                    <input type="text" name="models" id="models" class="form-control @error('models') is-invalid @enderror" value="{{ old('models') }}">
                    @error('models') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- SEO Section -->
                <div class="col-12 mt-3"><h5>SEO</h5></div>
                <div class="col-12">
                    <label for="meta_title" class="form-label">Meta Title</label>
                    <input type="text" name="meta_title" id="meta_title" class="form-control @error('meta_title') is-invalid @enderror" value="{{ old('meta_title') }}">
                    @error('meta_title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-12">
                    <label for="meta_description" class="form-label">Meta Description</label>
                    <textarea name="meta_description" id="meta_description" rows="2" class="form-control @error('meta_description') is-invalid @enderror">{{ old('meta_description') }}</textarea>
                    @error('meta_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-12">
                    <label for="meta_keywords" class="form-label">Meta Keywords</label>
                    <textarea name="meta_keywords" id="meta_keywords" rows="2" class="form-control @error('meta_keywords') is-invalid @enderror">{{ old('meta_keywords') }}</textarea>
                    @error('meta_keywords') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Submit Button -->
                <div class="col-12 mt-3">
                    <button class="btn btn-primary">Add Mobile</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('footer')
    <script src="{{ asset('app-assets/js/ckeditor.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            ClassicEditor
                .create(document.querySelector('#description'))
                .then(editor => {
                    const editableElement = editor.ui.view.editable.element;
                    editableElement.style.minHeight = '150px';

                    const form = editor.sourceElement.form;
                    if (form) {
                        form.addEventListener('submit', e => {
                            const data = editor.getData().trim();
                            if (data === '') {
                                e.preventDefault();
                                alert('Description is required.');
                                editor.editing.view.focus();
                            } else {
                                document.querySelector('#description').value = data;
                            }
                        });
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
@endsection