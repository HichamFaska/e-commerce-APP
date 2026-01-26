<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= $titre ?? "Dashboard"; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/adminLayoutStyle.css">
</head>
<body>
    <aside class="sidebar" id="sidebar">
        <div class="brand" >
            <i class="fa-solid fa-store"></i>
            <div class="brand-text">
                <strong>FASKA</strong><br>
                <small class="text-muted">E-commerce</small>
            </div>
        </div>

        <nav>
            <a href="/admin/dashboard" class="nav-link">
                <i class="fa-solid fa-table-columns"></i>
                <span class="nav-text">Dashboard</span>
            </a>

            <a href="/admin/products" class="nav-link active">
                <i class="fa-solid fa-box-open"></i>
                <span class="nav-text">Produits</span>
            </a>

            <a href="/admin/categories" class="nav-link">
                <i class="fa-solid fa-tags"></i>
                <span class="nav-text">Catégories</span>
            </a>

            <a href="/admin/orders" class="nav-link">
                <i class="fa-solid fa-file-invoice-dollar"></i>
                <span class="nav-text">Commandes</span>
            </a>

            <a href="/admin/customers" class="nav-link">
                <i class="fa-solid fa-users"></i>
                <span class="nav-text">Clients</span>
            </a>

            <a href="/admin/stocks" class="nav-link">
                <i class="fa-solid fa-warehouse"></i>
                <span class="nav-text">Stock</span>
            </a>
        </nav>
    </aside>


    <main class="main" id="main">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center gap-3">
                <div class="toggle-btn" id="toggleBtn">
                    <i class="fa-solid fa-bars"></i>
                </div>
                <h3 class="mb-0">Dashboard</h3>
            </div>
            <a href="/logout" class="btn btn-dark btn-sm d-flex align-items-center gap-2">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Déconnexion</span>
            </a>
        </div>

        <div class="card p-5">
            <?= $content ?? '' ?>
        </div>
    </main>

<script src = "/assets/js/mainAdmin.js"></script>
</body>
</html>
