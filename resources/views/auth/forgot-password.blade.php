<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Sleepy Panda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <style>
        body { background-color: #1a1a2e; color: white; height: 100vh; display: flex; align-items: center; justify-content: center; font-family: sans-serif; }
        .auth-card { width: 100%; max-width: 400px; padding: 40px 30px; border: 1px solid white; background-color: transparent; position: relative; }
        
        .logo-area { text-align: center; margin-bottom: 20px; }
        
        /* CSS Logo */
        .panda-logo-img {
            width: 100px;
            height: auto;
        }

        .lp-header { text-align: center; margin-bottom: 20px; }
        .lp-title { font-size: 1.5rem; font-weight: bold; margin-bottom: 10px; }
        .lp-desc { font-size: 0.8rem; color: #d1d1d1; line-height: 1.4; }
        .custom-input-group { background-color: #232a42; border-radius: 8px; padding: 5px 10px; display: flex; align-items: center; margin-bottom: 20px; }
        .custom-input-group i { color: #a0a0a0; margin-right: 10px; font-size: 1.1rem; }
        .form-control { background-color: transparent; border: none; color: white; box-shadow: none !important; }
        .form-control::placeholder { color: #6c757d; }
        .btn-teal { background-color: #008080; color: white; border: none; border-radius: 8px; padding: 12px; width: 100%; font-weight: 600; }
        .btn-teal:hover { background-color: #006666; color: white; }
        .alert-success { background: rgba(0, 128, 128, 0.2); border: 1px solid #008080; color: #aaffff; font-size: 0.85rem; text-align: center; margin-bottom: 20px; }
        .alert-danger { background: rgba(255,0,0,0.1); border: 1px solid #ff4444; color: #ffcccc; font-size: 0.85rem; padding: 10px; margin-bottom: 20px; text-align: center;}
    </style>
</head>
<body>

    <div class="auth-card">
        <div class="logo-area">
            <img src="{{ asset('images/sleepy panda.png') }}" alt="Sleepy Panda" class="panda-logo-img">
        </div>

        <div class="lp-header">
            <div class="lp-title">Lupa password?</div>
            <div class="lp-desc">
                Instruksi untuk melakukan reset password akan dikirim melalui email yang kamu gunakan untuk mendaftar
            </div>
        </div>

        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('password.email') }}" method="POST" autocomplete="off">
            @csrf
            <div class="custom-input-group">
                <i class="bi bi-envelope"></i>
                <input type="email" name="email" class="form-control" placeholder="serena@gmail.com" autocomplete="off">
            </div>
            <button type="submit" class="btn btn-teal">Reset Password</button>
        </form>
        <div class="text-center mt-3">
             <a href="{{ route('login') }}" style="color: #008080; text-decoration: none; font-size: 0.85rem;">Kembali ke Login</a>
        </div>
    </div>

</body>
</html>