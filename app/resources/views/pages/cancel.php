<?php ob_start(); ?>
    <div class="container py-5 text-center">
        <div class="card shadow-sm border-0 mx-auto" style="max-width: 520px;">
            <div class="card-body p-5">
                <div class="mb-4">
                    <i class="fa-solid fa-circle-xmark text-danger" style="font-size: 4rem;"></i>
                </div>

                <h2 class="fw-bold mb-3">Paiement annulé</h2>

                <p class="text-muted mb-4">
                    Le paiement n'a pas été finalisé.  
                    Vous pouvez réessayer à tout moment.
                </p>

                <a href="/cart" class="btn btn-dark btn-lg">
                    Retour au panier
                </a>
            </div>
        </div>
    </div>
<?php
    $content = ob_get_clean();
    $title = "Paiement annulé";
    require __DIR__ . '/../layout/main.php';
