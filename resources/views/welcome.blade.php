<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sleepy Panda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #1a1a2e;
            color: white;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: sans-serif;
            margin: 0;
        }

        .welcome-card {
            width: 100%;
            max-width: 400px;
            height: 80vh;
            max-height: 700px;
            padding: 40px 30px;
            border: 1px solid white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
        }

        .logo-area {
            margin-bottom: auto;
            margin-top: auto;
            padding-top: 50px;
        }

        /* CSS Logo */
        .panda-logo-img {
            width: 180px;
            height: auto;
            margin-bottom: 10px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .brand-name {
            font-weight: bold;
            font-size: 1.8rem;
        }

        .bottom-area {
            width: 100%;
            margin-bottom: 50px;
        }

        .welcome-text {
            color: #d1d1d1;
            font-size: 0.95rem;
            margin-bottom: 30px;
            padding: 0 20px;
            line-height: 1.5;
        }

        .btn-masuk { background-color: #008080; color: white; border: none; border-radius: 8px; padding: 12px; width: 100%; font-weight: 600; display: block; margin-bottom: 15px; text-decoration: none; }
        .btn-masuk:hover { background-color: #006666; color: white; }
        .btn-daftar { background-color: white; color: #008080; border: none; border-radius: 8px; padding: 12px; width: 100%; font-weight: 600; display: block; text-decoration: none; }
        .btn-daftar:hover { background-color: #f0f0f0; color: #006666; }
    </style>
</head>
<body>

    <div class="welcome-card">
        <div class="logo-area">
            <img src="{{ asset('images/sleepy panda.png') }}" alt="Sleepy Panda" class="panda-logo-img">
            <div class="brand-name">Sleepy Panda</div>
        </div>

        <div class="bottom-area">
            <p class="welcome-text">
                Mulai dengan masuk atau mendaftar untuk melihat analisa tidur mu.
            </p>
            <a href="{{ route('login') }}" class="btn-masuk">Masuk</a>
            <a href="{{ route('register') }}" class="btn-daftar">Daftar</a>
        </div>
    </div>

</body>
</html>