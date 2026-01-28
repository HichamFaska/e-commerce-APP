<?php
    namespace App\Services;

    use App\Models\Categorie;
    use App\Auth\Auth;
    use App\Services\CartService;

    class NavbarService {
        private Categorie $categorie;

        public function __construct(Categorie $categorie) {
            $this->categorie = $categorie;
        }

        public function getData(): array {
            return [
                'categories' => $this->categorie->getCategories(),
                'username' => Auth::getUsername(),
                'nbProduit' => CartService::count(),
            ];
        }
    }
