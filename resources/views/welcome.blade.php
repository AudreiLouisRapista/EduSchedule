<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        /* --- General Reset & Fonts --- */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            /* The font in the image looks like a clean sans-serif */
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }

        /* --- Full Page Background --- */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background:
                linear-gradient(135deg, #8002ef, #2427e3);

            /* The main teal background color */
            padding: 20px;
        }

        /* --- Main Container (The rounded rectangle) --- */
        .login-container {
            width: 100%;
            max-width: 900px;
            /* Adjust max-width as needed */
            min-height: 550px;
            background-color: #FFFFFF;
            border-radius: 20px;
            /* Rounded corners for the whole card */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.63);
            display: flex;
            overflow: hidden;
            /* Crucial for clipping the left image/background */
        }

        /* --- Left Panel (Image/Content Area) --- */
        .left-panel {
            flex: 1;
            /* Adjust the width of the image section */
            max-width: 50%;
            position: relative;
            background:
                linear-gradient(135deg, #2427e3, #8002eff6),
                url('{{ asset('images/SHS.jpg') }}');


            /* Fallback/Base color for the left side */
            padding: 0;
            /* Remove padding from your original design */
        }

        .left-panel h1 {
            position: relative;
            z-index: 2;
            /* padding: 20px; */
            color: white;
            font-size: 36px;
            font-weight: 700;
            text-align: left;
            margin-left: 20px;
            margin-top: 150px;
            left: 130px;
            font-style: italic;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .left-panel-content .sub-text {
            /* position: relative; */
            /* z-index: 2; */
            padding: 30px;
            color: white;
            font-size: 15px;
            text-align: left;
            position: absolute;
            left: 10px;
            right: 40px;
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
        }

        .left-panel-content {
            /* This div contains the background image */
            position: absolute;
            top: 10px;
            left: 5px;
            right: 10px;
            bottom: 10px;
            border-radius: 15px;
            /* Inner rounding for the image panel */
            background:
                linear-gradient(135deg, rgba(36, 39, 227, 0.945), #8002efd8),
                url('{{ asset('images/SHS.jpg') }}');


            /* Replace with your actual image path or remove to use the background color */
            background-size: cover;
            background-position: center;
        }

        /* --- Right Panel (Login Form Area) --- */
        .right-panel {
            flex: 1;
            /* Adjust the width of the form section */
            max-width: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            padding: 40px;
        }

        /* The white, curved overlay on the right panel */
        .right-panel::before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: -50px;
            /* Adjust this value to control the curve's start point */
            width: 100px;
            /* Adjust width and border-radius together to control the curve */
            background-color: white;
            border-top-left-radius: 50px 50%;
            /* Top-left curve */
            border-bottom-left-radius: 50px 50%;
            /* Bottom-left curve */
            z-index: 1;
            /* A subtle shadow effect might be needed */
            box-shadow: -10px 0 15px rgba(0, 0, 0, 0.05);
        }

        .login-form-content {
            width: 100%;
            max-width: 350px;
            z-index: 2;
            /* Ensure content is above the pseudo-element curve */
        }

        /* --- Text and Headers --- */
        .login-form-content h2 {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 5px;
            text-align: center;
        }

        .login-form-content .sub-text {
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 30px;
            text-align: center;
        }

        /* --- Form Inputs (The rounded, icon-prefixed fields) --- */
        .input-group {
            margin-bottom: 15px;
        }

        .form-control {
            /* Make inputs very rounded */
            border-radius: 50px;
            padding: 12px 20px 12px 50px;
            /* Adjust left padding for icon */
            border: 1px solid #e0e0e0;
            box-shadow: none !important;
            /* Remove Bootstrap's default focus ring */
        }

        /* Style for the icons inside the input fields */
        .input-group-text {
            border-top-left-radius: 50px;
            border-bottom-left-radius: 50px;
            padding-left: 20px;
            background-color: transparent;
            border: none;
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            z-index: 5;
            color: #495057;
        }

        /* --- Forgot Password Link --- */
        .forgot-password {
            text-align: right;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .forgot-password a {
            color: #1b00a4;
            /* Match the primary teal color */
            text-decoration: none;
            font-weight: 500;
        }

        /* --- Login Button --- */
        .login-btn {
            width: 100%;
            padding: 12px;
            /* Teal to Cyan gradient from the image */

            background: linear-gradient(135deg, rgb(36, 39, 227), #5c00ddfb);

            color: white;
            border: none;
            border-radius: 50px;
            /* Very rounded button */
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(64, 1, 255, 0.4);
            transition: background 0.3s;
        }

        /* --- Sign Up Text --- */
        .signup-text {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
        }

        .signup-text a {
            color: #00877C;
            text-decoration: none;
            font-weight: 600;
        }

        /* --- Social Icons --- */
        .social-icons {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .social-icon-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 1px solid #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            transition: all 0.2s;
        }

        .social-icon-btn:hover {
            border-color: #4801b4;
            color: #4608b9;
        }

        /* --- Bottom Right Question Mark/Help Icon --- */
        .help-icon {
            position: absolute;
            bottom: 20px;
            right: 20px;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #D3D3D3;
            /* Light gray circle */
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
        }

        /* --- Media Queries for Responsiveness --- */
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                min-height: auto;
            }

            .left-panel {
                max-width: 100%;
                /* Optional: Keep a small height for the image on mobile */
                min-height: 200px;
            }

            .right-panel {
                max-width: 100%;
                padding: 40px 20px;
            }

            /* Remove the curved effect on mobile to save space */
            .right-panel::before {
                display: none;
            }


        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="left-panel">
            <div class="left-panel-content">
                <h1>Aethel</h1>
                <p class="sub-text">Aethel is the premier management system
                    engineered to
                    bring stability and
                    precision to your academic
                    planning. Instantly verify teacher loads,
                    eliminate scheduling conflicts, and guarantee
                    full subject
                    coverage across all sections.</p>
            </div>
        </div>

        <div class="right-panel">
            <div class="login-form-content">
                @include('layout.partials.alerts')

                <h2>Welcome</h2>
                <p class="sub-text">Log in to your account to continue</p>

                <form action="{{ route('auth_user') }}" method="POST">
                    @csrf

                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="awesome@user.com" required>
                    </div>

                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="••••••••••" required>
                    </div>

                    <div class="forgot-password">
                        <a href="#">Forgot your password?</a>
                    </div>

                    <button type="submit" class="login-btn">Log In</button>
                </form>
                <p style="text-align: center; margin-top: 30px;">Click the icons to meet the Developer</p>
                <div class="social-icons">

                    <a href="https://www.facebook.com/al.rapista" class="social-icon-btn"><i
                            class="fa-brands fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/a.lmongs/" class="social-icon-btn"><i
                            class="fa-brands fa-instagram"></i></a>
                    <a href="https://www.tiktok.com/@audreil43" class="social-icon-btn"><i
                            class="fa-brands fa-tiktok"></i></a>
                </div>



            </div>
        </div>
    </div>


</body>

</html>
