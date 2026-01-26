<?php ob_start(); ?>
<div class = "d-flex align-items-center justify-content-between mb-3">
    <h4 class = "fw-semibold"><i class="fa-regular fa-rectangle-list"></i> Liste des Produits</h4>
    <button type="button" data-bs-toggle="modal" data-bs-target="#addProductModal" class = "btn btn-sm btn-dark">
        <i class = "fa-solid fa-plus"></i>
        Ajouté
    </button>
</div>
<div class = "table-responsive">
    <table class = "table table-hover align-middle">
        <thead class = "table-ligth">
            <tr>
                <th>désignation</th>
                <th>Marque</th>
                <th>Catégorie</th>
                <th>prix d'achat</th>
                <th>prix de vente</th>
                <th>Quantité en Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $hasContent = false; ?>
            <?php foreach($allProducts as $all): ?>
                <?php $hasContent = true; ?>
                <tr>
                    <td><?= $all->designation ?></td>
                    <td><?= $all->nomMarque ?></td>
                    <td><?= $all->nomCategorie ?></td>
                    <td><?= $all->prixAchat ?></td>
                    <td><?= $all->prixVente ?></td>
                    <td><?= ($all->quantiteStock > 0) ? $all->quantiteStock : $all->quantiteStock.' (repture de stock)' ?></td>
                    <td class="text-center">
                        <a href="/admin/produit/view?id=<?= $all->id_produit ?>" class="btn btn-sm btn-dark" title="Voir">
                            <i class="fa-solid fa-eye"></i>
                        </a>

                        <a href="/admin/produit/edit?id=<?= $all->id_produit ?>" class="btn btn-sm btn-dark" title="Modifier">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>

                        <a href="/admin/produit/delete?id=<?= $all->id_produit ?>" class="btn btn-sm btn-dark" title="Supprimer" onclick="return confirm('Voulez-vous vraiment supprimer ce produit ?');">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if(!$hasContent): ?>   
                <tr>
                    <td class="text-center py-4 fw-semibold text-muted" colspan="100%">Liste vide</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php 
    $content = ob_get_clean();
    $title = "Products";
    require __DIR__ . '/../../admin/layout/main.php';
?>