<?php ob_start(); ?>
    <div class="container py-5 text-center">
        <div class="card shadow-sm border-0 mx-auto" style="max-width: 520px;">
            <div class="card-body p-5">
                <div class="mb-4">
                    <i class="fa-solid fa-circle-check text-success" style="font-size: 4rem;"></i>
                </div>

                <h2 class="fw-bold mb-3">Paiement confirmé</h2>

                <p class="text-muted mb-4">
                    Merci pour votre commande.  
                    Votre paiement a été traité avec succès.
                </p>

                <div class="d-grid gap-2">
                    <a href="/" class="btn btn-primary btn-lg">
                        Retour à l'accueil
                    </a>

                    <a href="/orders" class="btn btn-outline-secondary">
                        Voir mes commandes
                    </a>
                </div>
            </div>
        </div>
    </div>

<?php
    $content = ob_get_clean();
    $title = "Paiement réussi";
    require __DIR__ . '/../layout/main.php';
