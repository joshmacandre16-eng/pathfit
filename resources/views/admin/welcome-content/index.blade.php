@extends('layouts.master')

@section('content')
<div class="content">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Welcome Page Content</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Welcome Page Content</li>
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
                            <h3 class="card-title">Welcome Page Sections</h3>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <div class="callout callout-info">
                                <h5><i class="icon fas fa-info"></i> Instructions</h5>
                                Manage the content displayed on the welcome page. Click "Edit" to modify text and images for each section.
                            </div>

                            <div class="row">
                                @php
                                $sections = [
                                    'hero' => ['title' => 'Hero Section', 'description' => 'Main banner with title, subtitle, badge, and athlete image'],
                                    'features' => ['title' => 'Features Section', 'description' => 'Feature cards displaying platform capabilities'],
                                    'how_it_works' => ['title' => 'How It Works', 'description' => 'Step-by-step guide for users'],
                                    'coaches' => ['title' => 'Coaches Section', 'description' => 'Showcase of available coaches'],
                                    'cta' => ['title' => 'Call to Action', 'description' => 'Conversion section encouraging signup'],
                                    'footer' => ['title' => 'Footer', 'description' => 'Links, brand info, and social media'],
                                ];
                                @endphp

                                @foreach($sections as $section => $info)
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $info['title'] }}</h5>
                                            <p class="card-text text-muted">{{ $info['description'] }}</p>
                                            
                                            @php
                                            $hasContent = isset($contents[$section]) && $contents[$section]->count() > 0;
                                            @endphp
                                            
                                            @if($hasContent)
                                                <span class="badge bg-success">Configured</span>
                                                <span class="text-muted ml-2">{{ $contents[$section]->count() }} items</span>
                                            @else
                                                <span class="badge bg-warning">Not Configured</span>
                                            @endif
                                        </div>
                                        <div class="card-footer">
                                            <a href="{{ route('admin.welcome-content.edit', $section) }}" class="btn btn-primary btn-block">
                                                <i class="fas fa-edit"></i> Edit Section
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

