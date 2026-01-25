<div class="col">
    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative">
        <div class="d-flex align-items-center justify-content-center p-3" style="height: 220px;">
            <img src="<?= htmlspecialchars($produit->url) ?>" class="img-fluid" alt="<?= htmlspecialchars($produit->designation) ?>" style="max-height: 100%; object-fit: contain;">
        </div>

        <?php if (!empty($produit->valeur_discount)): ?>
            <span class="position-absolute top-0 start-0 m-2 badge bg-danger fs-7" style="padding: 0.5em 0.7em; border-radius: 0.5rem;">
                -<?= htmlspecialchars($produit->valeur_discount) ?>%
            </span>
        <?php endif; ?>

        <div class="card-body d-flex flex-column">

            <h6 class="text-secondary mb-1 text-uppercase" style="font-weight: 500; letter-spacing: 0.5px; font-size: 0.75rem;">
                <?= htmlspecialchars($produit->nomMarque) ?>
            </h6>

            <h5 class="card-title mb-3" style="font-weight: 600; font-size: 1.1rem; line-height: 1.2;">
                <?= htmlspecialchars($produit->designation) ?>
            </h5>

            <div class="mb-3">
                <?php if (!empty($produit->valeur_discount)): ?>
                    <?php $prixPromo = $produit->prixVente - (($produit->prixVente * $produit->valeur_discount)/100); ?>
                    <div class="fw-bold text-danger fs-5"><?= number_format($prixPromo, 2, ',', ' ') ?> MAD</div>
                    <div class="text-muted text-decoration-line-through ms-2 fs-7"><?= number_format($produit->prixVente, 2, ',', ' ') ?> MAD</div>
                <?php else: ?>
                    <span class="fw-bold text-dark fs-6"><?= number_format($produit->prixVente, 2, ',', ' ') ?> MAD</span>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <?php $enStock = $produit->quantiteStock > 0; ?>
                <?php if (!$enStock): ?>
                    <span class="badge rounded-pill text-bg-danger">
                        <i class="fa-solid fa-xmark me-1"></i>Rupture de stock
                    </span>
                <?php endif; ?>
            </div>

            <a href="#" class="text-white btn <?= $enStock ? 'btn-dark' : 'btn-secondary disabled' ?> mt-auto fw-semibold shadow-sm" style="border-radius: 0.5rem; padding: 0.5rem 1rem;">
                <i class="fa-solid fa-cart-plus me-1"></i> Ajouter au panier
            </a>
        </div>

        <style>
            .card:hover {
                transform: translateY(-6px);
                transition: transform 0.25s ease-in-out, box-shadow 0.25s ease-in-out;
                box-shadow: 0 1rem 2rem rgba(0,0,0,0.2);
            }

            .card-body a.btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 0.25rem 0.5rem rgba(0,0,0,0.15);
            }
        </style>
    </div>
</div>