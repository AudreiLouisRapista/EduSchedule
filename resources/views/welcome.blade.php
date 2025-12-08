<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- ✅ Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
        }

        body {
            display: flex;
            height: 100vh;
        }

        .left-panel {
            flex: 1;
            background:
                linear-gradient(135deg, rgba(36, 39, 227, 0.914), rgba(122, 18, 241, 0.914)),
                url('{{ asset('images/SHS.jpg') }}');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .left-panel h1 {
            font-size: 36px;
            margin-bottom: 20px;
            margin-left: 30%;

        }

        .left-panel p {
            font-size: 18px;
            max-width: 400px;
            text-align: center;
            margin-left: 15%;

        }

        .right-panel {
            flex: 1;
            background-color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50px;
        }

        .login-box {
            width: 100%;
            max-width: 400px;
            padding: 40px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.353);
            border-radius: 15px;
        }

        .login-box h2 {
            margin-bottom: 10px;
            text-align: center;
        }

        .login-box p {
            margin-bottom: 20px;
            color: #666;
            font-size: 12px;
            text-align: center;

        }

        .login-box input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .login-box a {
            display: block;
            margin-bottom: 15px;
            color: #007BFF;
            text-decoration: none;
            font-size: 14px;
        }

        .login-box button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(90deg, #780ad8, #2563eb);
            color: white;
            border: none;
            border-radius: 15px;
            font-size: 16px;
            cursor: pointer;
        }

        .login-box .signup {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
        }

        .social-icons {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .social-icons img {
            width: 24px;
            height: 24px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="left-panel">
        <h1><strong>EduSched</strong></h1>
        <p>Manage your High school schedules, teachers, and subjects all in one place. Streamline your workflow
            and enhance educational planning.</p>
    </div>
    <div class="right-panel">
        <div class="login-box">
            @include('layout.partials.alerts')
            <h2>Welcome</h2>
            <p>Log in to your account to continue</p>
            <form action="{{ route('auth_user') }}" method="POST">
                @csrf

                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="awesome@gmail.com" required>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
                <button type="submit" class="login-btn">Login</button>

            </form>
        </div>
    </div>
</body>

</html>
