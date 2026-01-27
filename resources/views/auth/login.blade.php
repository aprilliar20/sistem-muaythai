<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Muaythai Camp</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #C40000;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100vh;
        }

        .banner {
            margin-top: 30px;
            padding: 12px 25px;
            background-color: #111;
            color: white;
            font-weight: bold;
            border-radius: 4px;
        }

        .login-container {
            margin-top: 40px;
            background-color: #B29D9D;
            padding: 40px 50px;
            border-radius: 4px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 6px;
            margin-top: 20px;
        }

        input {
            width: 100%;
            padding: 12px;
            font-size: 14px;
            margin-top: 5px;
            margin-bottom: 18px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #222;
            color: white;
            border: none;
            font-size: 15px;
            font-weight: bold;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            opacity: 0.9;
        }

        h2 {
            margin: 0 0 20px 0;
            font-size: 28px;
            font-weight: 700;
        }

        label {
            font-size: 14px;
            font-weight: 500;
        }
    </style>
</head>
<body>

    <div>
        <div class="banner">
            WELCOME TO INDEPENDENT MUAYTHAI CAMP
        </div>

        <div class="login-container">
            <h2>Login</h2>

            <div class="card">

        {{-- FLASH MESSAGE --}}
    @if ($errors->any())
        <div style="color: red;">
            {{ $errors->first() }}
        </div>
    @endif


    @if (session('success'))
        <div style="color: green; margin-bottom: 10px;">
            {{ session('success') }}
        </div>
    @endif

    <form action="/login" method="POST">
        @csrf

        <label>Email</label>
        <input type="text" name="email" placeholder="Email" value="{{ old('email') }}" required>


        <label>Password</label>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Sign In</button>
    </form>
</div>

                </form>
            </div>
        </div>
    </div>

</body>
</html>
 
