<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <title>Signup</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        ::placeholder{
            font-style:italic;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: ghostwhite;
        }

        .card{
            width:400px;
            border-radius:35px !important; 
            padding:15px;
        }

        .card-header{
            text-align:center;
        }

        .card-header, .card-footer{
            background-color:white;
        }
        .form-group{
            margin:30px 0px;
        }
    </style>
</head>
<body>
        <div class="card rounded-3">
            <!-- Card body -->
            <div class="card-body">
                <h3 class="my-4 text-center">SIGN UP</h3>
                <form action="" class="form">
                    <div class="form-group">
                        <input type="text" placeholder="Username" name="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="email" placeholder="E-Mail" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="Password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="Confirm Password" name="confirm_password" class="form-control">
                    </div>

                    <div class="form-group">
                        <input type="submit" class="form-control btn btn-primary" style="border-radius:15px; margin:none;" value="SIGN UP">
                    </div>
                </form>
                <p class="text text-end">Already have an account? <a href="{{ route('login') }}">Login</a></p>
            </div>
        </div>        

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
