<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rental Buku | Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css
    ">
</head>
<style>
    .main {
        height: 100vh;
        box-sizing: border-box;
    }
    body{
        background-color:rgb(255, 255, 255);
    }
    .register-box {
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
<body>
    <div class="main d-flex flex-column justify-content-center align-items-center">
        @if($errors->any())
            <div class="alert alert-danger" style="width:500px; margin-top:20px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('status'))
        <div class="alert alert-{{ session('status') }}" style="width:500px;">
            {{ session('message') }}
        </div>
        @endif
        <div class="register-box">
            <form action="" method="post">
                @csrf
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4 mt-4">Form Register</h1>
                </div>
                <div>
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="username" >
                </div>
                <div>
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" id="name" >
                </div>
                <div>
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" >
                </div>
                <div>
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" id="email" >
                </div>
                <div>
                    <label for="address" class="form-label">Address</label>
                    <textarea type="text" name="address" class="form-control" id="address" rows="3" ></textarea>
                </div>
                <div>
                    <button type="submit" style="background-color: #E26266"  class="btn btn-danger form-control">Register</button>
                </div>
                <div class="text-center">
                     <a class="sign" href="/login">Have Account?  Login</a>
                </div>
            </form>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js
"></script>
</body>
</html>