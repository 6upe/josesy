<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Josesy Dashboard Login</title>
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
        /* Add spinner styles */
        .spinner-border {
            display: none;
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
            <form action="/auth/login" method="post" id="loginForm"> <!-- Add id to form -->
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <div class="form-group text-center">
                    <!-- Add spinner and hide it by default -->
                    <button type="submit" class="btn btn-outline-secondary w-100" id="loginBtn">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            // Intercept form submission
            $('#loginForm').submit(function(){
                // Show spinner when form is submitted
                $('#loginBtn').attr('disabled', true).find('.spinner-border').show();
            });

            // Reset button state after form submission
            $('#loginBtn').click(function(){
                // Reset button state when button is clicked
                $(this).attr('disabled', false).find('.spinner-border').hide();
            });
        });
    </script>
</body>
</html>
