<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(120deg, #fff0f3 0%, #f8d7da 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: linear-gradient(120deg, #fff0f3 60%, #f8d7da 100%);
            padding: 48px 36px 36px 36px;
            border-radius: 24px;
            box-shadow: 0 12px 40px #b23b3b22, 0 2px 12px #fff0f3cc;
            width: 100%;
            max-width: 410px;
            border: 2px solid #b23b3b22;
            position: relative;
        }
        .login-header {
            text-align: center;
            margin-bottom: 28px;
        }
        .login-header h1 {
            font-size: 32px;
            font-family: Georgia, serif;
            font-weight: bold;
            color: #b23b3b;
            letter-spacing: 2px;
            text-shadow: 0 2px 12px #fff0f3cc;
            margin-bottom: 8px;
        }
        .login-header p {
            color: #b23b3bcc;
            font-family: Georgia, serif;
            font-size: 17px;
        }
        .form-group {
            margin-bottom: 18px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #b23b3b;
            font-family: Georgia, serif;
            letter-spacing: 0.5px;
        }
        .form-control {
            width: 100%;
            padding: 13px 14px;
            border: 1.5px solid #f8d7da;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 16px;
            font-family: Georgia, serif;
            background: #fff;
            transition: border 0.2s, box-shadow 0.2s;
        }
        .form-control:focus {
            outline: none;
            border-color: #b23b3b;
            box-shadow: 0 0 0 3px #f8d7da88;
        }
        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(90deg, #b23b3b 60%, #f8d7da 100%);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 18px;
            font-family: Georgia, serif;
            font-weight: bold;
            letter-spacing: 1px;
            cursor: pointer;
            box-shadow: 0 2px 8px #b23b3b22;
            transition: background 0.2s, box-shadow 0.2s, transform 0.2s;
        }
        .btn-login:hover {
            background: linear-gradient(90deg, #b23b3b 80%, #f8d7da 100%);
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 8px 24px #b23b3b33;
        }
        .alert {
            padding: 12px;
            margin-bottom: 18px;
            border-radius: 8px;
            background-color: #fee2e2;
            color: #b23b3b;
            border: 1.5px solid #f8d7da;
            font-family: Georgia, serif;
            font-size: 15px;
        }
        .login-footer {
            text-align: center;
            margin-top: 28px;
        }
        .login-footer a {
            color: #b23b3b;
            text-decoration: none;
            font-family: Georgia, serif;
            font-weight: bold;
            letter-spacing: 0.5px;
            transition: color 0.2s;
        }
        .login-footer a:hover {
            text-decoration: underline;
            color: #a12727;
        }
        @media (max-width: 500px) {
            .login-container {
                padding: 28px 8px 18px 8px;
                border-radius: 14px;
            }
            .login-header h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Admin Login</h1>
            <p>Silakan masuk untuk melanjutkan</p>
        </div>

        <?php if (session()->getFlashdata('flash_msg')): ?>
            <div class="alert">
                <?= session()->getFlashdata('flash_msg') ?>
            </div>
        <?php endif; ?>

        <form action="" method="post">
            <div class="form-group">
                <label for="InputForEmail">Email</label>
                <input type="email" name="email" class="form-control" id="InputForEmail"
                       value="<?= set_value('email') ?>" required>
            </div>
            <div class="form-group">
                <label for="InputForPassword">Password</label>
                <input type="password" name="password" class="form-control" id="InputForPassword" required>
            </div>
            <button type="submit" class="btn-login">Login</button>
        </form>

        <div class="login-footer">
            <a href="<?= base_url('/'); ?>">Kembali ke Beranda</a>
        </div>
    </div>
</body>
</html>
