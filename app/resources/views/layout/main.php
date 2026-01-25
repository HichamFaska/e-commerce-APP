<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Mon App' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff;
            color: #24292f;
        }

        .app-container {
            background-color: #f6f8fa;
            border: 1px solid #d0d7de;
            border-radius: 6px;
            padding: 1.5rem;
        }

        footer {
            background-color: #f6f8fa;
            border-top: 1px solid #d0d7de;
            color: #57606a;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <?php
        $navbarController = new App\Http\Controllers\CategoryController();
        $navbarController->navbar();
    ?>

    <main class="flex-fill mx-2 my-4">
        <div class="app-container">
            <?= $content ?? '' ?>
        </div>
    </main>

    <footer class="text-center py-3 mt-auto">
        &copy; <?= date('Y') ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
