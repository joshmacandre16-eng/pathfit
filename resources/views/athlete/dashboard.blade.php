@extends('layouts.masterathlete')

@section('title')
    Athlete Dashboard
@endsection

@section('body')
<div class="content-wrapper" style="margin-top: -10px;">
    <style>
        .dashboard-container {
            padding: 1.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            max-width: 1200px;
            margin: 0 auto;
        }

        .dashboard-header {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            margin-top: 2rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .dashboard-header h1 {
            color: #667eea;
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .welcome-message {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .welcome-message h2 {
            margin: 0 0 0.5rem 0;
            font-size: 1.5rem;
        }

        .welcome-message p {
            margin: 0;
            opacity: 0.9;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-top: 1rem;
        }

        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1rem;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .stat-card h4 {
            font-size: 0.85rem;
            font-weight: 500;
            margin: 0 0 0.5rem 0;
            opacity: 0.9;
        }

        .stat-card .value {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
        }

        .stat-card .icon {
            font-size: 1.5rem;
            margin-bottom: 0.3rem;
        }

        .charts-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .chart-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        .chart-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .chart-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
        }

        .chart-card h3 {
            color: #333;
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1rem;
            padding-bottom: 0.8rem;
            border-bottom: 3px solid #667eea;
        }

        .chart-container {
            position: relative;
            height: 280px;
        }

        .chart-container-small {
            position: relative;
            height: 250px;
        }

        .full-width-chart {
            grid-column: 1 / -1;
        }

        @media (max-width: 1250px) {
            .dashboard-container {
                max-width: 100%;
                padding: 1rem;
            }
            
            .chart-row {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .dashboard-header h1 {
                font-size: 1.5rem;
                flex-direction: column;
                align-items: flex-start;
            }

            .chart-container,
            .chart-container-small {
                height: 250px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Loading animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .chart-card, .stat-card {
            animation: fadeIn 0.5s ease-out forwards;
            opacity: 0;
        }

        .stat-card:nth-child(1) { animation-delay: 0.05s; }
        .stat-card:nth-child(2) { animation-delay: 0.1s; }
        .stat-card:nth-child(3) { animation-delay: 0.15s; }
        .chart-card:nth-child(1) { animation-delay: 0.2s; }
        .chart-card:nth-child(2) { animation-delay: 0.25s; }
        .chart-card:nth-child(3) { animation-delay: 0.3s; }
    </style>

    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1>
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20 7L12 3L4 7M20 7L12 11M20 7V17L12 21M12 11L4 7M12 11V21M4 7V17L12 21" stroke="#667eea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Athlete Performance Dashboard
            </h1>


        </div>

        <div class="welcome-message">
            <h2>Welcome back, Athlete {{ $user->name }}! 🏃‍♂️</h2>
            <p>Track your progress, view your training sessions, and achieve your goals.</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="icon">🏃‍♂️</div>
                <h4>Training Sessions</h4>
                <div class="value">24</div>
            </div>
            <div class="stat-card">
                <div class="icon">🏆</div>
                <h4>Personal Bests</h4>
                <div class="value">8</div>
            </div>
            <div class="stat-card">
                <div class="icon">📈</div>
                <h4>Performance Score</h4>
                <div class="value">92%</div>
            </div>
        </div>

        <div class="charts-grid">
            <div class="chart-card full-width-chart">
                <h3>📈  Training Progress</h3>
                <div class="chart-container">
                    <canvas id="barChart"></canvas>
                </div>
            </div>

            <div class="chart-row">
                <div class="chart-card">
                    <h3>🎯 Goal Achievement</h3>
                    <div class="chart-container-small">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>

                <div class="chart-card">
                    <h3>📊 Performance Trend</h3>
                    <div class="chart-container-small">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Bar Chart - Training Progress
        const barCtx = document.getElementById('barChart').getContext('2d');
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5', 'Week 6'],
                datasets: [{
                    label: 'Training Hours',
                    data: [8, 12, 10, 15, 18, 20],
                    backgroundColor: 'rgba(102, 126, 234, 0.8)',
                    borderColor: 'rgba(102, 126, 234, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Pie Chart - Goal Achievement
        const pieCtx = document.getElementById('pieChart').getContext('2d');
        new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: ['Completed', 'In Progress', 'Not Started'],
                datasets: [{
                    data: [65, 25, 10],
                    backgroundColor: [
                        'rgba(102, 126, 234, 0.8)',
                        'rgba(118, 75, 162, 0.8)',
                        'rgba(255, 193, 7, 0.8)'
                    ],
                    borderColor: [
                        'rgba(102, 126, 234, 1)',
                        'rgba(118, 75, 162, 1)',
                        'rgba(255, 193, 7, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Line Chart - Performance Trend
        const lineCtx = document.getElementById('lineChart').getContext('2d');
        new Chart(lineCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Performance Score',
                    data: [75, 78, 82, 85, 88, 92],
                    backgroundColor: 'rgba(102, 126, 234, 0.2)',
                    borderColor: 'rgba(102, 126, 234, 1)',
                    borderWidth: 2,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });
    </script>

</div>
@endsection
