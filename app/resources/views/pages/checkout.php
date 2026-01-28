<?php ob_start(); ?>
<div class = "row g-3">
    <div class="col-md-8 py-3">
        <h4 class="mb-4 ps-2"><i class="fa-solid fa-location-dot text-danger"></i> Adresse de livraison</h4>

        <form action="/checkout" method="POST" id="AdresseForm">
            <?php if(empty($adresses)): ?>
                <!-- Formulaire personnalisé -->
                <div class="card p-5">
                    
                    <input type="hidden" name="address" value="custom" id="customAddress">

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Nom de contact</label>
                            <input type="text" name="nomContact" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pays</label>
                        <input type="text" name="pays" class="form-control" value="Maroc">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ville</label>
                        <input type="text" name="ville" class="form-control">
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Téléphone</label>
                            <input type="tel" name="tel" class="form-control" required>
                        </div>
                        <div class="col">
                            <label class="form-label">Code postal</label>
                            <input type="text" name="code_postal" class="form-control">
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <?php foreach($adresses as $adresse): ?>
                    <label class="card address-card mb-3 p-3">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <input class="form-check-input" type="radio" name="address" value="<?= $adresse->id_adresse;?>" required>
                            </div>
                            <div class="col">
                                <h6 class="mb-1"><?= $adresse->pays." ".$adresse->ville ?></h6>
                                <p class="mb-0 text-muted">
                                    <?= $adresse->code_Postal ?>
                                </p>
                                <p class="mb-0 text-muted">
                                    <?= $adresse->tel ?>
                                </p>
                            </div>
                        </div>
                    </label>
                <?php endforeach; ?>   
                <!-- Adresse personnalisée -->
                <div class="card p-3 mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="address" value="custom" id="customAddress">
                        <label class="form-check-label fw-semibold" for="customAddress">
                            Utiliser une autre adresse
                        </label>
                    </div>

                    <!-- Formulaire personnalisé -->
                    <div id="customForm" class="mt-3 d-none">
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Nom de contact</label>
                                <input type="text" name="nomContact" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pays</label>
                            <input type="text" name="pays" class="form-control" value="Maroc">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ville</label>
                            <input type="text" name="ville" class="form-control">
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Téléphone</label>
                                <input type="tel" name="tel" class="form-control" required>
                            </div>
                            <div class="col">
                                <label class="form-label">Code postal</label>
                                <input type="text" name="code_postal" class="form-control">
                            </div>
                        </div>
                    </div>
                </div> 
            <?php endif; ?>
        </form>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm p-4">
            <h5 class="mb-3 fw-semibold"><i class="fa-solid fa-cart-shopping me-2 mb-4"></i>Votre panier</h5>
            <?php foreach($cart as $item): ?>
                <div class="d-flex justify-content-between align-items-start mb-3 border-bottom pb-2">
                    <div>
                        <p class="mb-1 fw-semibold w-75 text-wrap"><?= $item["name"] ?></p>
                        <small class="text-muted">Quantité : <?= $item["quantite"] ?></small>
                    </div>
                    <div>
                        <span class="fw-bold text-primary"><?= number_format($item["price"] * $item["quantite"], 2) ?> DH</span>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="d-flex justify-content-between mt-4 pt-2 border-top fw-bold fs-5 ">
                <span>Total :</span>
                <span class = "text-primary"><?= number_format($total, 2) ?> DH</span>
            </div>

            <button type="submit" form="AdresseForm" class="btn btn-primary px-4 mt-4">Passer la commande</button>
        </div>
    </div>
</div>

<script src = "/assets/js/checkoutScript.js"></script>
<?php
    $content = ob_get_clean();
    $title = "checkout";
    require __DIR__."/../layout/main.php";
?>