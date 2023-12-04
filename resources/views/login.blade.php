<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>login</title>
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
                <a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="login" role="tab" aria-controls="pills-login" aria-selected="true">Login</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="tab-register" data-mdb-toggle="pill" href="register" role="tab" aria-controls="pills-register" aria-selected="false">Register</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                <form method="POST" action="{{ route('users/login') }}">
                    @csrf
                    <div class="alert alert-danger mt-3" role="alert" id="errorMessage" style="display:none;">
                        <?php if (isset($message)) : ?>
                            <script>appear('<?php echo $message?>')</script>
                        <?php endif; ?>
                    </div>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="loginName">Email</label>
                        <input type="email" id="loginName" name="email" class="form-control" />
                    </div>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="loginPassword">Password</label>
                        <input type="password" name="password" id="loginPassword" class="form-control" required autocomplete="current-password">
                    </div>
                    <div class="row mb-4">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
                    <div class="text-center">
                        <p>Not a member? <a href="register">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
</body>
</html>
