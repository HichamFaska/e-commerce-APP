<?php ob_start(); ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    <h4 class="fw-bold mb-3 text-center">
                        <i class="fa-solid fa-credit-card text-primary"></i> Paiement sécurisé
                    </h4>

                    <p class="text-muted text-center mb-4">
                        Vous allez être redirigé vers Stripe pour finaliser votre paiement en toute sécurité.
                    </p>

                    <div class="border rounded p-3 mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Total à payer</span>
                            <span class="fw-bold fs-5">
                                <?= number_format(\App\Services\CartService::total(), 2) ?> DH
                            </span>
                        </div>
                    </div>

                    <form action="/payment/stripe" method="POST">
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="bi bi-credit-card-2-front me-2"></i>
                            Payer avec Stripe
                        </button>
                    </form>

                    <div class="text-center mt-3">
                        <a href="/cart" class="text-decoration-none text-muted">
                            ← Retour au panier
                        </a>
                    </div>

                </div>
            </div>

            <p class="text-center text-muted mt-3 small">
                Paiement 100% sécurisé via Stripe
            </p>

        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$title = "Paiement";
require __DIR__ . '/../layout/main.php';
?>
