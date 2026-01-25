<?php ob_start(); ?>

<style>
    .zoom-container {
        height: 460px;
        background-color: #f6f8fa;
        border: 1px solid #d0d7de;
        border-radius: 8px;
        overflow: hidden;
        position: relative;
        cursor: zoom-in;
    }

    .zoom-container img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        transition: transform 0.15s ease;
        transform-origin: center;
    }

    .thumbnail-wrapper {
        border: 1px solid #d0d7de;
        border-radius: 6px;
        padding: 6px;
        height: 80px;
        width: 80px;
        background: #fff;
    }

    .thumbnail-wrapper img {
        height: 100%;
        width: 100%;
        object-fit: contain;
        cursor: pointer;
    }

    .thumbnail-wrapper:hover {
        border-color: #0969da;
    }
</style>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="zoom-container mb-3 p-3" id="zoomContainer">
            <img
                src="<?= "http://127.0.0.1:8001/".$detailsOfProduct['images'][0]->url ?>"
                id="zoomImage"
                alt="<?= htmlspecialchars($detailsOfProduct['infoProduit']->designation) ?>"
            >
        </div>

        <div class="d-flex justify-content-center gap-3">
            <?php foreach ($detailsOfProduct['images'] as $img): ?>
                <div class="thumbnail-wrapper">
                    <img
                        src="<?= "http://127.0.0.1:8001/".$img->url ?>"
                        class="thumbnail-image"
                        data-src="<?= "http://127.0.0.1:8001/".$img->url ?>"
                    >
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="col-lg-6">
        <h3 class="fw-bold mb-2">
            <?= htmlspecialchars($detailsOfProduct['infoProduit']->designation) ?>
        </h3>
        <div class="text-muted mb-3">
            Marque : <?= htmlspecialchars($detailsOfProduct['infoProduit']->nomMarque) ?>
        </div>
        <div class="mb-3">
            <?php if (!empty($detailsOfProduct['promotion'])): ?>
                <?php
                    $promo = $detailsOfProduct['promotion'][0];
                    $newPrice = $detailsOfProduct['infoProduit']->prixVente - ($detailsOfProduct['infoProduit']->prixVente * ($promo->valeur_discount / 100));
                ?>
                <span class="fs-3 fw-bold text-danger">
                    <?= number_format($newPrice, 2, ',', ' ') ?> DH
                </span>
                <span class="text-muted text-decoration-line-through ms-2">
                    <?= number_format($detailsOfProduct['infoProduit']->prixVente, 2, ',', ' ') ?> DH
                </span>
                <span class="badge bg-danger ms-2">
                    -<?= $promo->valeur_discount ?>%
                </span>
            <?php else: ?>
                <span class="fs-3 fw-bold">
                    <?= number_format($detailsOfProduct['infoProduit']->prixVente, 2, ',', ' ') ?> DH
                </span>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <?php if ($detailsOfProduct['infoProduit']->quantiteStock > 0): ?>
                <span class="badge bg-success">En stock</span>
            <?php else: ?>
                <span class="badge bg-danger">Rupture de stock</span>
            <?php endif; ?>
        </div>

        <div class="card border-0 shadow-sm p-3 mb-4">
            <h5 class="fw-semibold mb-3">Caractéristiques</h5>
            <?php if (!empty($detailsOfProduct['caracteristiques'])): ?>
                <?php foreach ($detailsOfProduct['caracteristiques'] as $c): ?>
                    <div class="mb-2">
                        <span class="fw-semibold"><?= htmlspecialchars($c->caracteristique) ?> :</span>
                        <?= htmlspecialchars($c->value_caracteristique) ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-muted">Aucune caractéristique disponible.</div>
            <?php endif; ?>
        </div>

        <form action="/cart/add" method="POST" class="d-flex align-items-end gap-3">
            <input type="hidden" name="id_produit" value="<?= $detailsOfProduct['infoProduit']->id_Produit ?>">
            <input type="hidden" name="redirect" value="<?= $_SERVER['REQUEST_URI'] ?>">
            <div>
                <label class="fw-semibold mb-1">Quantité</label>
                <input
                    type="number"
                    name="quantite"
                    value="1"
                    min="0"
                    max="<?= $detailsOfProduct['infoProduit']->quantiteStock ?>"
                    class="form-control"
                    style="width: 120px;"
                >
            </div>
            <button
                class="btn btn-primary btn-lg"
                <?= $detailsOfProduct['infoProduit']->quantiteStock <= 0 ? 'disabled' : '' ?>
            >
                Ajouter au panier
            </button>
        </form>
    </div>
</div>

<div class="card card-body shadow-sm border-0 mt-4">
    <h5 class="fw-bold mb-3">Description du produit</h5>
    <?= !empty($detailsOfProduct['infoProduit']->description)
        ? $detailsOfProduct['infoProduit']->description
        : "<em>Aucune description disponible.</em>" ?>
</div>

<script>
    const container = document.getElementById('zoomContainer');
    const image = document.getElementById('zoomImage');
    const thumbnails = document.querySelectorAll('.thumbnail-image');

    container.addEventListener('mousemove', e => {
        const rect = container.getBoundingClientRect();
        const x = ((e.clientX - rect.left) / rect.width) * 100;
        const y = ((e.clientY - rect.top) / rect.height) * 100;

        image.style.transformOrigin = `${x}% ${y}%`;
        image.style.transform = 'scale(1.9)';
    });

    container.addEventListener('mouseleave', () => {
        image.style.transform = 'scale(1)';
        image.style.transformOrigin = 'center';
    });

    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', () => {
            image.src = thumbnail.dataset.src;
        });
    });
</script>
<?php
    $content = ob_get_clean();
    $title = $detailsOfProduct['infoProduit']->designation;
    require __DIR__ . '/../layout/main.php';
?>