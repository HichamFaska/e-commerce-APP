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
            view("pages/homePage", ['promotedProducts' => $promotedProducts]);
        }
    }