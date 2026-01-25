<?php
    namespace App\Http\Controllers;

    use App\Models\Produit;

    class homeController{
        private Produit $produit;

        public function __construct(Produit $produit){
            $this->produit = $produit;
        }

        public function index():void{
            $promotedProducts = $this->produit->getPromotedProducts();
            $popularProducts = $this->produit->getPopularProducts();
            $resentProduits = $this->produit->getResentProduits();
            view("pages/homePage", [
                'promotedProducts' => $promotedProducts,
                'popularProducts' => $popularProducts,
                'resentProduits' => $resentProduits
            ]);
        }
    }