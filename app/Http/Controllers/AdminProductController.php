<?php
    namespace App\Http\Controllers;

    use App\Http\Request;
    use App\Models\Categorie;
    use App\Models\Marque;
    use App\Models\Produit;
    use App\Services\ImageService;

    class AdminProductController{
        private Produit $produit;
        private Request $request;
        private Marque $marque;
        private Categorie $categorie;
        private ImageService $produitService;

        public function __construct(Request $request, Produit $produit, Categorie $categorie, Marque $marque, ImageService $produitService){
            $this->produit = $produit;
            $this->request = $request;
            $this->categorie = $categorie;
            $this->marque = $marque;
            $this->produitService = $produitService;
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

        public function store(): void {
            $designation = $this->request->input('designation');
            $prixAchat = $this->request->input('prixAchat');
            $prixVente = $this->request->input('prixVente');
            $stock_critique = $this->request->input('stock_critique');
            $quantiteStock = $this->request->input('quantiteStock');
            $id_marque = $this->request->input('id_marque');
            $slug = $this->request->input('slug');
            $id_categorie = $this->request->input('id_categorie');
            $description = $this->request->input('description');
            $caractName = $this->request->input('nameCaractr');
            $caractValue = $this->request->input('valueCaract');

            $caracteristiques = compact('caractName', 'caractValue');

            $files = $this->request->files();            
            $images = $this->produitService->getImagesPath($files['images']);
            
            $data = compact('designation', 'prixAchat', 'prixVente', 'quantiteStock', 'stock_critique', 'slug', 'description', 'id_categorie', 'id_marque');
            
            $this->produit->create($data, $images, $caracteristiques);
            
            header('Location: /admin/products');
            exit;
        }
    }