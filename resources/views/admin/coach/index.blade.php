@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Coach Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Coach Management</li>
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
                            <h3 class="card-title">Coaches List</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.coach.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Add New Coach
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Specialization</th>
                                        <th>Experience</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($coaches as $coach)
                                    <tr>
                                        <td>{{ $coach->id }}</td>
                                        <td>{{ $coach->name }}</td>
                                        <td>{{ $coach->email }}</td>
                                        <td>{{ $coach->specialization ?? 'General Training' }}</td>
                                        <td>{{ $coach->experience ?? 'N/A' }} years</td>
                                        <td>
                                            <span class="badge badge-success">Active</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.coach.show', $coach) }}" class="btn btn-sm btn-info">View</a>
                                            <a href="{{ route('admin.coach.edit', $coach) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('admin.coach.destroy', $coach) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this coach?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No coaches found.</td>
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
