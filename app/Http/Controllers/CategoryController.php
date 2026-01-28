<?php
    namespace App\Http\Controllers;

    use App\Models\Produit;

    class CategoryController{
        
        private Produit $produit;

        public function __construct(Produit $produit,){
            $this->produit = $produit;
        }

        public function index(string $categorie):void{
            $products = $this->produit->getProductsByCategorie($categorie);
            view('pages/productsByCategorie', [
                'products' => $products,
                'categorie' => $categorie
            ]);
        }
    }