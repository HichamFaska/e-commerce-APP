<?php ob_start(); ?>

<div class="d-flex align-items-center justify-content-between bg-white p-3 mb-3">
    <h4 class="fw-semibold">Découvrez nos produits en promotion</h4>
    <a class="btn btn-sm btn-dark text-white" href="/produit/promotions">Voir tout</a>
</div>

<div class="row row-cols-1 row-cols-md-5 g-4">
    <?php foreach ($promotedProducts as $produit): ?>
        <?php require __DIR__."/../partials/card.php"; ?>
    <?php endforeach; ?>
</div>

<?php 
    $content = ob_get_clean();
    $title = "Accueil";
    require __DIR__ . '/../layout/main.php';
