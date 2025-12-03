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
        body {
            font-family: Arial, sans-serif;
            background-color: #000000ff;

            background-image: url('backgournd.jpeg'); 
            background-size: cover;       
            background-repeat: no-repeat; 
            background-position: center; 
            
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            width: 100%;
            max-width: 500px;
             background: linear-gradient(90deg, #6fc3f7, #2563eb); 
            box-shadow: 0 4px 8px rgba(233, 230, 230, 0.1);
            border-radius: 8px;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #fffbfbff;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            font-size: 14px;
            margin-bottom: 5px;
            color: #fff4f4ff;
            
        }
        input[type="email"], input[type="password"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #000000ff;
           border-radius: 25px;
            font-size: 16px;
        }
        button {
            padding: 10px;
            font-size: 16px;
            color: white;
            background-color: #5cb85c;
            border: none;
            border-radius: 15px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #4cae4c;
        }
        .form-toggle {
            text-align: center;
            margin-top: 10px;
        }
        .form-toggle a {
            color: #00ff33ff;
            text-decoration: none;
            font-size: 14px;
        }
        .form-toggle a:hover {
            text-decoration: underline;
        }
        .form-container {
            display: none;
        }
        .form-container.active {
            display: block;
            color: white;
        }
        .gif-container {
            text-align: center;
            margin-bottom: 20px;
            
        }
        .gif-container img {
            max-width: 50%;
            height: 50;
        }
    </style>

</head>

<body>

<div class="container">
     @include('layout.partials.alerts')

    <h2><strong>Login</strong></h2>

    <!-- ✅ Laravel form -->
    <form action="{{ route('auth_user') }}" method="POST">
        @csrf
        
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
        

        
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
       

        <button type="submit" class="login-btn">Login</button>
</form>
       
</div>
</body>
</html>
