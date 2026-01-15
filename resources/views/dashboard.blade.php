<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sleepy Panda - Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <style>
        :root {
            --bg-dark: #1F1D2B;       /* Background Utama */
            --bg-card: #252836;       /* Background Card/Sidebar */
            --text-main: #FFFFFF;
            --text-sub: #ABBBC2;
            --accent-pink: #EA7C69;   /* Warna Grafik Cewek */
            --accent-blue: #6588F4;   /* Warna Grafik Cowok */
            --border-color: #393C49;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-main);
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        /* --- SIDEBAR --- */
        .sidebar {
            width: 250px;
            background-color: var(--bg-dark); /* Sesuai gambar, sidebar warnanya nyatu sama bg */
            min-height: 100vh;
            position: fixed;
            padding: 20px;
            border-right: 1px solid var(--bg-dark); /* Invisible border */
        }

        .sidebar-title {
            color: var(--text-main);
            font-weight: 600;
            margin-bottom: 30px;
            font-size: 1.2rem;
        }

        /* Style Tombol Sidebar */
        .sidebar .btn-menu {
            border: 1px solid #383842;
            color: #A0A0A0;
            background: transparent;
            width: 100%;
            margin-bottom: 10px;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            text-decoration: none; /* Hilangkan garis bawah link */
            display: block;        /* Agar tombol full width */
            transition: 0.3s;
        }
        
        .sidebar .btn-menu:hover {
            border-color: var(--accent-pink);
            color: var(--text-main);
        }

        /* Status Active */
        .sidebar .btn-menu.active {
            border-color: #585866;
            background: #2D2D38; /* Agak terang dikit */
            color: white;
        }

        /* --- MAIN CONTENT --- */
        .main-content {
            margin-left: 250px;
            padding: 20px 30px;
        }

        /* --- TOP HEADER --- */
        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .logo-section img {
            width: 40px;
            margin-right: 10px;
        }
        .logo-text {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .search-box {
            background-color: var(--bg-card);
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            color: white;
            width: 300px;
        }
        
        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .user-avatar {
            width: 40px;
            height: 40px;
            background-color: #D9D9D9;
            border-radius: 50%;
        }

        /* --- CARDS & CHARTS --- */
        .custom-card {
            background-color: var(--bg-card);
            border-radius: 14px;
            padding: 20px;
            height: 100%;
        }

        .card-title-text {
            font-size: 0.9rem;
            color: var(--text-main);
            margin-bottom: 15px;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 600;
            margin-left: 10px;
        }
        
        .stat-icon {
            font-size: 2rem;
            color: var(--text-sub);
        }

        /* Adjust chart height */
        canvas {
            max-height: 150px; 
        }
        .big-chart canvas {
            max-height: 250px;
        }

        .legend-indicator {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-title">Admin Site</div>
        
        <a href="{{ route('dashboard') }}" 
           class="btn btn-menu {{ Request::routeIs('dashboard') ? 'active' : '' }}">
           Dashboard
        </a>

        <a href="{{ route('jurnal') }}" 
           class="btn btn-menu {{ Request::routeIs('jurnal') ? 'active' : '' }}">
           Jurnal
        </a>

        <a href="{{ route('report') }}" 
           class="btn btn-menu {{ Request::routeIs('report') ? 'active' : '' }}">
           Report
        </a>

        <a href="{{ route('user-data') }}" 
           class="btn btn-menu {{ Request::routeIs('user-data') ? 'active' : '' }}">
           Database User
        </a>
        
        <form action="{{ route('logout') }}" method="POST" style="margin-top: auto; position: absolute; bottom: 20px; width: 80%;">
            @csrf
            <button class="btn btn-danger w-100" style="background-color: #EA7C69; border:none;">Logout</button>
        </form>
    </div>

    <div class="main-content">
        
        <div class="top-header">
            <div class="logo-section d-flex align-items-center">
                <img src="{{ asset('images/sleepy panda.png') }}" alt="Logo">
                <div class="logo-text">Sleepy Panda</div>
            </div>
            
            <div class="d-flex align-items-center gap-4">
                <div class="position-relative">
                    <i class="bi bi-search position-absolute" style="left: 10px; top: 10px; color: #ABBBC2;"></i>
                    <input type="text" class="search-box ps-5" placeholder="Search">
                </div>
                
                <div class="user-profile">
                    <div class="text-end me-2">
                        <div style="font-size: 0.8rem; color: #ABBBC2;">Halo, {{ Auth::user()->name }}</div>
                    </div>
                    <div class="user-avatar"></div>
                </div>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="custom-card">
                    <div class="d-flex justify-content-between mb-2">
                        <div class="card-title-text">Daily Report</div>
                        <div style="font-size: 0.7rem;">
                            <span class="legend-indicator" style="background: #EA7C69;"></span>Female
                            <span class="legend-indicator ms-2" style="background: #6588F4;"></span>Male
                        </div>
                    </div>
                    <canvas id="dailyChart"></canvas>
                </div>
            </div>
            <div class="col-md-4">
                <div class="custom-card">
                    <div class="d-flex justify-content-between mb-2">
                        <div class="card-title-text">Weekly Report</div>
                        <div style="font-size: 0.7rem;">
                             <span class="legend-indicator" style="background: #EA7C69;"></span>Female
                            <span class="legend-indicator ms-2" style="background: #6588F4;"></span>Male
                        </div>
                    </div>
                    <canvas id="weeklyChart"></canvas>
                </div>
            </div>
            <div class="col-md-4">
                <div class="custom-card">
                    <div class="d-flex justify-content-between mb-2">
                        <div class="card-title-text">Monthly Report</div>
                        <div style="font-size: 0.7rem;">
                             <span class="legend-indicator" style="background: #EA7C69;"></span>Female
                            <span class="legend-indicator ms-2" style="background: #6588F4;"></span>Male
                        </div>
                    </div>
                    <canvas id="monthlyChart"></canvas>
                </div>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="custom-card d-flex align-items-center">
                    <i class="bi bi-person stat-icon"></i>
                    <div>
                        <div class="text-sub ms-2" style="font-size: 0.8rem; color: #ABBBC2;">Total Users</div>
                        <div class="stat-number">4500</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="custom-card d-flex align-items-center">
                    <i class="bi bi-person stat-icon"></i>
                    <div>
                        <div class="text-sub ms-2" style="font-size: 0.8rem; color: #ABBBC2;">Female Users</div>
                        <div class="stat-number">2000</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="custom-card d-flex align-items-center">
                    <i class="bi bi-person stat-icon"></i>
                    <div>
                        <div class="text-sub ms-2" style="font-size: 0.8rem; color: #ABBBC2;">Male Users</div>
                        <div class="stat-number">2500</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="custom-card d-flex align-items-center">
                    <i class="bi bi-clock stat-icon"></i>
                    <div>
                        <div class="text-sub ms-2" style="font-size: 0.8rem; color: #ABBBC2;">Average Time</div>
                        <div class="stat-number">154.25</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="custom-card">
                    <div class="card-title-text">Average Users Sleep Time</div>
                    <div style="font-size: 0.7rem; margin-bottom: 10px;">
                        <span class="legend-indicator" style="background: #EA7C69;"></span>Female
                        <span class="legend-indicator ms-2" style="background: #6588F4;"></span>Male
                    </div>
                    <div class="big-chart">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // --- KONFIGURASI GRAFIK ---
        
        const commonOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } }, 
            scales: {
                y: { 
                    beginAtZero: true, 
                    grid: { color: '#393C49' },
                    ticks: { color: '#ABBBC2', font: {size: 10} }
                },
                x: { 
                    grid: { display: false },
                    ticks: { color: '#ABBBC2', font: {size: 10} }
                }
            }
        };

        // 1. Daily Chart
        new Chart(document.getElementById('dailyChart'), {
            type: 'bar',
            data: {
                labels: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                datasets: [
                    { data: [50, 40, 60, 80, 50, 60, 40], backgroundColor: '#EA7C69', borderRadius: 4, barPercentage: 0.6 },
                    { data: [30, 50, 40, 60, 40, 30, 20], backgroundColor: '#6588F4', borderRadius: 4, barPercentage: 0.6 }
                ]
            },
            options: commonOptions
        });

        // 2. Weekly Chart
        new Chart(document.getElementById('weeklyChart'), {
            type: 'bar',
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                datasets: [
                    { data: [200, 150, 300, 250], backgroundColor: '#EA7C69', borderRadius: 4, barPercentage: 0.5 },
                    { data: [150, 200, 250, 350], backgroundColor: '#6588F4', borderRadius: 4, barPercentage: 0.5 }
                ]
            },
            options: commonOptions
        });

        // 3. Monthly Chart
        new Chart(document.getElementById('monthlyChart'), {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
                datasets: [
                    { data: [500, 600, 400, 700, 600, 500, 600, 450, 500, 600], backgroundColor: '#EA7C69', borderRadius: 4, barPercentage: 0.6 },
                    { data: [400, 500, 300, 600, 500, 400, 500, 400, 450, 550], backgroundColor: '#6588F4', borderRadius: 4, barPercentage: 0.6 }
                ]
            },
            options: commonOptions
        });

        // 4. Line Chart
        new Chart(document.getElementById('lineChart'), {
            type: 'line',
            data: {
                labels: ['Jan 01', 'Jan 02', 'Jan 03', 'Jan 04', 'Jan 05', 'Jan 06'],
                datasets: [
                    { 
                        label: 'Female', data: [20, 40, 30, 50, 40, 60], 
                        borderColor: '#EA7C69', backgroundColor: '#EA7C69', tension: 0.4, pointRadius: 0
                    },
                    { 
                        label: 'Male', data: [10, 20, 40, 30, 60, 50], 
                        borderColor: '#6588F4', backgroundColor: '#6588F4', tension: 0.4, pointRadius: 0
                    }
                ]
            },
            options: {
                ...commonOptions,
                scales: {
                    y: { display: false },
                    x: { 
                        grid: { display: false },
                        ticks: { color: '#ABBBC2' }
                    }
                }
            }
        });
    </script>
</body>
</html>