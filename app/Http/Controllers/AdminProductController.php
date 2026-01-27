<?php
    namespace App\Http\Controllers;

    use App\Http\Request;
    use App\Models\Categorie;
    use App\Models\Marque;
    use App\Models\Produit;

    class AdminProductController{
        private Produit $produit;
        private Request $request;
        private Marque $marque;
        private Categorie $categorie;

        public function __construct(Request $request, Produit $produit, Categorie $categorie, Marque $marque){
            $this->produit = $produit;
            $this->request = $request;
            $this->categorie = $categorie;
            $this->marque = $marque;
        }

        public function index():void{
            $allProducts = $this->produit->getAllProduts();
            $marques = $this->marque->getAll();
            $categories = $this->categorie->getAll();
            view('admin/pages/produits',[
                'allProducts' => $allProducts,
                'marques' => $marques,
                'categories' => $categories
            ]);
        }
    }