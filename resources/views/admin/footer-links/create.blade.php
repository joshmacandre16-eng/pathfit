@extends('layouts.master')

@section('content')
<div class="content">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Footer Link</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.footer-links.index') }}">Footer Links</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add New Footer Link</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.footer-links.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="title">Title *</label>
                                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="slug">Slug *</label>
                                    <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}" required>
                                    <small class="form-text text-muted">URL: /page/<slug></small>
                                    @error('slug')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="column">Column *</label>
                                    <select name="column" id="column" class="form-control" required>
                                        <option value="">Select Column</option>
                                        <option value="product" {{ old('column') == 'product' ? 'selected' : '' }}>Product</option>
                                        <option value="company" {{ old('column') == 'company' ? 'selected' : '' }}>Company</option>
                                        <option value="resources" {{ old('column') == 'resources' ? 'selected' : '' }}>Resources</option>
                                        <option value="legal" {{ old('column') == 'legal' ? 'selected' : '' }}>Legal</option>
                                    </select>
                                    @error('column')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="order">Order</label>
                                    <input type="number" name="order" id="order" class="form-control" value="{{ old('order', 0) }}" min="0">
                                    @error('order')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea name="content" id="content" class="form-control" rows="5">{{ old('content') }}</textarea>
                                    <small class="form-text text-muted">Page content (supports HTML)</small>
                                    @error('content')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="form-check">
                                        <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                        <label for="is_active" class="form-check-label">Active</label>
                                    </div>
                                </div>

                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Save
                                    </button>
                                    <a href="{{ route('admin.footer-links.index') }}" class="btn btn-secondary ml-2">
                                        <i class="fas fa-times"></i> Cancel
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script>
    // Auto-generate slug from title
    document.getElementById('title').addEventListener('input', function() {
        const title = this.value;
        const slug = title.toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/(^-|-$)/g, '');
        document.getElementById('slug').value = slug;
    });
</script>
@endsection

