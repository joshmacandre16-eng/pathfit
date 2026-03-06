@extends('layouts.master')

@section('content')
<div class="content">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Assign Coaches to Athletes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Assign Coaches</li>
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
                            <h3 class="card-title">Athletes and Coach Assignments</h3>
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

                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Athlete Name</th>
                                        <th>Email</th>
                                        <th>Sport</th>
                                        <th>Current Coach</th>
                                        <th>Assign Coach</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($athletes as $athlete)
                                    <tr>
                                        <td>{{ $athlete->id }}</td>
                                        <td>{{ $athlete->name }}</td>
                                        <td>{{ $athlete->email }}</td>
                                        <td>{{ $athlete->primary_sport ?? 'Not Specified' }}</td>
                                        <td>
                                            @if($athlete->coach_id)
                                                {{ $athlete->coach->name ?? 'N/A' }}
                                                @if(isset($qualificationScores[$athlete->id][$athlete->coach_id]))
                                                    <br><small class="text-muted">({{ $qualificationScores[$athlete->id][$athlete->coach_id] }}% qualified)</small>
                                                @endif
                                            @else
                                                No Coach Assigned
                                            @endif
                                        </td>
                                        <td>
                                            <form method="POST" action="{{ route('admin.assigncoach.store') }}" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="athlete_id" value="{{ $athlete->id }}">
                                                <select name="coach_id" class="form-control form-control-sm" required>
                                                    <option value="">Select Coach</option>
                                                    @foreach($coaches as $coach)
                                                    <option value="{{ $coach->id }}" {{ $athlete->coach_id == $coach->id ? 'selected' : '' }}>
                                                        {{ $coach->name }}
                                                        @if(isset($qualificationScores[$athlete->id][$coach->id]))
                                                            ({{ $qualificationScores[$athlete->id][$coach->id] }}%)
                                                        @endif
                                                    </option>
                                                    @endforeach
                                                </select>
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-sm btn-primary">
                                                <i class="fas fa-save"></i> Assign
                                            </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No athletes found.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
