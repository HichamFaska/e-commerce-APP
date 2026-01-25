<?php
    namespace App\Http\Controllers;

    use App\Models\Produit;

    class ProductController{
        private Produit $produit;

        public function __construct(Produit $produit){
            $this->produit = $produit;
        }

        public function index(int $id):void{
            $detailsOfProduct = $this->produit->getDetailsOfProduct($id);
            view("pages/detailsProduit", ['detailsOfProduct' => $detailsOfProduct]);
        }
    }