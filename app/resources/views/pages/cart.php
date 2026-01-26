<?php ob_start(); ?>
<div class="container my-5">
    <h2 class="mb-4">Panier</h2>

    <?php if(empty($cartContent)): ?>
        <div class="alert alert-info">Votre panier est vide.</div>
        <a href="/" class="btn btn-primary">Continuer mes achats</a>
    <?php else: ?>
        <div class="row">
            <!-- Liste des produits -->
            <div class="col-lg-8">
                <div class="list-group">
                    <?php foreach($cartContent as $item): ?>
                        <div class="list-group-item mb-3 shadow-sm rounded-3">
                            <div class="row align-items-center">
                                <div class="col-md-2 text-center">
                                    <img src="<?= $item['image'] ?>" class="img-fluid" alt="<?= $item['name'] ?>">
                                </div>
                                <div class="col-md-5">
                                    <p class="mb-1 fw-semibold"><?= $item['name'] ?></p>
                                    <?php if(isset($item['discount']) && $item['discount'] > 0): ?>
                                        <p class="text-danger mb-0">-<?= number_format($item['discount'],2) ?> Dh</p>
                                        <p class="text-decoration-line-through mb-0"><?= number_format($item['price'],2) ?> Dh</p>
                                        <p class="fw-bold mb-0"><?= number_format($item['price'] - $item['discount'],2) ?> Dh</p>
                                    <?php else: ?>
                                        <p class="fw-bold mb-0"><?= number_format($item['price'],2) ?> Dh</p>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-2">
                                    <form action="/cart/update" method="POST" class="d-flex">
                                        <input type="hidden" name="id_produit" value="<?= $item['id'] ?>">
                                        <input type="hidden" name="redirect" value="<?= $_SERVER['REQUEST_URI'] ?>">
                                        <input type="number" name="quantite" value="<?= $item['quantite'] ?>" min="1" max="<?= $item['quantiteStock']; ?>" class="form-control me-2">
                                        <button class="btn btn-primary btn-sm">Ok</button>
                                    </form>
                                </div>
                                <div class="col-md-2 fw-bold text-end">
                                    <?= number_format(($item['price'] - ($item['discount'] ?? 0)) * $item['quantite'],2) ?> Dh
                                </div>
                                <div class="col-md-1 text-end">
                                    <form action="/cart/remove" method="POST">
                                        <input type="hidden" name="id_produit" value="<?= $item['id'] ?>">
                                        <input type="hidden" name="redirect" value="<?= $redirection; ?>">
                                        <button class="btn btn-light text-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Récapitulatif panier -->
            <div class="col-lg-4">
                <div class="card shadow-sm rounded-3 p-3">
                    <h5 class="fw-bold">Récapitulatif</h5>
                    <hr>
                    <div class="d-flex justify-content-between mb-2">
                        <span><?= $nbProduct ?> article<?= $nbProduct > 1 ? 's' : '' ?></span>
                        <span><?= number_format($totalCart,2) ?> Dh</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Livraison</span>
                        <span>Gratuit</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold fs-5 mb-3">
                        <span>Total TTC</span>
                        <span><?= number_format($totalCart,2) ?> Dh</span>
                    </div>
                    <a href="/checkout" class="btn btn-primary w-100">Vérifier</a>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <a href="/" class="text-decoration-none">&larr; Continuer mes achats</a>
        </div>
    <?php endif; ?>
</div>
<?php 
    $content = ob_get_clean();
    $title = "Accueil";
    require __DIR__ . '/../layout/main.php';
?>