<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database User - Sleepy Panda</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <style>
        :root { --bg-dark: #1F1D2B; --bg-card: #252836; --text-main: #FFFFFF; --text-sub: #ABBBC2; --accent-pink: #EA7C69; --border-color: #393C49; --badge-active-bg: rgba(101, 136, 244, 0.2); --badge-active-text: #6588F4; --badge-inactive-bg: rgba(234, 124, 105, 0.2); --badge-inactive-text: #EA7C69; }
        body { background-color: var(--bg-dark); color: var(--text-main); font-family: 'Poppins', sans-serif; overflow-x: hidden; }
        
        /* SIDEBAR */
        .sidebar { width: 250px; background-color: var(--bg-dark); min-height: 100vh; position: fixed; padding: 20px; border-right: 1px solid var(--bg-dark); z-index: 999; }
        .sidebar-title { color: var(--text-main); font-weight: 600; margin-bottom: 30px; font-size: 1.2rem; }
        .sidebar .btn-menu { border: 1px solid #383842; color: #A0A0A0; background: transparent; width: 100%; margin-bottom: 10px; border-radius: 8px; padding: 10px; text-align: center; text-decoration: none; display: block; transition: 0.3s; }
        .sidebar .btn-menu:hover { border-color: var(--accent-pink); color: var(--text-main); }
        .sidebar .btn-menu.active { border-color: #585866; background: #2D2D38; color: white; }

        .main-content { margin-left: 250px; padding: 20px 30px; }
        .top-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .logo-text { font-size: 1.5rem; font-weight: 700; margin-left: 10px;}
        .search-box { background-color: var(--bg-card); border: none; padding: 10px 20px; border-radius: 8px; color: white; width: 250px; }
        .user-avatar { width: 40px; height: 40px; background-color: #D9D9D9; border-radius: 50%; }

        /* TABLE SPECIFIC */
        .stat-card { background-color: var(--bg-card); border-radius: 12px; padding: 20px; display: flex; align-items: center; margin-bottom: 20px; }
        .stat-icon-wrapper { font-size: 2.5rem; margin-right: 15px; color: white; }
        
        .table-custom { width: 100%; border-collapse: separate; border-spacing: 0 10px; }
        .table-custom th { color: #ABBBC2; padding: 10px 15px; border-bottom: 1px solid var(--border-color); font-size: 0.9rem; }
        .table-custom td { background-color: var(--bg-card); padding: 15px; border-top: 1px solid var(--border-color); border-bottom: 1px solid var(--border-color); vertical-align: middle; }
        .table-custom tr td:first-child { border-left: 1px solid var(--border-color); border-top-left-radius: 12px; border-bottom-left-radius: 12px; }
        .table-custom tr td:last-child { border-right: 1px solid var(--border-color); border-top-right-radius: 12px; border-bottom-right-radius: 12px; }
        
        .user-info { display: flex; align-items: center; gap: 10px; }
        /* Inisial Nama Bulat */
        .user-pic-small { width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: white; font-size: 0.9rem;}
        .user-text .name { font-weight: 600; display: block; }
        .user-text .sub { font-size: 0.75rem; color: #ABBBC2; }

        .badge-status { padding: 5px 15px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; display: inline-block; }
        .badge-active { background-color: var(--badge-active-bg); color: var(--badge-active-text); }
        .badge-inactive { background-color: var(--badge-inactive-bg); color: var(--badge-inactive-text); }
        
        /* Warna Background acak untuk avatar inisial */
        .bg-primary { background-color: #6588F4 !important; }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-title">Admin Site</div>
        <a href="{{ route('dashboard') }}" class="btn btn-menu">Dashboard</a>
        <a href="{{ route('jurnal') }}" class="btn btn-menu">Jurnal</a>
        <a href="{{ route('report') }}" class="btn btn-menu">Report</a>
        <a href="{{ route('user-data') }}" class="btn btn-menu active">Database User</a>
        
        <a href="#" class="btn btn-menu">Update Data</a>
        <a href="#" class="btn btn-menu">Reset Password</a>

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

        <div class="row g-3">
            <div class="col-md-3"><div class="stat-card"><i class="bi bi-person stat-icon-wrapper"></i><div><small>Total Users</small><h3>{{ $users->count() }}</h3></div></div></div>
            <div class="col-md-3"><div class="stat-card"><i class="bi bi-person-check stat-icon-wrapper"></i><div><small>Active Users</small><h3>{{ $users->count() }}</h3></div></div></div>
            <div class="col-md-3"><div class="stat-card"><i class="bi bi-person-plus stat-icon-wrapper"></i><div><small>New Users</small><h3>+{{ $users->count() }}</h3></div></div></div>
            <div class="col-md-3"><div class="stat-card"><i class="bi bi-person-slash stat-icon-wrapper"></i><div><small>Inactive Users</small><h3>0</h3></div></div></div>
        </div>

        <table class="table-custom mt-4">
            <thead>
                <tr><th>User</th><th>Contact / Joined</th><th>Sleep Status</th><th>Status</th><th>Last Active</th><th>History</th></tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>
                        <div class="user-info">
                            <div class="user-pic-small bg-primary">{{ substr($user->name, 0, 1) }}</div>
                            <div class="user-text">
                                <span class="name">{{ $user->name }}</span>
                                <span class="sub">ID #{{ $user->id }}</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        {{ $user->email }} <br>
                        <small class="text-muted">Joined: {{ $user->created_at->format('d M Y') }}</small>
                    </td>
                    <td>
                        Avg Sleep: - <br> Quality: -
                    </td>
                    <td>
                        <span class="badge-status badge-active">Active</span>
                    </td>
                    <td>
                        {{ $user->updated_at->format('d M Y') }} <br>
                        <small>{{ $user->updated_at->format('H:i') }}</small>
                    </td>
                    <td>
                        <i class="bi bi-archive text-muted" style="cursor: pointer;"></i>
                    </td>
                </tr>
                @endforeach
                </tbody>
        </table>

    </div>
</body>
</html>