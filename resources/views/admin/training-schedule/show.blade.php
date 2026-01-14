@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Training Schedule Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.training-schedule.index') }}">Training Schedule</a></li>
                        <li class="breadcrumb-item active">Details</li>
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
                            <h3 class="card-title">Training Schedule Details</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.training-schedule.edit', $trainingSchedule) }}" class="btn btn-warning btn-sm">Edit</a>
                                <a href="{{ route('admin.training-schedule.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-3">ID</dt>
                                <dd class="col-sm-9">{{ $trainingSchedule->id }}</dd>

                                <dt class="col-sm-3">Title</dt>
                                <dd class="col-sm-9">{{ $trainingSchedule->title }}</dd>

                                <dt class="col-sm-3">Description</dt>
                                <dd class="col-sm-9">{{ $trainingSchedule->description ?: 'N/A' }}</dd>

                                <dt class="col-sm-3">Date</dt>
                                <dd class="col-sm-9">{{ $trainingSchedule->date->format('Y-m-d') }}</dd>

                                <dt class="col-sm-3">Start Time</dt>
                                <dd class="col-sm-9">{{ $trainingSchedule->start_time }}</dd>

                                <dt class="col-sm-3">End Time</dt>
                                <dd class="col-sm-9">{{ $trainingSchedule->end_time }}</dd>

                                <dt class="col-sm-3">Coach</dt>
                                <dd class="col-sm-9">{{ $trainingSchedule->coach->name ?? 'N/A' }}</dd>

                                <dt class="col-sm-3">Created At</dt>
                                <dd class="col-sm-9">{{ $trainingSchedule->created_at->format('Y-m-d H:i:s') }}</dd>

                                <dt class="col-sm-3">Updated At</dt>
                                <dd class="col-sm-9">{{ $trainingSchedule->updated_at->format('Y-m-d H:i:s') }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
