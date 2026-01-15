<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jurnal Tidur - Sleepy Panda</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <style>
        /* --- STYLE GLOBAL --- */
        :root { --bg-dark: #1F1D2B; --bg-card: #252836; --text-main: #FFFFFF; --text-sub: #ABBBC2; --accent-pink: #EA7C69; --accent-blue: #6588F4; --border-color: #393C49; }
        body { background-color: var(--bg-dark); color: var(--text-main); font-family: 'Poppins', sans-serif; overflow-x: hidden; }
        
        /* SIDEBAR STYLE (Sama di semua file) */
        .sidebar { width: 250px; background-color: var(--bg-dark); min-height: 100vh; position: fixed; padding: 20px; border-right: 1px solid var(--bg-dark); z-index: 999; }
        .sidebar-title { color: var(--text-main); font-weight: 600; margin-bottom: 30px; font-size: 1.2rem; }
        .sidebar .btn-menu { border: 1px solid #383842; color: #A0A0A0; background: transparent; width: 100%; margin-bottom: 10px; border-radius: 8px; padding: 10px; text-align: center; text-decoration: none; display: block; transition: 0.3s; }
        .sidebar .btn-menu:hover { border-color: var(--accent-pink); color: var(--text-main); }
        .sidebar .btn-menu.active { border-color: #585866; background: #2D2D38; color: white; }
        
        /* CONTENT */
        .main-content { margin-left: 250px; padding: 20px 30px; }
        .top-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .logo-text { font-size: 1.5rem; font-weight: 700; margin-left: 10px;}
        .search-box { background-color: var(--bg-card); border: none; padding: 10px 20px; border-radius: 8px; color: white; width: 300px; }
        .user-avatar { width: 40px; height: 40px; background-color: #D9D9D9; border-radius: 50%; }

        /* --- JURNAL SPECIFIC --- */
        .jurnal-container { background-color: var(--bg-card); border-radius: 14px; padding: 30px; }
        .jurnal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        
        .sleep-card-small {
            background-color: var(--bg-dark);
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid var(--border-color);
        }
        .date-label { font-size: 0.8rem; color: #ABBBC2; margin-bottom: 10px; }
        .stat-row { display: flex; justify-content: space-between; align-items: center; font-size: 0.8rem; }
        .stat-item i { color: #EA7C69; margin-right: 5px; }

        canvas { max-height: 350px; }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-title">Admin Site</div>
        <a href="{{ route('dashboard') }}" class="btn btn-menu">Dashboard</a>
        <a href="{{ route('jurnal') }}" class="btn btn-menu active">Jurnal</a>
        <a href="{{ route('report') }}" class="btn btn-menu">Report</a>
        <a href="{{ route('user-data') }}" class="btn btn-menu">Database User</a>
        
        <form action="{{ route('logout') }}" method="POST" style="margin-top: auto; position: absolute; bottom: 20px; width: 80%;">
            @csrf
            <button class="btn btn-danger w-100" style="background-color: #EA7C69; border:none;">Logout</button>
        </form>
    </div>

    <div class="main-content">
        <div class="top-header">
            <div class="d-flex align-items-center">
                <img src="{{ asset('images/sleepy panda.png') }}" alt="Logo" width="40">
                <div class="logo-text">Sleepy Panda</div>
            </div>
            <div class="d-flex align-items-center gap-4">
                <div class="position-relative">
                    <i class="bi bi-search position-absolute" style="left: 10px; top: 10px; color: #ABBBC2;"></i>
                    <input type="text" class="search-box ps-5" placeholder="Search">
                </div>
                <div class="d-flex align-items-center gap-2">
                    <div class="text-end"><div style="font-size: 0.8rem; color: #ABBBC2;">Halo, {{ Auth::user()->name }}</div></div>
                    <div class="user-avatar"></div>
                </div>
            </div>
        </div>

        <div class="jurnal-container">
            <div class="jurnal-header">
                <h4 class="fw-bold">Jurnal Tidur Report</h4>
                <select class="form-select bg-dark text-white border-secondary w-auto">
                    <option>Daily</option>
                    <option>Weekly</option>
                    <option>Monthly</option>
                </select>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="sleep-card-small">
                        <div class="date-label">12 Agustus 2025</div>
                        <div class="stat-row">
                            <div class="stat-item"><i class="bi bi-moon-stars-fill"></i> Sleep: 7h 30m</div>
                            <div class="stat-item"><i class="bi bi-heart-pulse"></i> Deep: 4h</div>
                        </div>
                    </div>
                     <div class="sleep-card-small">
                        <div class="date-label">13 Agustus 2025</div>
                        <div class="stat-row">
                            <div class="stat-item"><i class="bi bi-moon-stars-fill"></i> Sleep: 6h 15m</div>
                            <div class="stat-item"><i class="bi bi-heart-pulse"></i> Deep: 3h</div>
                        </div>
                    </div>
                     <div class="sleep-card-small">
                        <div class="date-label">14 Agustus 2025</div>
                        <div class="stat-row">
                            <div class="stat-item"><i class="bi bi-moon-stars-fill"></i> Sleep: 8h 00m</div>
                            <div class="stat-item"><i class="bi bi-heart-pulse"></i> Deep: 5h</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <canvas id="jurnalChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Line Chart seperti di Screenshot Jurnal Daily
        new Chart(document.getElementById('jurnalChart'), {
            type: 'line',
            data: {
                labels: ['0', '10', '20', '30', '40', '50'], // Sumbu X
                datasets: [{
                    label: 'Users Sleep Quality',
                    data: [0, 100, 50, 20, 80, 200], // Data dummy mirip grafik
                    borderColor: '#F2C94C', // Warna Kuning Emas
                    backgroundColor: 'transparent',
                    borderWidth: 2,
                    pointBackgroundColor: '#F2C94C',
                    tension: 0
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { grid: { color: '#393C49' }, ticks: { color: '#ABBBC2' } },
                    x: { grid: { display: false }, ticks: { color: '#ABBBC2' } }
                }
            }
        });
    </script>
</body>
</html>