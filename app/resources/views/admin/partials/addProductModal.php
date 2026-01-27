<!-- Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <form action="/admin/products/add" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Ajouter un nouveau produit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>

                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                    <div class="row g-3">
                        <div class = "col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Désignation</label>
                                <input type="text" name="designation" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Prix d'achat</label>
                                <input type="number" name="prixAchat" step="0.01" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Prix de vente</label>
                                <input type="number" name="prixVente" step="0.01" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">le stock critique</label>
                                <input type="number" name="stock_critique" step="0.01" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Quantité en stock</label>
                                <input type="number" name="quantiteStock" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Marque</label>
                                <select name="id_marque" class="form-select" required>
                                    <option value="">-- Sélectionner --</option>
                                    <?php foreach($marques as $marque): ?>
                                        <option value="<?= $marque->id_marque ?>"><?= $marque->nomMarque; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Catégorie</label>
                                <select name="id_categorie" class="form-select" required>
                                    <option value="">-- Sélectionner --</option>
                                    <?php foreach($categories as $categorie): ?>
                                        <option value="<?= $categorie->id_categorie ?>"><?= $categorie->nomCategorie; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">slug</label>
                                <input type="text" name="slug" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="4" required></textarea>
                            </div>
                        </div>
                        <div class = "col-md-6">
                            <div class="mb-3">
                                <label class="form-label">caracteristiques du produit</label>
                                <div id="CaracteristiquesContainer" class="d-flex flex-column gap-2">
                                    <div class="input-group">
                                        <input type="text" name="nameCaractr[]" class="form-control" placeholder="nom" required>
                                        <input type="text" name="valueCaract[]" class="form-control" placeholder="value" required>
                                        <button type="button" class="btn btn-danger text-dark remove-image"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                                <button type="button" id="addCaracteristiqueBtn" class="btn btn-sm btn-dark mt-2">
                                    Ajouter une caracteristique
                                </button>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Images du produit</label>
                                <div id="imageContainer" class="d-flex flex-column gap-2">
                                    <div class="input-group">
                                        <input type="file" name="images[]" class="form-control" accept=".jpg,.jpeg,.png,.webp,.gif" required>
                                        <button type="button" class="btn btn-danger text-dark remove-image"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                                <button type="button" id="addImageBtn" class="btn btn-sm btn-dark mt-2">
                                    Ajouter une image
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src = "/assets/js/addImageScript.js"></script>
<script src = "/assets/js/addCaracteristiqueScript.js"></script>
