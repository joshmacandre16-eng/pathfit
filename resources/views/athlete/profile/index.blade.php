@extends('layouts.masterathlete')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">My Athlete Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('athlete.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">My Profile</li>
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
                            <h3 class="card-title">Profile Information</h3>
                            <div class="card-tools">
                                <a href="{{ route('athlete.profile.edit') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i> Edit Profile
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <i class="icon fas fa-check"></i> {{ session('success') }}
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <i class="icon fas fa-ban"></i> {{ session('error') }}
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group text-center">
                                        <label>Profile Photo</label>
                                        <div>
                                            @if($user->photo)
                                                <img src="{{ asset('storage/' . $user->photo) }}" alt="Profile Photo" class="img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                                            @else
                                                <img src="{{ asset('images/default-avatar.png') }}" alt="Default Avatar" class="img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                            <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fname">First Name</label>
                                                <p class="form-control-plaintext">{{ $user->fname }}</p>
                                            </div>
                                        </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mname">Middle Name</label>
                                        <p class="form-control-plaintext">{{ $user->mname }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lname">Last Name</label>
                                        <p class="form-control-plaintext">{{ $user->lname }}</p>
                                    </div>
                                </div>                                  

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <p class="form-control-plaintext">{{ $user->email }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="course">Course</label>
                                        <p class="form-control-plaintext">{{ $user->course }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <p class="form-control-plaintext">{{ $user->gender }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date_of_birth">Date of Birth</label>
                                        <p class="form-control-plaintext">{{ $user->date_of_birth ? $user->date_of_birth->format('M d, Y') : 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_physical_examination">Last Physical Examination</label>
                                        <p class="form-control-plaintext">{{ $user->last_physical_examination ? $user->last_physical_examination->format('M d, Y') : 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="athlete_id">Athlete ID</label>
                                        <p class="form-control-plaintext">{{ $user->athlete_id ?: 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nickname">Nickname</label>
                                        <p class="form-control-plaintext">{{ $user->nickname ?: 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="age">Age</label>
                                        <p class="form-control-plaintext">{{ $user->age ?: 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nationality">Nationality</label>
                                        <p class="form-control-plaintext">{{ $user->nationality ?: 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="place_of_birth">Place of Birth</label>
                                        <p class="form-control-plaintext">{{ $user->place_of_birth ?: 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="current_residence">Current Residence</label>
                                        <p class="form-control-plaintext">{{ $user->current_residence ?: 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="height">Height (cm)</label>
                                        <p class="form-control-plaintext">{{ $user->height ?: 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="weight">Weight (kg)</label>
                                        <p class="form-control-plaintext">{{ $user->weight ?: 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="wingspan">Wingspan (cm)</label>
                                        <p class="form-control-plaintext">{{ $user->wingspan ?: 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="body_fat_percentage">Body Fat Percentage (%)</label>
                                        <p class="form-control-plaintext">{{ $user->body_fat_percentage ?: 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dominant_hand">Dominant Hand</label>
                                        <p class="form-control-plaintext">{{ $user->dominant_hand ?: 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dominant_foot">Dominant Foot</label>
                                        <p class="form-control-plaintext">{{ $user->dominant_foot ?: 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="position_role">Position Role</label>
                                        <p class="form-control-plaintext">{{ $user->position_role ?: 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jersey_number">Jersey Number</label>
                                        <p class="form-control-plaintext">{{ $user->jersey_number ?: 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="primary_sport">Primary Sport</label>
                                        <p class="form-control-plaintext">{{ $user->primary_sport ?: 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="discipline_event">Discipline Event</label>
                                        <p class="form-control-plaintext">{{ $user->discipline_event ?: 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="level">Level</label>
                                        <p class="form-control-plaintext">{{ $user->level ?: 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="years_active">Years Active</label>
                                        <p class="form-control-plaintext">{{ $user->years_active ?: 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="club_team_name">Club Team Name</label>
                                        <p class="form-control-plaintext">{{ $user->club_team_name ?: 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="league_federation">League Federation</label>
                                        <p class="form-control-plaintext">{{ $user->league_federation ?: 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="training_location">Training Location</label>
                                        <p class="form-control-plaintext">{{ $user->training_location ?: 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="strength_conditioning_program">Strength Conditioning Program</label>
                                        <p class="form-control-plaintext">{{ $user->strength_conditioning_program ?: 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="weekly_training_hours">Weekly Training Hours</label>
                                        <p class="form-control-plaintext">{{ $user->weekly_training_hours ?: 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="clearance_status">Clearance Status</label>
                                        <p class="form-control-plaintext">{{ $user->clearance_status ?: 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="secondary_sports">Secondary Sports</label>
                                        <p class="form-control-plaintext">{{ $user->secondary_sports ? \App\Helpers\ArrayHelper::ensureArrayAndImplode($user->secondary_sports) : 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="key_performance_metrics">Key Performance Metrics</label>
                                        <p class="form-control-plaintext">{{ $user->key_performance_metrics ? \App\Helpers\ArrayHelper::ensureArrayAndImplode($user->key_performance_metrics) : 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="personal_bests">Personal Bests</label>
                                        <p class="form-control-plaintext">{{ $user->personal_bests ? \App\Helpers\ArrayHelper::ensureArrayAndImplode($user->personal_bests) : 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="seasonal_statistics">Seasonal Statistics</label>
                                        <p class="form-control-plaintext">{{ $user->seasonal_statistics ? \App\Helpers\ArrayHelper::ensureArrayAndImplode($user->seasonal_statistics) : 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="career_statistics">Career Statistics</label>
                                        <p class="form-control-plaintext">{{ $user->career_statistics ? \App\Helpers\ArrayHelper::ensureArrayAndImplode($user->career_statistics) : 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="rankings">Rankings</label>
                                        <p class="form-control-plaintext">{{ $user->rankings ? \App\Helpers\ArrayHelper::ensureArrayAndImplode($user->rankings) : 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="competition_history">Competition History</label>
                                        <p class="form-control-plaintext">{{ $user->competition_history ? \App\Helpers\ArrayHelper::ensureArrayAndImplode($user->competition_history) : 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="recovery_methods">Recovery Methods</label>
                                        <p class="form-control-plaintext">{{ $user->recovery_methods ? \App\Helpers\ArrayHelper::ensureArrayAndImplode($user->recovery_methods) : 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="injury_history">Injury History</label>
                                        <p class="form-control-plaintext">{{ $user->injury_history ? \App\Helpers\ArrayHelper::ensureArrayAndImplode($user->injury_history) : 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="current_injuries">Current Injuries</label>
                                        <p class="form-control-plaintext">{{ $user->current_injuries ? \App\Helpers\ArrayHelper::ensureArrayAndImplode($user->current_injuries) : 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="medical_conditions">Medical Conditions</label>
                                        <p class="form-control-plaintext">{{ $user->medical_conditions ? \App\Helpers\ArrayHelper::ensureArrayAndImplode($user->medical_conditions) : 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="rehabilitation_status">Rehabilitation Status</label>
                                        <p class="form-control-plaintext">{{ $user->rehabilitation_status ?: 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="medals_awards">Medals & Awards</label>
                                        <p class="form-control-plaintext">{{ $user->medals_awards ? \App\Helpers\ArrayHelper::ensureArrayAndImplode($user->medals_awards) : 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="records_held">Records Held</label>
                                        <p class="form-control-plaintext">{{ $user->records_held ? \App\Helpers\ArrayHelper::ensureArrayAndImplode($user->records_held) : 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="notable_performances">Notable Performances</label>
                                        <p class="form-control-plaintext">{{ $user->notable_performances ? \App\Helpers\ArrayHelper::ensureArrayAndImplode($user->notable_performances) : 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="scholarships_grants">Scholarships & Grants</label>
                                        <p class="form-control-plaintext">{{ $user->scholarships_grants ? \App\Helpers\ArrayHelper::ensureArrayAndImplode($user->scholarships_grants) : 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sports_academies_attended">Sports Academies Attended</label>
                                        <p class="form-control-plaintext">{{ $user->sports_academies_attended ? \App\Helpers\ArrayHelper::ensureArrayAndImplode($user->sports_academies_attended) : 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="certifications">Certifications</label>
                                        <p class="form-control-plaintext">{{ $user->certifications ? \App\Helpers\ArrayHelper::ensureArrayAndImplode($user->certifications) : 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <p class="form-control-plaintext">
                                            <span class="badge badge-info">{{ $user->role }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
