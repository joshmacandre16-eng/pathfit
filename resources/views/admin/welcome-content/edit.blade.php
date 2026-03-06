@extends('layouts.master')

@section('content')
<div class="content">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit {{ ucfirst(str_replace('-', ' ', $section)) }} Content</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.welcome-content.index') }}">Welcome Content</a></li>
                        <li class="breadcrumb-item active">Edit {{ ucfirst(str_replace('-', ' ', $section)) }}</li>
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
                            <h3 class="card-title">Edit {{ ucfirst(str_replace('-', ' ', $section)) }} Section</h3>
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

                            <form action="{{ route('admin.welcome-content.update', $section) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                @php
                                $sectionFields = [];
                                
                                // Define fields for each section
                                switch($section) {
                                    case 'hero':
                                        $sectionFields = [
                                            'badge_text' => ['label' => 'Badge Text', 'type' => 'text', 'placeholder' => 'AI-Powered Fitness Platform'],
                                            'title' => ['label' => 'Main Title', 'type' => 'text', 'placeholder' => 'Your AI-Powered Fitness Journey'],
                                            'gradient_text' => ['label' => 'Gradient Text', 'type' => 'text', 'placeholder' => 'Fitness Journey'],
                                            'subtitle' => ['label' => 'Subtitle/Description', 'type' => 'textarea', 'placeholder' => 'Experience personalized workout plans...'],
                                            'hero_image' => ['label' => 'Hero Image', 'type' => 'image', 'placeholder' => 'athlete.jpg'],
                                            'feature_1' => ['label' => 'Feature 1 Text', 'type' => 'text', 'placeholder' => 'Personalized Plans'],
                                            'feature_2' => ['label' => 'Feature 2 Text', 'type' => 'text', 'placeholder' => 'Real-time Coaching'],
                                            'feature_3' => ['label' => 'Feature 3 Text', 'type' => 'text', 'placeholder' => 'Progress Analytics'],
                                        ];
                                        break;
                                        
                                    case 'features':
                                        $sectionFields = [
                                            'section_tag' => ['label' => 'Section Tag', 'type' => 'text', 'placeholder' => 'FEATURES'],
                                            'section_title' => ['label' => 'Section Title', 'type' => 'text', 'placeholder' => 'Everything You Need to Succeed'],
                                            'section_subtitle' => ['label' => 'Section Subtitle', 'type' => 'textarea', 'placeholder' => 'Powered by advanced AI technology...'],
                                            // Feature cards 1-6
                                            'feature_1_title' => ['label' => 'Feature 1 Title', 'type' => 'text', 'placeholder' => 'Smart Workout Plans'],
                                            'feature_1_description' => ['label' => 'Feature 1 Description', 'type' => 'textarea', 'placeholder' => 'AI-generated programs...'],
                                            'feature_2_title' => ['label' => 'Feature 2 Title', 'type' => 'text', 'placeholder' => 'Real-Time Analytics'],
                                            'feature_2_description' => ['label' => 'Feature 2 Description', 'type' => 'textarea', 'placeholder' => 'Track every metric...'],
                                            'feature_3_title' => ['label' => 'Feature 3 Title', 'type' => 'text', 'placeholder' => 'Expert Coaching'],
                                            'feature_3_description' => ['label' => 'Feature 3 Description', 'type' => 'textarea', 'placeholder' => 'Get guidance from certified...'],
                                            'feature_4_title' => ['label' => 'Feature 4 Title', 'type' => 'text', 'placeholder' => 'Nutrition Guidance'],
                                            'feature_4_description' => ['label' => 'Feature 4 Description', 'type' => 'textarea', 'placeholder' => 'Personalized meal plans...'],
                                            'feature_5_title' => ['label' => 'Feature 5 Title', 'type' => 'text', 'placeholder' => 'Progress Tracking'],
                                            'feature_5_description' => ['label' => 'Feature 5 Description', 'type' => 'textarea', 'placeholder' => 'Visualize your journey...'],
                                            'feature_6_title' => ['label' => 'Feature 6 Title', 'type' => 'text', 'placeholder' => 'Video Workouts'],
                                            'feature_6_description' => ['label' => 'Feature 6 Description', 'type' => 'textarea', 'placeholder' => 'Access thousands of HD...'],
                                        ];
                                        break;
                                        
                                    case 'how_it_works':
                                        $sectionFields = [
                                            'section_tag' => ['label' => 'Section Tag', 'type' => 'text', 'placeholder' => 'HOW IT WORKS'],
                                            'section_title' => ['label' => 'Section Title', 'type' => 'text', 'placeholder' => 'Get Started in 4 Simple Steps'],
                                            'section_subtitle' => ['label' => 'Section Subtitle', 'type' => 'textarea', 'placeholder' => 'Begin your transformation...'],
                                            'step_1_title' => ['label' => 'Step 1 Title', 'type' => 'text', 'placeholder' => 'Create Your Profile'],
                                            'step_1_description' => ['label' => 'Step 1 Description', 'type' => 'textarea', 'placeholder' => 'Tell us about your fitness level...'],
                                            'step_2_title' => ['label' => 'Step 2 Title', 'type' => 'text', 'placeholder' => 'Get Your AI Plan'],
                                            'step_2_description' => ['label' => 'Step 2 Description', 'type' => 'textarea', 'placeholder' => 'Our AI analyzes your data...'],
                                            'step_3_title' => ['label' => 'Step 3 Title', 'type' => 'text', 'placeholder' => 'Start Training'],
                                            'step_3_description' => ['label' => 'Step 3 Description', 'type' => 'textarea', 'placeholder' => 'Follow guided workouts...'],
                                            'step_4_title' => ['label' => 'Step 4 Title', 'type' => 'text', 'placeholder' => 'Track Progress'],
                                            'step_4_description' => ['label' => 'Step 4 Description', 'type' => 'textarea', 'placeholder' => 'Monitor your improvements...'],
                                        ];
                                        break;
                                        
                                    case 'coaches':
                                        $sectionFields = [
                                            'section_tag' => ['label' => 'Section Tag', 'type' => 'text', 'placeholder' => 'OUR TEAM'],
                                            'section_title' => ['label' => 'Section Title', 'type' => 'text', 'placeholder' => 'Train with Expert Coaches'],
                                            'section_subtitle' => ['label' => 'Section Subtitle', 'type' => 'textarea', 'placeholder' => 'Learn from certified professionals...'],
                                        ];
                                        break;
                                        
                                    case 'cta':
                                        $sectionFields = [
                                            'title' => ['label' => 'CTA Title', 'type' => 'text', 'placeholder' => 'Ready to Transform Your Fitness?'],
                                            'subtitle' => ['label' => 'CTA Subtitle', 'type' => 'textarea', 'placeholder' => 'Join thousands of athletes...'],
                                        ];
                                        break;
                                        
                                    case 'footer':
                                        $sectionFields = [
                                            'brand_name' => ['label' => 'Brand Name', 'type' => 'text', 'placeholder' => 'PathFit AI'],
                                            'description' => ['label' => 'Brand Description', 'type' => 'textarea', 'placeholder' => 'Revolutionizing fitness...'],
                                            'product_title' => ['label' => 'Product Column Title', 'type' => 'text', 'placeholder' => 'Product'],
                                            'company_title' => ['label' => 'Company Column Title', 'type' => 'text', 'placeholder' => 'Company'],
                                            'resources_title' => ['label' => 'Resources Column Title', 'type' => 'text', 'placeholder' => 'Resources'],
                                            'legal_title' => ['label' => 'Legal Column Title', 'type' => 'text', 'placeholder' => 'Legal'],
                                            'copyright' => ['label' => 'Copyright Text', 'type' => 'text', 'placeholder' => '© 2024 PathFit AI. All rights reserved.'],
                                        ];
                                        break;
                                }
                                @endphp

                                @forelse($sectionFields as $key => $field)
                                <div class="form-group">
                                    <label for="{{ $key }}">{{ $field['label'] }}</label>
                                    
                                    @if($field['type'] === 'textarea')
                                        <textarea 
                                            name="contents[{{ $key }}][value]" 
                                            id="{{ $key }}" 
                                            class="form-control" 
                                            rows="3"
                                            placeholder="{{ $field['placeholder'] }}"
                                        >{{ isset($contents[$key]) ? $contents[$key]->value : '' }}</textarea>
                                    @elseif($field['type'] === 'image')
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="{{ $key }}" name="contents[{{ $key }}][image]" accept="image/*">
                                                <label class="custom-file-label" for="{{ $key }}">Choose file</label>
                                            </div>
                                        </div>
                                        @if(isset($contents[$key]) && $contents[$key]->value)
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . $contents[$key]->value) }}" alt="{{ $field['label'] }}" style="max-width: 200px; max-height: 150px;">
                                            <p class="text-muted mt-1">Current image: {{ $contents[$key]->value }}</p>
                                        </div>
                                        @endif
                                        <small class="form-text text-muted">{{ $field['placeholder'] }}</small>
                                    @else
                                        <input 
                                            type="text" 
                                            name="contents[{{ $key }}][value]" 
                                            id="{{ $key }}" 
                                            class="form-control" 
                                            value="{{ isset($contents[$key]) ? $contents[$key]->value : '' }}"
                                            placeholder="{{ $field['placeholder'] }}"
                                        >
                                    @endif
                                </div>
                                @empty
                                <div class="alert alert-info">
                                    <p>No configurable fields for this section. This section displays dynamic content.</p>
                                </div>
                                @endforelse

                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Save Changes
                                    </button>
                                    <a href="{{ route('admin.welcome-content.index') }}" class="btn btn-secondary ml-2">
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
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>
    $(function () {
        bsCustomFileInput.init();
    });
</script>
@endsection

