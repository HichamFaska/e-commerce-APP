<nav class="border-bottom" style="background-color:#ffffff; border-color:#d0d7de;">

    <div class="container py-2 d-flex justify-content-between align-items-center">
        <a href="/" class="fw-semibold fs-5 text-decoration-none"
           style="color:#24292f;">
            E-Commerce
        </a>

        <div class="dropdown">
            <a class="text-decoration-none dropdown-toggle"
               href="#"
               data-bs-toggle="dropdown"
               style="color:#24292f;">
                <i class="fa-regular fa-user me-1"></i> Compte
            </a>

            <ul class="dropdown-menu dropdown-menu-end shadow-sm border" style="border-color:#d0d7de;">
                <li>
                    <a class="dropdown-item" href="<?= !is_null($username) ? '/logout' : '/login' ?>">
                        <?php if (!is_null($username)): ?>
                            <i class="fa-solid fa-user me-2 text-secondary"></i>
                            <?= htmlspecialchars($username) ?>
                        <?php else: ?>
                            <i class="fa-solid fa-right-to-bracket me-2 text-secondary"></i>
                            Connexion
                        <?php endif; ?>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="/register">
                        <i class="fa-solid fa-user-plus me-2 text-secondary"></i>Inscription
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="border-top" style="background-color:#f6f8fa; border-color:#d0d7de;">
        <div class="container py-2">

            <div class="d-flex align-items-center justify-content-between gap-4">

                <ul class="nav align-items-center gap-2">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-medium"
                        href="#"
                        data-bs-toggle="dropdown"
                        style="color:#24292f;">
                            Catégories
                        </a>

                        <ul class="dropdown-menu shadow-sm border"
                            style="border-color:#d0d7de;">
                            <?php foreach($categories as $categorie): ?>
                                <li>
                                    <a class="dropdown-item"
                                    href="/categorie/<?= $categorie->nomCategorie; ?>">
                                        <?= $categorie->nomCategorie; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="/" style="color:#24292f;">
                            Accueil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="/nouveautes" style="color:#24292f;">
                            Nouveautés
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="/promotions" style="color:#24292f;">
                            Promotions
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="/contact" style="color:#24292f;">
                            Contact
                        </a>
                    </li>

                </ul>

                <form class="d-flex flex-grow-1 me-4" style="max-width:320px;">
                    <input type="search"
                        class="form-control"
                        placeholder="Rechercher un produit..."
                        style="border-color:#d0d7de;">
                    <button class = "btn btn-sm btn-dark text-white">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>

                <a href="/cart"
                class="text-decoration-none position-relative ms-4"
                style="color:#24292f;">
                    <i class="fa-solid fa-cart-shopping fs-5"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark">
                        <?= $nbProduit ?>
                    </span>
                </a>
            </div>
        </div>
    </div>
</nav>
