<?php
    namespace App\Http\Controllers;

    use App\Http\Request;
    use App\Models\Produit;

    class AdminProductController{
        private Produit $produit;
        private Request $request;

        public function __construct(Request $request, Produit $produit){
            $this->produit = $produit;
            $this->request = $request;
        }

        public function index():void{
            $allProducts = $this->produit->getAllProduts();
            view('admin/pages/produits',['allProducts' => $allProducts]);
        }
    }