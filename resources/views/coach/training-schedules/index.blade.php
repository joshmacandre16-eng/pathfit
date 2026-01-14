@extends('layouts.mastercoach')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">My Training Schedules</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('coach.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Training Schedules</li>
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
                            <h3 class="card-title">Training Schedules</h3>
                            <div class="card-tools">
                                <a href="{{ route('coach.training-schedules.create') }}" class="btn btn-primary btn-sm">Add New Schedule</a>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($trainingSchedules ?? [] as $schedule)
                                    <tr>
                                        <td>{{ $schedule->id }}</td>
                                        <td>{{ $schedule->title }}</td>
                                        <td>{{ Str::limit($schedule->description, 50) }}</td>
                                        <td>{{ $schedule->date->format('Y-m-d') }}</td>
                                        <td>{{ $schedule->start_time }}</td>
                                        <td>{{ $schedule->end_time }}</td>
                                        <td>
                                            <a href="{{ route('coach.training-schedules.show', $schedule) }}" class="btn btn-info btn-sm">View</a>
                                            <a href="{{ route('coach.training-schedules.edit', $schedule) }}" class="btn btn-warning btn-sm">Edit</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No training schedules found.</td>
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
