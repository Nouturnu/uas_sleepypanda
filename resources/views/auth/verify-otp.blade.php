<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP - Sleepy Panda</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #1a1c2e; /* Warna Navy Khas Sleepy Panda */
            font-family: 'Quicksand', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: white;
        }
        .card {
            background-color: #25283d;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            width: 100%;
            max-width: 400px;
            text-align: center;
            border: 1px solid #3d415e;
        }
        .logo {
            width: 100px;
            margin-bottom: 20px;
        }
        h2 { margin-bottom: 10px; font-weight: 600; }
        p { color: #a0a4d0; font-size: 14px; margin-bottom: 30px; }
        
        .otp-input {
            background-color: #1a1c2e;
            border: 2px solid #3d415e;
            border-radius: 10px;
            color: #fff;
            font-size: 24px;
            padding: 15px;
            text-align: center;
            width: 80%;
            letter-spacing: 8px;
            outline: none;
            transition: border 0.3s;
        }
        .otp-input:focus { border-color: #7289da; }

        .btn-verify {
            background: linear-gradient(45deg, #4e54c8, #8f94fb);
            border: none;
            border-radius: 10px;
            color: white;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            margin-top: 25px;
            padding: 15px;
            width: 100%;
            transition: transform 0.2s;
        }
        .btn-verify:hover { transform: scale(1.02); }
        
        .alert {
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 13px;
        }
        .alert-success { background: rgba(75, 181, 67, 0.2); color: #4bb543; }
        .alert-error { background: rgba(255, 50, 50, 0.2); color: #ff3232; }
    </style>
</head>
<body>
    <div class="card">
        <img src="{{ asset('images/sleepy panda.png') }}" alt="Sleepy Panda" class="logo">
        
        <h2>Verifikasi OTP</h2>
        <p>Masukan 6 digit kode dari database untuk memvalidasi akun kamu.</p>

        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        @if($errors->has('otp_error'))
            <div class="alert alert-error">{{ $errors->first('otp_error') }}</div>
        @endif

        <form action="{{ route('otp.verify') }}" method="POST">
            @csrf
            <input type="text" name="otp_code" class="otp-input" maxlength="6" placeholder="000000" required autofocus autocomplete="off">
            <button type="submit" class="btn-verify">Verifikasi Sekarang</button>
        </form>
    </div>
</body>
</html>