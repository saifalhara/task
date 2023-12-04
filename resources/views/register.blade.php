<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>register</title>
</head>
<script>
    function appear(message) {
        errorMessage.innerHTML = message;
        errorMessage.style.display = 'flex';
    }
</script>

<body class="d-flex align-items-center justify-content-center min-vh-100 bg-light">
    <div class="container col-md-6 bg-white rounded border border-2 p-3">
        <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link " id="tab-login" data-mdb-toggle="pill" href="login" role="tab" aria-controls="pills-login" aria-selected="true">Login</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="tab-register" data-mdb-toggle="pill" href="#pills-register" role="tab" aria-controls="pills-register" aria-selected="false">Register</a>
            </li>
        </ul>
        <form action="{{route('users/register')}}" method="POST">
            @csrf
            <div class="alert alert-danger mt-3" role="alert" id="errorMessage" style="display: none;">
                <?php if (isset($message)) : ?>
                    <script>
                        appear('<?php echo $message; ?>');
                    </script>
                <?php endif; ?>
            </div>
            <div class="form-outline mb-4">
                <label class="form-label" for="registerUsername">Username</label>
                <input type="text" id="registerUsername" name="userName" class="form-control" />
            </div>
            <div class="form-outline mb-4">
                <label class="form-label" for="registerEmail">Email</label>
                <input type="email" id="registerEmail" name="email" class="form-control" />
            </div>
            <div class="form-outline mb-4">
                <label class="form-label" for="registerPassword">Password</label>
                <input type="password" id="registerPassword" name="password" class="form-control" required />
            </div>
            <div class="form-outline mb-4">
                <label class="form-label" for="registerRepeatPassword">Repeat password</label>
                <input type="password" id="repeatPassword" name="repeatPassword" class="form-control" required />
            </div>
            <button type="submit" id="submit" onclick="checkPassword()" class="btn btn-primary btn-block mb-3">Sign up</button>
        </form>
    </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="{{asset ('js/register.js')}}" >
</script>
</html>
