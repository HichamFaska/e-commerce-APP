<?php
    namespace App\Http\Controllers;

    use App\Auth\Auth;
    use App\Models\Categorie;
    use App\Services\CartService;

    class CategoryController{
        private Categorie $categorie;

        public function __construct(){
            $this->categorie = new Categorie();
        }

        public function navbar(){
            $categories  = $this->categorie->getCategories();
            $username = Auth::getUsername();
            $nbProduit = CartService::count();
            view("partials/navbar", [
                'categories' => $categories,
                'username' => $username,
                'nbProduit' => $nbProduit
            ]);
        }
    }