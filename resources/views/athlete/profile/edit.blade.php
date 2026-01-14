@extends('layouts.masterathlete')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        <i class="fas fa-user-edit mr-2"></i>Edit Athlete Profile
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('athlete.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('athlete.profile.index') }}">My Profile</a></li>
                        <li class="breadcrumb-item active">Edit Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <form method="POST" action="{{ route('athlete.profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-user mr-2"></i>Basic Information
                                </h3>
                            </div>
                            <div class="card-body">
                                @if(session('status'))
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <i class="icon fas fa-check"></i> {{ session('status') }}
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="fname">
                                                <i class="fas fa-signature mr-1"></i>First Name
                                            </label>
                                            <input type="text" class="form-control @error('fname') is-invalid @enderror" id="fname" name="fname" value="{{ old('fname', $user->fname) }}" required placeholder="Enter your first name">
                                            @error('fname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="mname">
                                                <i class="fas fa-signature mr-1"></i>Middle Name
                                            </label>
                                            <input type="text" class="form-control @error('mname') is-invalid @enderror" id="mname" name="mname" value="{{ old('mname', $user->mname) }}" placeholder="Enter your middle name">
                                            @error('mname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="lname">
                                                <i class="fas fa-signature mr-1"></i>Last Name
                                            </label>
                                            <input type="text" class="form-control @error('lname') is-invalid @enderror" id="lname" name="lname" value="{{ old('lname', $user->lname) }}" required placeholder="Enter your last name">
                                            @error('lname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">
                                                <i class="fas fa-envelope mr-1"></i>Email Address
                                            </label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required placeholder="Enter your email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="course">
                                                <i class="fas fa-graduation-cap mr-1"></i>Course
                                            </label>
                                            <input type="text" class="form-control @error('course') is-invalid @enderror" id="course" name="course" value="{{ old('course', $user->course) }}" placeholder="Enter your course">
                                            @error('course')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="gender">
                                                <i class="fas fa-venus-mars mr-1"></i>Gender
                                            </label>
                                            <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender">
                                                <option value="">Select Gender</option>
                                                <option value="Male" {{ old('gender', $user->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                                <option value="Female" {{ old('gender', $user->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                                <option value="Other" {{ old('gender', $user->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                            @error('gender')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="date_of_birth">
                                                <i class="fas fa-birthday-cake mr-1"></i>Date of Birth
                                            </label>
                                            <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth ? $user->date_of_birth->format('Y-m-d') : '') }}">
                                            @error('date_of_birth')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="athlete_id">
                                                <i class="fas fa-id-card mr-1"></i>Athlete ID
                                            </label>
                                            <input type="text" class="form-control @error('athlete_id') is-invalid @enderror" id="athlete_id" name="athlete_id" value="{{ old('athlete_id', $user->athlete_id) }}" placeholder="Enter athlete ID">
                                            @error('athlete_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nickname">
                                                <i class="fas fa-user-tag mr-1"></i>Nickname
                                            </label>
                                            <input type="text" class="form-control @error('nickname') is-invalid @enderror" id="nickname" name="nickname" value="{{ old('nickname', $user->nickname) }}" placeholder="Enter nickname">
                                            @error('nickname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="age">
                                                <i class="fas fa-birthday-cake mr-1"></i>Age
                                            </label>
                                            <input type="number" class="form-control @error('age') is-invalid @enderror" id="age" name="age" value="{{ old('age', $user->age) }}" placeholder="Enter age">
                                            @error('age')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nationality">
                                                <i class="fas fa-flag mr-1"></i>Nationality
                                            </label>
                                            <input type="text" class="form-control @error('nationality') is-invalid @enderror" id="nationality" name="nationality" value="{{ old('nationality', $user->nationality) }}" placeholder="Enter nationality">
                                            @error('nationality')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="place_of_birth">
                                                <i class="fas fa-map-marker-alt mr-1"></i>Place of Birth
                                            </label>
                                            <input type="text" class="form-control @error('place_of_birth') is-invalid @enderror" id="place_of_birth" name="place_of_birth" value="{{ old('place_of_birth', $user->place_of_birth) }}" placeholder="Enter place of birth">
                                            @error('place_of_birth')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="current_residence">
                                                <i class="fas fa-home mr-1"></i>Current Residence
                                            </label>
                                            <input type="text" class="form-control @error('current_residence') is-invalid @enderror" id="current_residence" name="current_residence" value="{{ old('current_residence', $user->current_residence) }}" placeholder="Enter current residence">
                                            @error('current_residence')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="height">
                                                <i class="fas fa-ruler-vertical mr-1"></i>Height (cm)
                                            </label>
                                            <input type="number" step="0.1" class="form-control @error('height') is-invalid @enderror" id="height" name="height" value="{{ old('height', $user->height) }}" placeholder="Enter height in cm">
                                            @error('height')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="weight">
                                                <i class="fas fa-weight mr-1"></i>Weight (kg)
                                            </label>
                                            <input type="number" step="0.1" class="form-control @error('weight') is-invalid @enderror" id="weight" name="weight" value="{{ old('weight', $user->weight) }}" placeholder="Enter weight in kg">
                                            @error('weight')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="wingspan">
                                                <i class="fas fa-arrows-alt-h mr-1"></i>Wingspan (cm)
                                            </label>
                                            <input type="number" step="0.1" class="form-control @error('wingspan') is-invalid @enderror" id="wingspan" name="wingspan" value="{{ old('wingspan', $user->wingspan) }}" placeholder="Enter wingspan in cm">
                                            @error('wingspan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="body_fat_percentage">
                                                <i class="fas fa-percentage mr-1"></i>Body Fat Percentage (%)
                                            </label>
                                            <input type="number" step="0.1" min="0" max="100" class="form-control @error('body_fat_percentage') is-invalid @enderror" id="body_fat_percentage" name="body_fat_percentage" value="{{ old('body_fat_percentage', $user->body_fat_percentage) }}" placeholder="Enter body fat percentage">
                                            @error('body_fat_percentage')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dominant_hand">
                                                <i class="fas fa-hand-paper mr-1"></i>Dominant Hand
                                            </label>
                                            <select class="form-control @error('dominant_hand') is-invalid @enderror" id="dominant_hand" name="dominant_hand">
                                                <option value="">Select Dominant Hand</option>
                                                <option value="left" {{ old('dominant_hand', $user->dominant_hand) == 'left' ? 'selected' : '' }}>Left</option>
                                                <option value="right" {{ old('dominant_hand', $user->dominant_hand) == 'right' ? 'selected' : '' }}>Right</option>
                                                <option value="ambidextrous" {{ old('dominant_hand', $user->dominant_hand) == 'ambidextrous' ? 'selected' : '' }}>Ambidextrous</option>
                                            </select>
                                            @error('dominant_hand')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dominant_foot">
                                                <i class="fas fa-shoe-prints mr-1"></i>Dominant Foot
                                            </label>
                                            <select class="form-control @error('dominant_foot') is-invalid @enderror" id="dominant_foot" name="dominant_foot">
                                                <option value="">Select Dominant Foot</option>
                                                <option value="left" {{ old('dominant_foot', $user->dominant_foot) == 'left' ? 'selected' : '' }}>Left</option>
                                                <option value="right" {{ old('dominant_foot', $user->dominant_foot) == 'right' ? 'selected' : '' }}>Right</option>
                                                <option value="both" {{ old('dominant_foot', $user->dominant_foot) == 'both' ? 'selected' : '' }}>Both</option>
                                            </select>
                                            @error('dominant_foot')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="photo">
                                                <i class="fas fa-camera mr-1"></i>Profile Photo
                                            </label>
                                            @if($user->photo)
                                                <div class="mb-2">
                                                    <img src="{{ asset('storage/' . $user->photo) }}" alt="Current Photo" class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
                                                </div>
                                            @endif
                                            <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo" accept="image/*">
                                            <small class="form-text text-muted">Upload a new photo (JPEG, PNG, JPG, max 2MB)</small>
                                            @error('photo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-running mr-2"></i>Sports Information
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                            <label for="primary_sport">
                                                <i class="fas fa-star mr-1"></i>Primary Sport
                                            </label>
                                            @if($user->primary_sport)
                                                <input type="text" class="form-control" id="primary_sport" value="{{ $user->primary_sport }}" readonly disabled>
                                                <small class="form-text text-muted">Primary sport is already selected and cannot be changed.</small>
                                            @else
                                                <input type="text" class="form-control @error('primary_sport') is-invalid @enderror" id="primary_sport" name="primary_sport" value="{{ old('primary_sport', $user->primary_sport) }}" placeholder="Enter primary sport">
                                                @error('primary_sport')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="discipline_event">
                                                <i class="fas fa-running mr-1"></i>Discipline/Event
                                            </label>
                                            <input type="text" class="form-control @error('discipline_event') is-invalid @enderror" id="discipline_event" name="discipline_event" value="{{ old('discipline_event', $user->discipline_event) }}" placeholder="Enter discipline or event">
                                            @error('discipline_event')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="position_role">
                                                <i class="fas fa-user-cog mr-1"></i>Position/Role
                                            </label>
                                            <input type="text" class="form-control @error('position_role') is-invalid @enderror" id="position_role" name="position_role" value="{{ old('position_role', $user->position_role) }}" placeholder="Enter position or role">
                                            @error('position_role')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jersey_number">
                                                <i class="fas fa-hashtag mr-1"></i>Jersey Number
                                            </label>
                                            <input type="number" min="0" max="999" class="form-control @error('jersey_number') is-invalid @enderror" id="jersey_number" name="jersey_number" value="{{ old('jersey_number', $user->jersey_number) }}" placeholder="Enter jersey number">
                                            @error('jersey_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="level">
                                                <i class="fas fa-level-up-alt mr-1"></i>Level
                                            </label>
                                            <select class="form-control @error('level') is-invalid @enderror" id="level" name="level">
                                                <option value="">Select Level</option>
                                                <option value="youth" {{ old('level', $user->level) == 'youth' ? 'selected' : '' }}>Youth</option>
                                                <option value="amateur" {{ old('level', $user->level) == 'amateur' ? 'selected' : '' }}>Amateur</option>
                                                <option value="semi-pro" {{ old('level', $user->level) == 'semi-pro' ? 'selected' : '' }}>Semi-Pro</option>
                                                <option value="professional" {{ old('level', $user->level) == 'professional' ? 'selected' : '' }}>Professional</option>
                                                <option value="elite" {{ old('level', $user->level) == 'elite' ? 'selected' : '' }}>Elite</option>
                                            </select>
                                            @error('level')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="years_active">
                                                <i class="fas fa-calendar mr-1"></i>Years Active
                                            </label>
                                            <input type="number" min="0" max="100" class="form-control @error('years_active') is-invalid @enderror" id="years_active" name="years_active" value="{{ old('years_active', $user->years_active) }}" placeholder="Enter years active">
                                            @error('years_active')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="club_team_name">
                                                <i class="fas fa-users mr-1"></i>Club/Team Name
                                            </label>
                                            <input type="text" class="form-control @error('club_team_name') is-invalid @enderror" id="club_team_name" name="club_team_name" value="{{ old('club_team_name', $user->club_team_name) }}" placeholder="Enter club or team name">
                                            @error('club_team_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="league_federation">
                                                <i class="fas fa-building mr-1"></i>League/Federation
                                            </label>
                                            <input type="text" class="form-control @error('league_federation') is-invalid @enderror" id="league_federation" name="league_federation" value="{{ old('league_federation', $user->league_federation) }}" placeholder="Enter league or federation">
                                            @error('league_federation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="training_location">
                                                <i class="fas fa-map-marker-alt mr-1"></i>Training Location
                                            </label>
                                            <input type="text" class="form-control @error('training_location') is-invalid @enderror" id="training_location" name="training_location" value="{{ old('training_location', $user->training_location) }}" placeholder="Enter training location">
                                            @error('training_location')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="strength_conditioning_program">
                                                <i class="fas fa-dumbbell mr-1"></i>Strength & Conditioning Program
                                            </label>
                                            <input type="text" class="form-control @error('strength_conditioning_program') is-invalid @enderror" id="strength_conditioning_program" name="strength_conditioning_program" value="{{ old('strength_conditioning_program', $user->strength_conditioning_program) }}" placeholder="Enter strength & conditioning program">
                                            @error('strength_conditioning_program')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="weekly_training_hours">
                                                <i class="fas fa-clock mr-1"></i>Weekly Training Hours
                                            </label>
                                            <input type="number" min="0" max="168" class="form-control @error('weekly_training_hours') is-invalid @enderror" id="weekly_training_hours" name="weekly_training_hours" value="{{ old('weekly_training_hours', $user->weekly_training_hours) }}" placeholder="Enter weekly training hours">
                                            @error('weekly_training_hours')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="secondary_sports">
                                                <i class="fas fa-trophy mr-1"></i>Secondary Sports (comma-separated)
                                            </label>
                                            <input type="text" class="form-control @error('secondary_sports') is-invalid @enderror" id="secondary_sports" name="secondary_sports" value="{{ old('secondary_sports', $user->secondary_sports ? \App\Helpers\ArrayHelper::ensureArrayAndImplode($user->secondary_sports) : '') }}" placeholder="e.g., Basketball, Swimming">
                                            @error('secondary_sports')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="key_performance_metrics">
                                                <i class="fas fa-chart-line mr-1"></i>Key Performance Metrics (comma-separated)
                                            </label>
                                            <input type="text" class="form-control @error('key_performance_metrics') is-invalid @enderror" id="key_performance_metrics" name="key_performance_metrics" value="{{ old('key_performance_metrics', $user->key_performance_metrics ? \App\Helpers\ArrayHelper::ensureArrayAndImplode($user->key_performance_metrics) : '') }}" placeholder="e.g., Speed, Endurance">
                                            @error('key_performance_metrics')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="personal_bests">
                                                <i class="fas fa-star mr-1"></i>Personal Bests (comma-separated)
                                            </label>
                                            <input type="text" class="form-control @error('personal_bests') is-invalid @enderror" id="personal_bests" name="personal_bests" value="{{ old('personal_bests', $user->personal_bests ? \App\Helpers\ArrayHelper::ensureArrayAndImplode($user->personal_bests) : '') }}" placeholder="e.g., 100m: 10.5s, Long Jump: 7.2m">
                                            @error('personal_bests')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="seasonal_statistics">
                                                <i class="fas fa-calendar-alt mr-1"></i>Seasonal Statistics (comma-separated)
                                            </label>
                                            <input type="text" class="form-control @error('seasonal_statistics') is-invalid @enderror" id="seasonal_statistics" name="seasonal_statistics" value="{{ old('seasonal_statistics', $user->seasonal_statistics ? \App\Helpers\ArrayHelper::ensureArrayAndImplode($user->seasonal_statistics) : '') }}" placeholder="e.g., Wins: 15, Losses: 3">
                                            @error('seasonal_statistics')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="career_statistics">
                                                <i class="fas fa-chart-bar mr-1"></i>Career Statistics (comma-separated)
                                            </label>
                                            <input type="text" class="form-control @error('career_statistics') is-invalid @enderror" id="career_statistics" name="career_statistics" value="{{ old('career_statistics', $user->career_statistics ? \App\Helpers\ArrayHelper::ensureArrayAndImplode($user->career_statistics) : '') }}" placeholder="e.g., Total Wins: 120, Championships: 5">
                                            @error('career_statistics')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="rankings">
                                                <i class="fas fa-trophy mr-1"></i>Rankings (comma-separated)
                                            </label>
                                            <input type="text" class="form-control @error('rankings') is-invalid @enderror" id="rankings" name="rankings" value="{{ old('rankings', $user->rankings ? \App\Helpers\ArrayHelper::ensureArrayAndImplode($user->rankings) : '') }}" placeholder="e.g., National Rank: 3, Regional Rank: 1">
                                            @error('rankings')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="competition_history">
                                                <i class="fas fa-history mr-1"></i>Competition History (comma-separated)
                                            </label>
                                            <input type="text" class="form-control @error('competition_history') is-invalid @enderror" id="competition_history" name="competition_history" value="{{ old('competition_history', $user->competition_history ? \App\Helpers\ArrayHelper::ensureArrayAndImplode($user->competition_history) : '') }}" placeholder="e.g., Olympics 2020, World Championships 2022">
                                            @error('competition_history')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="recovery_methods">
                                                <i class="fas fa-heartbeat mr-1"></i>Recovery Methods (comma-separated)
                                            </label>
                                            <input type="text" class="form-control @error('recovery_methods') is-invalid @enderror" id="recovery_methods" name="recovery_methods" value="{{ old('recovery_methods', $user->recovery_methods ? \App\Helpers\ArrayHelper::ensureArrayAndImplode($user->recovery_methods) : '') }}" placeholder="e.g., Ice baths, Massage, Stretching">
                                            @error('recovery_methods')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sports_academies_attended">
                                                <i class="fas fa-school mr-1"></i>Sports Academies Attended (comma-separated)
                                            </label>
                                            <input type="text" class="form-control @error('sports_academies_attended') is-invalid @enderror" id="sports_academies_attended" name="sports_academies_attended" value="{{ old('sports_academies_attended', $user->sports_academies_attended ? \App\Helpers\ArrayHelper::ensureArrayAndImplode($user->sports_academies_attended) : '') }}" placeholder="e.g., National Sports Academy, Elite Training Center">
                                            @error('sports_academies_attended')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="injury_history">
                                                <i class="fas fa-band-aid mr-1"></i>Injury History (comma-separated)
                                            </label>
                                            <input type="text" class="form-control @error('injury_history') is-invalid @enderror" id="injury_history" name="injury_history" value="{{ old('injury_history', $user->injury_history ? \App\Helpers\ArrayHelper::ensureArrayAndImplode($user->injury_history) : '') }}" placeholder="e.g., ACL Tear 2019, Concussion 2021">
                                            @error('injury_history')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-medkit mr-2"></i>Health Information
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="medical_conditions">
                                                <i class="fas fa-stethoscope mr-1"></i>Medical Conditions (comma-separated)
                                            </label>
                                            <input type="text" class="form-control @error('medical_conditions') is-invalid @enderror" id="medical_conditions" name="medical_conditions" value="{{ old('medical_conditions', $user->medical_conditions ? \App\Helpers\ArrayHelper::ensureArrayAndImplode($user->medical_conditions) : '') }}" placeholder="e.g., Asthma, Allergies">
                                            @error('medical_conditions')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="current_injuries">
                                                <i class="fas fa-band-aid mr-1"></i>Current Injuries (comma-separated)
                                            </label>
                                            <input type="text" class="form-control @error('current_injuries') is-invalid @enderror" id="current_injuries" name="current_injuries" value="{{ old('current_injuries', $user->current_injuries ? \App\Helpers\ArrayHelper::ensureArrayAndImplode($user->current_injuries) : '') }}" placeholder="e.g., Sprained ankle">
                                            @error('current_injuries')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="rehabilitation_status">
                                                <i class="fas fa-user-md mr-1"></i>Rehabilitation Status
                                            </label>
                                            <input type="text" class="form-control @error('rehabilitation_status') is-invalid @enderror" id="rehabilitation_status" name="rehabilitation_status" value="{{ old('rehabilitation_status', $user->rehabilitation_status) }}" placeholder="Enter rehabilitation status">
                                            @error('rehabilitation_status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_physical_examination">
                                                <i class="fas fa-calendar-check mr-1"></i>Last Physical Examination
                                            </label>
                                            <input type="date" class="form-control @error('last_physical_examination') is-invalid @enderror" id="last_physical_examination" name="last_physical_examination" value="{{ old('last_physical_examination', $user->last_physical_examination ? $user->last_physical_examination->format('Y-m-d') : '') }}">
                                            @error('last_physical_examination')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="clearance_status">
                                                <i class="fas fa-check-circle mr-1"></i>Clearance Status
                                            </label>
                                            <input type="text" class="form-control @error('clearance_status') is-invalid @enderror" id="clearance_status" name="clearance_status" value="{{ old('clearance_status', $user->clearance_status) }}" placeholder="Enter clearance status">
                                            @error('clearance_status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-award mr-2"></i>Achievements & Education
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="education_level">
                                                <i class="fas fa-graduation-cap mr-1"></i>Education Level
                                            </label>
                                            <input type="text" class="form-control @error('education_level') is-invalid @enderror" id="education_level" name="education_level" value="{{ old('education_level', $user->education_level) }}" placeholder="e.g., Bachelor's Degree">
                                            @error('education_level')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="school_university">
                                                <i class="fas fa-university mr-1"></i>School/University
                                            </label>
                                            <input type="text" class="form-control @error('school_university') is-invalid @enderror" id="school_university" name="school_university" value="{{ old('school_university', $user->school_university) }}" placeholder="e.g., University of Example">
                                            @error('school_university')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="certifications">
                                                <i class="fas fa-certificate mr-1"></i>Certifications (comma-separated)
                                            </label>
                                            <input type="text" class="form-control @error('certifications') is-invalid @enderror" id="certifications" name="certifications" value="{{ old('certifications', $user->certifications ? \App\Helpers\ArrayHelper::ensureArrayAndImplode($user->certifications) : '') }}" placeholder="e.g., CPR, First Aid">
                                            @error('certifications')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="scholarships_grants">
                                                <i class="fas fa-money-bill-wave mr-1"></i>Scholarships & Grants (comma-separated)
                                            </label>
                                            <input type="text" class="form-control @error('scholarships_grants') is-invalid @enderror" id="scholarships_grants" name="scholarships_grants" value="{{ old('scholarships_grants', $user->scholarships_grants ? \App\Helpers\ArrayHelper::ensureArrayAndImplode($user->scholarships_grants) : '') }}" placeholder="e.g., Athletic Scholarship">
                                            @error('scholarships_grants')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="titles_won">
                                                <i class="fas fa-crown mr-1"></i>Titles Won (comma-separated)
                                            </label>
                                            <input type="text" class="form-control @error('titles_won') is-invalid @enderror" id="titles_won" name="titles_won" value="{{ old('titles_won', $user->titles_won ? \App\Helpers\ArrayHelper::ensureArrayAndImplode($user->titles_won) : '') }}" placeholder="e.g., Champion, MVP">
                                            @error('titles_won')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="medals_awards">
                                                <i class="fas fa-medal mr-1"></i>Medals & Awards (comma-separated)
                                            </label>
                                            <input type="text" class="form-control @error('medals_awards') is-invalid @enderror" id="medals_awards" name="medals_awards" value="{{ old('medals_awards', $user->medals_awards ? \App\Helpers\ArrayHelper::ensureArrayAndImplode($user->medals_awards) : '') }}" placeholder="e.g., Gold Medal, MVP Award">
                                            @error('medals_awards')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="notable_performances">
                                                <i class="fas fa-star mr-1"></i>Notable Performances (comma-separated)
                                            </label>
                                            <input type="text" class="form-control @error('notable_performances') is-invalid @enderror" id="notable_performances" name="notable_performances" value="{{ old('notable_performances', $user->notable_performances ? \App\Helpers\ArrayHelper::ensureArrayAndImplode($user->notable_performances) : '') }}" placeholder="e.g., Perfect Game, Triple Crown">
                                            @error('notable_performances')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i>Update Profile
                            </button>
                            <a href="{{ route('athlete.profile.index') }}" class="btn btn-secondary ml-2">
                                <i class="fas fa-times mr-1"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
