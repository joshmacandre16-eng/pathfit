@extends('layouts.masterathlete')

@section('title')
    Report Activity
@endsection

@section('body')
<div class="content-wrapper" style="margin-top: -10px;">
    <style>
        .report-container {
            padding: 1.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            max-width: 1200px;
            margin: 0 auto;
        }

        .report-header {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            margin-top: 2rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .report-header h1 {
            color: #667eea;
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .report-form {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .report-form h3 {
            color: #333;
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1rem;
            padding-bottom: 0.8rem;
            border-bottom: 3px solid #667eea;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
            font-weight: 500;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .btn-submit {
            background-color: #667eea;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
        }

        .btn-submit:hover {
            background-color: #5a67d8;
        }

        @media (max-width: 768px) {
            .report-container {
                padding: 1rem;
            }
        }
    </style>

    <div class="report-container">
        <div class="report-header">
            <h1>
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="#667eea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Report Activity
            </h1>
        </div>

        <div class="report-form">
            <h3>Submit Your Activity Report</h3>
            <form action="{{ route('user.report-activity.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="activity_date">Activity Date</label>
                    <input type="date" id="activity_date" name="activity_date" required>
                </div>

                <div class="form-group">
                    <label for="activity_type">Activity Type</label>
                    <select id="activity_type" name="activity_type" required>
                        <option value="">Select Activity Type</option>
                        <option value="training">Training Session</option>
                        <option value="competition">Competition</option>
                        <option value="practice">Practice</option>
                        <option value="recovery">Recovery</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="duration">Duration (minutes)</label>
                    <input type="number" id="duration" name="duration" min="1" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" placeholder="Describe the activity, your performance, any notes, etc." required></textarea>
                </div>

                <div class="form-group">
                    <label for="performance_rating">Performance Rating (1-10)</label>
                    <input type="number" id="performance_rating" name="performance_rating" min="1" max="10" required>
                </div>

                <button type="submit" class="btn-submit">Submit Report</button>
            </form>
        </div>
    </div>
</div>
@endsection
