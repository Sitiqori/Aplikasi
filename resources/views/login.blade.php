<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css
    ">
    <title>Rental Buku | Login</title>
    <style>
        .main {
            height: 100vh;
            box-sizing: border-box;
        }
        body{
            background-color:rgb(255, 255, 255);
        }
        .login-box {
            width: 500px;
            background-color: #EEEFE1;
            border-radius: 20px;
            padding: 30px;
        }
        form div{
            margin-bottom: 15px;
        }
        .sign{
            color: black ;
            text-decoration: none;
        }
    </style>
</head> 
<body>
    <div class="main d-flex flex-column justify-content-center align-items-center">
        @if (session('status'))
            <div class="alert alert-{{ session('status') }}">
                {{ session('message') }}
            </div>
        @endif
        <div class="login-box">
            <form action="login" method="post">
                @csrf
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4 mt-4">Form Login</h1>
                </div>
                <div>
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" id="email" required>
                </div>
                <div>
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>
                <div>
                    <button type="submit" style="background-color: #E26266"  class="btn btn-danger form-control">Login</button>
                </div>
                <div class="text-center">
                    <a class="sign" href="/register">Don't have account?  Sign Up</a>
                </div>
            </form>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js
"></script>
</body>
</html>