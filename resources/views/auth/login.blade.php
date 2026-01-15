<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Sleepy Panda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <style>
        body { background-color: #1a1a2e; color: white; height: 100vh; display: flex; align-items: center; justify-content: center; font-family: sans-serif; }
        .auth-card { width: 100%; max-width: 400px; padding: 40px 30px; border: 1px solid white; background-color: transparent; position: relative; }
        
        .logo-area { text-align: center; margin-bottom: 30px; }
        
        /* CSS Logo */
        .panda-logo-img {
            width: 130px;
            height: auto;
            margin-bottom: 5px;
        }

        .brand-name { font-weight: bold; font-size: 1.5rem; margin-top: 5px; }
        .sub-title { color: #d1d1d1; font-size: 0.9rem; margin-top: 15px; }
        
        .form-group { margin-bottom: 20px; }
        .custom-input-group { background-color: #232a42; border-radius: 8px; padding: 5px 10px; display: flex; align-items: center; }
        .custom-input-group i { color: #a0a0a0; margin-right: 10px; font-size: 1.1rem; }
        .form-control { background-color: transparent; border: none; color: white; box-shadow: none !important; }
        .form-control::placeholder { color: #6c757d; }
        
        .btn-teal { background-color: #008080; color: white; border: none; border-radius: 8px; padding: 12px; width: 100%; font-weight: 600; margin-top: 20px; }
        .btn-teal:hover { background-color: #006666; color: white; }
        
        .footer-link { text-align: center; margin-top: 20px; font-size: 0.8rem; color: #a0a0a0; }
        .footer-link a { color: #008080; text-decoration: none; }
        .alert-danger { background: rgba(255,0,0,0.1); border: 1px solid #ff4444; color: #ffcccc; font-size: 0.85rem; padding: 10px; margin-bottom: 20px; }
        .forgot-link { display: block; text-align: right; font-size: 0.75rem; color: #008080; margin-top: 5px; text-decoration: none; }
    </style>
</head>
<body>

    <div class="auth-card">
        <div class="logo-area">
            <img src="{{ asset('images/sleepy panda.png') }}" alt="Sleepy Panda" class="panda-logo-img">
            
            <div class="brand-name">Sleepy Panda</div>
            <div class="sub-title">Masuk menggunakan akun yang sudah kamu daftarkan</div>
        </div>

        @if($errors->any())
            <div class="alert alert-danger text-center">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" autocomplete="off">
            @csrf
            <div class="form-group custom-input-group">
                <i class="bi bi-envelope"></i>
                <input type="email" name="email" class="form-control" placeholder="Email" autocomplete="off">
            </div>
            <div class="mb-3">
                <div class="custom-input-group">
                    <i class="bi bi-lock"></i>
                    <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="new-password">
                </div>
                <a href="{{ route('password.request') }}" class="forgot-link">Lupa password?</a>
            </div>
            <button type="submit" class="btn btn-teal">Masuk</button>
        </form>
        <div class="footer-link">
            Belum punya akun? <a href="{{ route('register') }}">Daftar disini</a>
        </div>
    </div>

</body>
</html>