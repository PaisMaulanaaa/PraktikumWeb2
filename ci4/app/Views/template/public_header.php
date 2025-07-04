<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'My Website'); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            color: #1f2937;
        }
        .container {
            max-width: 960px;
            margin: 0 auto;
            padding: 32px 24px 24px 24px;
            background: rgba(255, 240, 243, 0.65);
            border-radius: 22px;
            box-shadow: 0 8px 32px 0 #b23b3b22, 0 1.5px 8px 0 #fff0f3cc;
            border: 1.5px solid #f8d7da;
            backdrop-filter: blur(6px);
            transition: box-shadow 0.3s, border 0.3s, background 0.3s;
        }
        .container:hover {
            box-shadow: 0 16px 48px 0 #b23b3b33, 0 2px 12px 0 #fff0f3cc;
            border: 1.5px solid #b23b3b44;
            background: rgba(255, 240, 243, 0.82);
        }
        .main-header {
            background: rgba(255, 240, 243, 0.85);
            padding: 22px 38px;
            border-radius: 18px;
            margin-bottom: 34px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 8px 32px 0 #b23b3b22, 0 1.5px 8px 0 #fff0f3cc;
            border: 1.5px solid #f8d7da;
            backdrop-filter: blur(8px);
            transition: box-shadow 0.3s, border 0.3s;
        }
        .main-header:hover {
            box-shadow: 0 12px 36px 0 #b23b3b33, 0 2px 12px 0 #fff0f3cc;
            border: 1.5px solid #b23b3b44;
        }
        .main-header h1 {
            font-size: 32px;
            font-weight: 700;
            margin: 0;
            color: #b23b3b;
            font-family: Georgia, serif;
            letter-spacing: 3px;
            text-shadow: 0 2px 10px #fff0f3cc, 0 1px 0 #fff;
            padding-right: 18px;
            transition: color 0.2s, text-shadow 0.2s;
        }
        .main-nav {
            display: flex;
            gap: 8px;
            background: #fff0f3;
            border-radius: 8px;
            padding: 6px 18px;
            box-shadow: 0 2px 8px #b23b3b11;
        }
        .main-nav a {
            color: #b23b3b;
            text-decoration: none;
            font-family: Georgia, serif;
            font-weight: 500;
            font-size: 18px;
            letter-spacing: 1px;
            padding: 8px 18px;
            border-radius: 6px;
            transition: background 0.2s, color 0.2s, box-shadow 0.2s;
            position: relative;
            background: transparent;
            margin-left: 0;
        }
        .main-nav a:hover, .main-nav a.active {
            background: linear-gradient(90deg, #f8d7da 60%, #fff0f3 100%);
            color: #fff;
            box-shadow: 0 2px 8px #b23b3b22;
        }
        .main-nav a.active {
            background: #b23b3b;
            color: #fff;
        }
        .content {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        footer {
            text-align: center;
            margin-top: 20px;
            color: #6b7280;
        }
        @media (max-width: 600px) {
            .main-header {
                flex-direction: column;
                align-items: flex-start;
                padding: 15px 10px;
            }
            .main-nav {
                width: 100%;
                justify-content: flex-start;
                flex-wrap: wrap;
                padding: 6px 4px;
            }
            .main-nav a {
                font-size: 16px;
                padding: 8px 10px;
                margin-bottom: 4px;
            }
        }
    </style>
    <link rel="stylesheet" href="<?= base_url('assets/css/artikel.css'); ?>">
</head>
<body>
    <div class="container">
        <header class="main-header">
            <h1>mannarc</h1>
            <nav class="main-nav">
                <a href="<?= base_url('/'); ?>">Home</a>
                <a href="<?= base_url('/artikel'); ?>">Artikel</a>
                <a href="<?= base_url('/about'); ?>">About</a>
                <a href="<?= base_url('/contact'); ?>">Contact</a>
                <a href="<?= base_url('/user/login'); ?>">Login</a>
            </nav>
        </header>
        <main class="content">
