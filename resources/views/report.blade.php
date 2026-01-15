<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report - Sleepy Panda</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <style>
        /* CSS GLOBAL SAMA SEPERTI DIATAS */
        :root { --bg-dark: #1F1D2B; --bg-card: #252836; --text-main: #FFFFFF; --text-sub: #ABBBC2; --accent-pink: #EA7C69; --border-color: #393C49; }
        body { background-color: var(--bg-dark); color: var(--text-main); font-family: 'Poppins', sans-serif; overflow-x: hidden; }
        
        .sidebar { width: 250px; background-color: var(--bg-dark); min-height: 100vh; position: fixed; padding: 20px; border-right: 1px solid var(--bg-dark); z-index: 999; }
        .sidebar-title { color: var(--text-main); font-weight: 600; margin-bottom: 30px; font-size: 1.2rem; }
        .sidebar .btn-menu { border: 1px solid #383842; color: #A0A0A0; background: transparent; width: 100%; margin-bottom: 10px; border-radius: 8px; padding: 10px; text-align: center; text-decoration: none; display: block; transition: 0.3s; }
        .sidebar .btn-menu:hover { border-color: var(--accent-pink); color: var(--text-main); }
        .sidebar .btn-menu.active { border-color: #585866; background: #2D2D38; color: white; }
        
        .main-content { margin-left: 250px; padding: 20px 30px; }
        .top-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .logo-text { font-size: 1.5rem; font-weight: 700; margin-left: 10px;}
        .search-box { background-color: var(--bg-card); border: none; padding: 10px 20px; border-radius: 8px; color: white; width: 300px; }
        .user-avatar { width: 40px; height: 40px; background-color: #D9D9D9; border-radius: 50%; }

        /* REPORT SPECIFIC */
        .report-card { background-color: var(--bg-card); border-radius: 12px; padding: 20px; margin-bottom: 15px; display: flex; align-items: center; justify-content: space-between; border: 1px solid var(--border-color); }
        .report-icon { font-size: 2rem; color: var(--accent-pink); margin-right: 15px; }
        .btn-download { background-color: transparent; border: 1px solid var(--accent-pink); color: var(--accent-pink); padding: 5px 20px; border-radius: 8px; }
        .btn-download:hover { background-color: var(--accent-pink); color: white; }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-title">Admin Site</div>
        <a href="{{ route('dashboard') }}" class="btn btn-menu">Dashboard</a>
        <a href="{{ route('jurnal') }}" class="btn btn-menu">Jurnal</a>
        <a href="{{ route('report') }}" class="btn btn-menu active">Report</a>
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
                    <input type="text" class="search-box ps-5" placeholder="Search Report">
                </div>
                <div class="d-flex align-items-center gap-2">
                    <div class="text-end"><div style="font-size: 0.8rem; color: #ABBBC2;">Halo, {{ Auth::user()->name }}</div></div>
                    <div class="user-avatar"></div>
                </div>
            </div>
        </div>

        <h3 class="mb-4">Generated Reports</h3>

        <div class="report-card">
            <div class="d-flex align-items-center">
                <i class="bi bi-file-earmark-pdf report-icon"></i>
                <div>
                    <h5 class="mb-0">Monthly User Activity - Jan 2026</h5>
                    <small style="color: #ABBBC2;">Generated on: 31 Jan 2026</small>
                </div>
            </div>
            <button class="btn-download">Download PDF</button>
        </div>

        <div class="report-card">
            <div class="d-flex align-items-center">
                <i class="bi bi-file-earmark-spreadsheet report-icon text-success"></i>
                <div>
                    <h5 class="mb-0">Sleep Quality Analysis - Q4 2025</h5>
                    <small style="color: #ABBBC2;">Generated on: 15 Jan 2026</small>
                </div>
            </div>
            <button class="btn-download text-success border-success">Download Excel</button>
        </div>

        <div class="report-card">
            <div class="d-flex align-items-center">
                <i class="bi bi-file-earmark-bar-graph report-icon text-primary"></i>
                <div>
                    <h5 class="mb-0">System Performance Log</h5>
                    <small style="color: #ABBBC2;">Generated on: 10 Jan 2026</small>
                </div>
            </div>
            <button class="btn-download text-primary border-primary">Download CSV</button>
        </div>

    </div>
</body>
</html>