@extends('layouts.masterathlete')

@section('title')
    Training Schedule
@endsection

@section('content')
<div class="content">
    <style>
        .schedule-container {
            padding: 1.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            max-width: 1200px;
            margin: 0 auto;
        }

        .schedule-header {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            margin-top: 2rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .schedule-header h1 {
            color: #667eea;
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .schedule-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .schedule-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .schedule-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .schedule-card h3 {
            color: #667eea;
            font-size: 1.2rem;
            font-weight: 600;
            margin: 0 0 0.5rem 0;
        }

        .schedule-card .date {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .schedule-card .time {
            color: #333;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .schedule-card .description {
            color: #555;
            font-size: 0.9rem;
            line-height: 1.4;
        }

        .no-schedules {
            text-align: center;
            color: white;
            font-size: 1.2rem;
            padding: 3rem;
        }

        .no-schedules i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.7;
        }
    </style>

    <div class="schedule-container">
        <div class="schedule-header">
            <h1>
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2L13.09 8.26L19 9L13.09 9.74L12 16L10.91 9.74L5 9L10.91 8.26L12 2Z" stroke="#667eea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M19 15H18C17.45 15 17 15.45 17 16V20C17 20.55 17.45 21 18 21H22C22.55 21 23 20.55 23 20V16C23 15.45 22.55 15 22 15H21" stroke="#667eea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M21 15V13C21 11.9 20.1 11 19 11H17C15.9 11 15 11.9 15 13V15" stroke="#667eea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                My Training Schedule
            </h1>
        </div>

        @if($trainingSchedules->count() > 0)
            <div class="schedule-grid">
                @foreach($trainingSchedules as $schedule)
                    <div class="schedule-card">
                        <h3>{{ $schedule->title }}</h3>
                        <div class="date">
                            <i class="fas fa-calendar-alt"></i>
                            {{ \Carbon\Carbon::parse($schedule->date)->format('F j, Y') }}
                        </div>
                        <div class="time">
                            <i class="fas fa-clock"></i>
                            {{ \Carbon\Carbon::parse($schedule->start_time)->format('g:i A') }} -
                            {{ \Carbon\Carbon::parse($schedule->end_time)->format('g:i A') }}
                        </div>
                        @if($schedule->description)
                            <div class="description">
                                <i class="fas fa-info-circle"></i>
                                {{ $schedule->description }}
                            </div>
                        @endif
                        @if($schedule->coach)
                            <div class="coach-info" style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #eee;">
                                <small style="color: #666;">
                                    <i class="fas fa-user-tie"></i>
                                    Coach: {{ $schedule->coach->name }}
                                </small>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="no-schedules">
                <i class="fas fa-calendar-times"></i>
                <h3>No Training Schedules Found</h3>
                <p>You don't have any training schedules assigned yet. Contact your coach to get started!</p>
            </div>
        @endif
    </div>
</div>
@endsection
