@extends('layouts.master')

@section('content')
<div class="content">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Training Schedule</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.training-schedule.index') }}">Training Schedule</a></li>
                        <li class="breadcrumb-item active">Edit</li>
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
                            <h3 class="card-title">Edit Training Schedule</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.training-schedule.update', $trainingSchedule) }}">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title" value="{{ old('title', $trainingSchedule->title) }}" class="form-control" required>
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" rows="3" class="form-control">{{ old('description', $trainingSchedule->description) }}</textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" name="date" id="date" value="{{ old('date', $trainingSchedule->date->format('Y-m-d')) }}" class="form-control" required>
                                    @error('date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="start_time">Start Time</label>
                                            <input type="time" name="start_time" id="start_time" value="{{ old('start_time', $trainingSchedule->start_time) }}" class="form-control" required>
                                            @error('start_time')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="end_time">End Time</label>
                                            <input type="time" name="end_time" id="end_time" value="{{ old('end_time', $trainingSchedule->end_time) }}" class="form-control" required>
                                            @error('end_time')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="coach_id">Coach</label>
                                    <select name="coach_id" id="coach_id" class="form-control" required>
                                        <option value="">Select a coach</option>
                                        @foreach($coaches as $coach)
                                            <option value="{{ $coach->id }}" {{ old('coach_id', $trainingSchedule->coach_id) == $coach->id ? 'selected' : '' }}>{{ $coach->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('coach_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update Schedule</button>
                                    <a href="{{ route('admin.training-schedule.show', $trainingSchedule) }}" class="btn btn-secondary">Cancel</a>
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
