<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '管理画面')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f6fa;
        }

        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: #1f2937;
            color: white;
        }

        .sidebar a {
            color: #d1d5db;
            text-decoration: none;
            padding: 12px 20px;
            display: block;
            transition: 0.2s;
        }

        .sidebar a:hover {
            background: #374151;
            color: white;
        }

        .content {
            flex: 1;
        }

        .topbar {
            background: white;
            border-bottom: 1px solid #ddd;
            padding: 16px 24px;
        }

        .dashboard-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,.08);
        }

       .sidebar-button {
           width: 100%;
           background: transparent;
           border: none;
           color: #d1d5db;
           text-align: left;
           padding: 12px 20px;
           display: block;
           transition: 0.2s;
           cursor: pointer;
       }

        .sidebar-button:hover {
            background: #374151;
            color: white;
        }
    </style>
</head>
<body>

<div class="d-flex">

    <!-- Sidebar -->
    <div class="sidebar">

        <div class="p-4 border-bottom">
            <h4 class="mb-0">Admin Panel</h4>
        </div>

        <nav class="mt-3">
            <a href="#">
                ダッシュボード
            </a>

            <a href="#">
                ユーザー管理
            </a>

            <a href="#">
                投稿管理
            </a>

            <a href="#">
                売上管理
            </a>

            <a href="#">
                設定
            </a>

            <form method="POST" action="{{ route('admin.login.destroy') }}">
                @method('DELETE')
                @csrf
                <button type="submit" class="sidebar-button"> ログアウト </button>
            </form>
        </nav>
    </div>

    <!-- Content -->
    <div class="content">

        <!-- Topbar -->
        <div class="topbar d-flex justify-content-between align-items-center">

            <h4 class="mb-0">
                @yield('page-title')
            </h4>

            <div>
                管理者：admin
            </div>

        </div>

        <div class="container-fluid p-4">
            @yield('content')
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
