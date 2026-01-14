@extends('layouts.mastercoach')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">My Athletes - Coach: {{ Auth::user()->name }}</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Primary Sport</th>
                                    <th>Level</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($athletes as $athlete)
                                <tr>
                                    <td>{{ $athlete->name }}</td>
                                    <td>{{ $athlete->email }}</td>
                                    <td>{{ $athlete->primary_sport ?? 'Not specified' }}</td>
                                    <td>{{ $athlete->level ?? 'Not specified' }}</td>
                                    <td>
                                        <a href="{{ route('coach.athletes.show', $athlete) }}" class="btn btn-sm btn-info">View</a>
                                        <a href="{{ route('coach.athletes.edit', $athlete) }}" class="btn btn-sm btn-warning">Edit</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">No athletes assigned yet.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $athletes->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
