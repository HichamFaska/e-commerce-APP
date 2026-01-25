<?php ob_start(); ?>
<section class="mb-4">
    <div class="row g-3">
        <div class="col-md-12">
            <div class="position-relative rounded overflow-hidden shadow-sm">
                <img 
                    src="/assets/images/ads/ad-main.jpg"
                    class="img-fluid w-100"
                    alt="Publicité principale"
                >

                <div class="position-absolute top-0 start-0 w-100 h-100 
                            d-flex align-items-center
                            text-dark p-4">
                    <div>
                        <h3 class="fw-bold mb-2">
                            Nouvelle collection été
                        </h3>
                        <p class="mb-3">
                            Découvrez nos nouveautés à prix exclusifs.
                        </p>
                        <a 
                            href="/produit/123"
                            class="btn btn-sm btn-light fw-semibold"
                        >
                            Voir le produit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="d-flex align-items-center justify-content-between bg-white p-3 mb-3">
        <h4 class="fw-semibold">Découvrez nos produits en promotion</h4>
        <a class="btn btn-sm btn-dark text-white" href="/produit/promotions">Voir tout</a>
    </div>

    <div class="row row-cols-1 row-cols-md-5 g-4">
        <?php foreach ($promotedProducts as $produit): ?>
            <?php require __DIR__."/../partials/card.php"; ?>
        <?php endforeach; ?>
    </div>
</section>
<section class="mt-5 mb-4">
    <div class="row g-3">

        <div class="col-md-6">
            <div class="position-relative rounded overflow-hidden shadow-sm">
                <img 
                    src="/assets/images/ads/ad-side-1.jpg"
                    class="img-fluid w-100"
                    alt="Publicité secondaire"
                >

                <div class="position-absolute top-0 start-0 w-100 h-100 
                            d-flex align-items-end
                            text-dark p-3">
                    <div>
                        <h6 class="fw-bold mb-1">Sneakers tendance</h6>
                        <a 
                            href="/produit/456"
                            class="text-dark text-decoration-underline small"
                        >
                            Découvrir
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="position-relative rounded overflow-hidden shadow-sm">
                <img 
                    src="/assets/images/ads/ad-side-2.jpg"
                    class="img-fluid w-100"
                    alt="Publicité secondaire"
                >

                <div class="position-absolute top-0 start-0 w-100 h-100 
                            d-flex align-items-end
                            text-dark p-3">
                    <div>
                        <h6 class="fw-bold mb-1">Montres élégantes</h6>
                        <a 
                            href="/produit/789"
                            class="text-dark text-decoration-underline small"
                        >
                            Voir l’offre
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<?php 
    $content = ob_get_clean();
    $title = "Accueil";
    require __DIR__ . '/../layout/main.php';
?>
