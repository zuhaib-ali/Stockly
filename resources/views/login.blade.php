<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <title>Login</title>
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
                <h3 class="my-4 text-center">LOGIN</h3>
                <form action="{{ route('authenticate') }}" method="POST" class="form">
                    @csrf
                    <!-- Email -->
                    <div class="form-group">
                        <input type="email" placeholder="E-Mail" name="email" class="form-control" required> 
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <input type="password" placeholder="Password" name="password" class="form-control" required>
                    </div>

                    <!-- Role -->
                    <div class="form-group">
                        <select name="role" class='form-control' required>
                            <option value="" hidden disabled selected>-- Select Role --</option>
                            <option value="admin">Admin</option>
                            <option value="accountant">Accountant</option>
                            <option value="invester">Invester</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="form-control btn btn-primary" style="border-radius:15px; margin:none;" value="LOGIN">
                    </div>
                </form>
                <hr>
                <p class="text text-end">Don't have an account? <a href="{{ route('signup') }}">Sign up</a></p>
            </div>
        </div>        

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
        @if(Session::has('login_failed'))
            <script>
                toastr.error("{{ Session::get('login_failed') }}");
            </script>
        @endif

        @if($errors->any())
            @foreach($errors->all() as $error)
                <script>
                    toastr.error("{{ $error }}");
                </script>
            @endforeach
        @endif
</body>
</html>
