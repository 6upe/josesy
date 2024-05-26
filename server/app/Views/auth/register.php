<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Josesy Dashboard Registration</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .centered-form {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .logo {
            display: block;
            margin: 0 auto 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="centered-form">
            <img src="<?= base_url() ?>assets/img/logo.png" width="50%" alt="Josesy Logo" class="logo">
            <h2 class="text-center text-mute lead">Welcome to Josesy Dashboard</h2>
            <?php if (session()->has('error')) : ?>
                <div class="alert alert-danger"><?= session('error') ?></div>
            <?php endif ?>
            <?php if (session()->has('success')) : ?>
                <div class="alert alert-success"><?= session('success') ?></div>
            <?php endif ?>
            <form action="/auth/register" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="firstname">First Name:</label>
                    <input type="text" id="firstname" name="firstname" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="lastname">Last Name:</label>
                    <input type="text" id="lastname" name="lastname" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="position">Position:</label>
                    <input type="text" id="position" name="position" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password_confirm">Confirm Password:</label>
                    <input type="password" id="password_confirm" name="password_confirm" class="form-control" required>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-outline-secondary w-100">Register</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
